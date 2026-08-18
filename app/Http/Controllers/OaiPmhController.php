<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class OaiPmhController extends Controller
{
    public function handle(Request $request)
    {
        $verb = $request->input('verb');
        $metadataPrefix = $request->input('metadataPrefix');
        $identifier = $request->input('identifier');
        $set = $request->input('set');

        $responseDate = now()->toIso8601String();
        $baseUrl = route('oai');

        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><OAI-PMH xmlns="http://www.openarchives.org/OAI/2.0/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.openarchives.org/OAI/2.0/ http://www.openarchives.org/OAI/2.0/OAI-PMH.xsd"/>');
        $xml->addChild('responseDate', $responseDate);
        
        $requestNode = $xml->addChild('request', $baseUrl);
        if ($verb) $requestNode->addAttribute('verb', $verb);
        if ($metadataPrefix) $requestNode->addAttribute('metadataPrefix', $metadataPrefix);
        if ($identifier) $requestNode->addAttribute('identifier', $identifier);
        if ($set) $requestNode->addAttribute('set', $set);

        if (!$verb) {
            $error = $xml->addChild('error', 'Missing verb parameter.');
            $error->addAttribute('code', 'badVerb');
            return Response::make($xml->asXML(), 200, ['Content-Type' => 'application/xml']);
        }

        switch ($verb) {
            case 'Identify':
                $identify = $xml->addChild('Identify');
                $identify->addChild('repositoryName', 'Cahaya Ilmu Bangsa Repositori');
                $identify->addChild('baseURL', $baseUrl);
                $identify->addChild('protocolVersion', '2.0');
                $identify->addChild('adminEmail', 'admin@cib.institute');
                $identify->addChild('earliestDatestamp', '2026-01-01T00:00:00Z');
                $identify->addChild('deletedRecord', 'no');
                $identify->addChild('granularity', 'YYYY-MM-DDThh:mm:ssZ');
                break;

            case 'ListMetadataFormats':
                $formats = $xml->addChild('ListMetadataFormats');
                $format = $formats->addChild('metadataFormat');
                $format->addChild('metadataPrefix', 'oai_dc');
                $format->addChild('schema', 'http://www.openarchives.org/OAI/2.0/oai_dc.xsd');
                $format->addChild('metadataNamespace', 'http://www.openarchives.org/OAI/2.0/oai_dc/');
                break;

            case 'ListSets':
                $sets = $xml->addChild('ListSets');
                $journals = Journal::all();
                foreach ($journals as $journal) {
                    $setNode = $sets->addChild('set');
                    $setNode->addChild('setSpec', $journal->slug);
                    $setNode->addChild('setName', htmlspecialchars($journal->name));
                }
                break;

            case 'ListIdentifiers':
            case 'ListRecords':
                if ($metadataPrefix && $metadataPrefix !== 'oai_dc') {
                    $error = $xml->addChild('error', 'The metadataPrefix is not supported.');
                    $error->addAttribute('code', 'cannotDisseminateFormat');
                    break;
                }

                $articlesQuery = Article::with('journal')->where('status', 'published');
                if ($set) {
                    $journal = Journal::where('slug', $set)->first();
                    if ($journal) {
                        $articlesQuery->where('journal_id', $journal->id);
                    }
                }

                $articles = $articlesQuery->get();
                if ($articles->isEmpty()) {
                    $error = $xml->addChild('error', 'No records found.');
                    $error->addAttribute('code', 'noRecordsMatch');
                    break;
                }

                $verbNode = $xml->addChild($verb);

                foreach ($articles as $article) {
                    $recordNode = $verbNode->addChild('record');
                    
                    // Header
                    $header = $recordNode->addChild('header');
                    $header->addChild('identifier', 'oai:repo.cib.institute:' . $article->id);
                    $header->addChild('datestamp', $article->updated_at->toIso8601String());
                    if ($article->journal) {
                        $header->addChild('setSpec', $article->journal->slug);
                    }

                    if ($verb === 'ListRecords') {
                        // Metadata
                        $metadata = $recordNode->addChild('metadata');
                        
                        // Dublin Core
                        $dcNode = $metadata->addChild('oai_dc:dc', null, 'http://www.openarchives.org/OAI/2.0/oai_dc/');
                        $dcNode->addAttribute('xmlns:oai_dc', 'http://www.openarchives.org/OAI/2.0/oai_dc/');
                        $dcNode->addAttribute('xmlns:dc', 'http://purl.org/dc/elements/1.1/');
                        $dcNode->addAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
                        $dcNode->addAttribute('xsi:schemaLocation', 'http://www.openarchives.org/OAI/2.0/oai_dc/ http://www.openarchives.org/OAI/2.0/oai_dc.xsd');

                        $dcNode->addChild('dc:title', htmlspecialchars($article->title), 'http://purl.org/dc/elements/1.1/');
                        
                        $authors = $article->authors ?? [];
                        foreach ($authors as $author) {
                            $dcNode->addChild('dc:creator', htmlspecialchars($author), 'http://purl.org/dc/elements/1.1/');
                        }

                        $dcNode->addChild('dc:subject', htmlspecialchars($article->keywords), 'http://purl.org/dc/elements/1.1/');
                        $dcNode->addChild('dc:description', htmlspecialchars($article->abstract), 'http://purl.org/dc/elements/1.1/');
                        $dcNode->addChild('dc:publisher', htmlspecialchars($article->publisher), 'http://purl.org/dc/elements/1.1/');
                        $dcNode->addChild('dc:date', $article->published_date ? $article->published_date->format('Y-m-d') : '', 'http://purl.org/dc/elements/1.1/');
                        $dcNode->addChild('dc:type', 'Text', 'http://purl.org/dc/elements/1.1/');
                        $dcNode->addChild('dc:format', 'application/pdf', 'http://purl.org/dc/elements/1.1/');
                        $dcNode->addChild('dc:identifier', route('article.show', ['slug' => $article->slug]), 'http://purl.org/dc/elements/1.1/');
                        
                        if ($article->doi) {
                            $dcNode->addChild('dc:identifier', $article->doi_url, 'http://purl.org/dc/elements/1.1/');
                        }
                    }
                }
                break;

            case 'GetRecord':
                if ($metadataPrefix && $metadataPrefix !== 'oai_dc') {
                    $error = $xml->addChild('error', 'The metadataPrefix is not supported.');
                    $error->addAttribute('code', 'cannotDisseminateFormat');
                    break;
                }

                if (!$identifier) {
                    $error = $xml->addChild('error', 'Missing identifier parameter.');
                    $error->addAttribute('code', 'badArgument');
                    break;
                }

                $parts = explode(':', $identifier);
                $id = end($parts);

                $article = Article::with('journal')->find($id);
                if (!$article || $article->status !== 'published') {
                    $error = $xml->addChild('error', 'The identifier is not valid.');
                    $error->addAttribute('code', 'idDoesNotExist');
                    break;
                }

                $getRecordNode = $xml->addChild('GetRecord');
                $recordNode = $getRecordNode->addChild('record');
                
                // Header
                $header = $recordNode->addChild('header');
                $header->addChild('identifier', 'oai:repo.cib.institute:' . $article->id);
                $header->addChild('datestamp', $article->updated_at->toIso8601String());
                if ($article->journal) {
                    $header->addChild('setSpec', $article->journal->slug);
                }

                // Metadata
                $metadata = $recordNode->addChild('metadata');
                
                // Dublin Core
                $dcNode = $metadata->addChild('oai_dc:dc', null, 'http://www.openarchives.org/OAI/2.0/oai_dc/');
                $dcNode->addAttribute('xmlns:oai_dc', 'http://www.openarchives.org/OAI/2.0/oai_dc/');
                $dcNode->addAttribute('xmlns:dc', 'http://purl.org/dc/elements/1.1/');
                $dcNode->addAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
                $dcNode->addAttribute('xsi:schemaLocation', 'http://www.openarchives.org/OAI/2.0/oai_dc/ http://www.openarchives.org/OAI/2.0/oai_dc.xsd');

                $dcNode->addChild('dc:title', htmlspecialchars($article->title), 'http://purl.org/dc/elements/1.1/');
                
                $authors = $article->authors ?? [];
                foreach ($authors as $author) {
                    $dcNode->addChild('dc:creator', htmlspecialchars($author), 'http://purl.org/dc/elements/1.1/');
                }

                $dcNode->addChild('dc:subject', htmlspecialchars($article->keywords), 'http://purl.org/dc/elements/1.1/');
                $dcNode->addChild('dc:description', htmlspecialchars($article->abstract), 'http://purl.org/dc/elements/1.1/');
                $dcNode->addChild('dc:publisher', htmlspecialchars($article->publisher), 'http://purl.org/dc/elements/1.1/');
                $dcNode->addChild('dc:date', $article->published_date ? $article->published_date->format('Y-m-d') : '', 'http://purl.org/dc/elements/1.1/');
                $dcNode->addChild('dc:type', 'Text', 'http://purl.org/dc/elements/1.1/');
                $dcNode->addChild('dc:format', 'application/pdf', 'http://purl.org/dc/elements/1.1/');
                $dcNode->addChild('dc:identifier', route('article.show', ['slug' => $article->slug]), 'http://purl.org/dc/elements/1.1/');
                
                if ($article->doi) {
                    $dcNode->addChild('dc:identifier', $article->doi_url, 'http://purl.org/dc/elements/1.1/');
                }
                break;

            default:
                $error = $xml->addChild('error', 'The verb is not supported.');
                $error->addAttribute('code', 'badVerb');
                break;
        }

        return Response::make($xml->asXML(), 200, ['Content-Type' => 'application/xml']);
    }
}
