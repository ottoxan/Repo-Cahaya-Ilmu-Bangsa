<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ArticleApiController extends Controller
{
    public function publish(Request $request)
    {
        $expectedToken = env('REPO_API_TOKEN', 'cib_repo_api_token_2026');
        $token = $request->bearerToken();

        if (!$token || $token !== $expectedToken) {
            return response()->json(['message' => 'Unauthorized.'], 401);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'abstract' => 'required|string',
            'authors' => 'required|array',
            'keywords' => 'required|string',
            'journal_id' => 'required|integer',
            'doi' => 'nullable|string',
            'volume' => 'nullable|string',
            'issue' => 'nullable|string',
            'pages' => 'nullable|string',
            'published_date' => 'nullable|date',
            'pdf_path' => 'nullable|string',
            'ojs_url' => 'nullable|string',
            'category' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error.',
                'errors' => $validator->errors()
            ], 422);
        }

        $title = $request->input('title');
        $slug = Str::slug($title);

        // Check if article exists by DOI or unique title/slug
        $article = null;
        $doi = $request->input('doi');
        if (!empty($doi)) {
            $article = Article::where('doi', $doi)->first();
        }

        if (!$article) {
            $article = Article::where('slug', $slug)->first();
        }

        if (!$article) {
            $article = new Article();
        }

        $article->fill([
            'title' => $title,
            'abstract' => $request->input('abstract'),
            'authors' => $request->input('authors'),
            'keywords' => $request->input('keywords'),
            'journal_id' => $request->input('journal_id'),
            'doi' => $doi,
            'volume' => $request->input('volume'),
            'issue' => $request->input('issue'),
            'pages' => $request->input('pages'),
            'published_date' => $request->input('published_date') ?? now(),
            'pdf_path' => $request->input('pdf_path'),
            'ojs_url' => $request->input('ojs_url'),
            'category' => $request->input('category') ?? 'Pendidikan',
            'status' => 'published',
        ]);

        $article->save();

        return response()->json([
            'message' => 'Article published successfully.',
            'article' => $article
        ], 200);
    }
}
