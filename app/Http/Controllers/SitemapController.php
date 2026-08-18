<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SitemapController extends Controller
{
    public function sitemap()
    {
        $articles = Article::where('status', 'published')->latest('published_date')->get();

        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"/>');

        // Add home
        $url = $xml->addChild('url');
        $url->addChild('loc', route('home'));
        $url->addChild('lastmod', now()->toIso8601String());
        $url->addChild('changefreq', 'daily');
        $url->addChild('priority', '1.0');

        // Add search
        $url = $xml->addChild('url');
        $url->addChild('loc', route('search'));
        $url->addChild('lastmod', now()->toIso8601String());
        $url->addChild('changefreq', 'weekly');
        $url->addChild('priority', '0.8');

        // Add articles
        foreach ($articles as $article) {
            $url = $xml->addChild('url');
            $url->addChild('loc', route('article.show', ['slug' => $article->slug]));
            $url->addChild('lastmod', $article->updated_at->toIso8601String());
            $url->addChild('changefreq', 'monthly');
            $url->addChild('priority', '0.6');
        }

        return Response::make($xml->asXML(), 200, ['Content-Type' => 'application/xml']);
    }

    public function robots()
    {
        $sitemapUrl = route('sitemap');
        
        $content = "User-agent: *\n";
        $content .= "Allow: /\n\n";
        $content .= "Sitemap: {$sitemapUrl}\n";

        return Response::make($content, 200, ['Content-Type' => 'text/plain']);
    }
}
