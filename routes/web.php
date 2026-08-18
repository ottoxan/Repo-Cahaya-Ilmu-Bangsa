<?php

use Illuminate\Support\Facades\Route;
use App\Models\Article;
use App\Models\ArticleView;
use App\Models\DownloadLog;
use Illuminate\Http\Request;

Route::get('/', function () {
    $articles = Article::with('journal')
        ->where('status', 'published')
        ->latest('published_date')
        ->take(6)
        ->get();
    return view('home', compact('articles'));
})->name('home');

Route::get('/search', function (Request $request) {
    $query = $request->query('q');
    $category = $request->query('category');
    $journalId = $request->query('journal_id');

    $articlesQuery = Article::with('journal')
        ->where('status', 'published');

    if (!empty($query)) {
        $articlesQuery->where(function ($q) use ($query) {
            $q->where('title', 'like', '%' . $query . '%')
              ->orWhere('abstract', 'like', '%' . $query . '%')
              ->orWhere('keywords', 'like', '%' . $query . '%')
              ->orWhere('authors', 'like', '%' . $query . '%');
        });
    }

    if (!empty($category)) {
        $articlesQuery->where('category', $category);
    }

    if (!empty($journalId)) {
        $articlesQuery->where('journal_id', $journalId);
    }

    $articles = $articlesQuery->latest('published_date')->paginate(10)->withQueryString();

    return view('search', compact('articles', 'query', 'category', 'journalId'));
})->name('search');

Route::get('/article/{slug?}', function ($slug = null) {
    if (empty($slug)) {
        return redirect()->route('home');
    }

    $articleModel = Article::where('slug', $slug)->firstOrFail();

    // Log the view statistic
    try {
        ArticleView::create([
            'article_id' => $articleModel->id,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    } catch (\Throwable $e) {
        \Illuminate\Support\Facades\Log::error('Failed to log article view: ' . $e->getMessage());
    }

    // Convert model to array and inject properties expected by show.blade.php
    $articleData = $articleModel->toArray();
    $articleData['doi_url'] = $articleModel->doi_url;
    $articleData['pdf_url'] = route('article.download', ['slug' => $articleModel->slug]);
    $articleData['date_formatted'] = $articleModel->published_date ? $articleModel->published_date->translatedFormat('j F Y') : '';
    $articleData['date'] = $articleModel->published_date ? $articleModel->published_date->format('Y/m/d') : '';
    $articleData['year'] = $articleModel->published_date ? $articleModel->published_date->format('Y') : '';
    $articleData['journal_url'] = $articleModel->ojs_url ?: ($articleModel->journal?->link ?? '#');
    $articleData['journal'] = $articleModel->journal?->name ?? 'Jurnal Musytari';
    
    // Fallback indexes
    $articleData['language'] = 'id';
    $articleData['language_name'] = 'Indonesia (id)';
    $articleData['indexing'] = ['OpenAIRE', 'Zenodo', 'Google Scholar'];

    return view('articles.show', ['article' => $articleData]);
})->name('article.show');

Route::get('/article/{slug}/download', function ($slug) {
    $articleModel = Article::where('slug', $slug)->firstOrFail();

    // Log the download statistic
    try {
        DownloadLog::create([
            'article_id' => $articleModel->id,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    } catch (\Throwable $e) {
        \Illuminate\Support\Facades\Log::error('Failed to log article download: ' . $e->getMessage());
    }

    // Redirect to the actual public file link (symlinked)
    return redirect($articleModel->pdf_url);
})->name('article.download');

Route::get('/login-redirect', function () {
    $loaUrl = env('LOA_URL', 'http://localhost:8000');
    $callbackUrl = route('sso.callback');
    return redirect($loaUrl . '/sso/login?redirect=' . urlencode($callbackUrl));
})->name('login');

Route::get('/register-redirect', function () {
    $loaUrl = env('LOA_URL', 'http://localhost:8000');
    return redirect($loaUrl . '/register');
})->name('register');

// SSO Client Callback route
Route::get('/sso/callback', function (\Illuminate\Http\Request $request) {
    $userId = $request->query('user_id');
    $expiresAt = $request->query('expires_at');
    $signature = $request->query('signature');

    if (!$userId || !$expiresAt || !$signature) {
        return abort(400, 'Parameter SSO tidak lengkap.');
    }

    // Check expiration
    if (now()->timestamp > (int) $expiresAt) {
        return abort(403, 'Token SSO telah kedaluwarsa.');
    }

    // Validate signature
    $ssoSecret = env('SSO_SECRET', 'cib_sso_secret_key_2026_jwt');
    $expectedSignature = hash_hmac('sha256', $userId . '|' . $expiresAt, $ssoSecret);

    if (!hash_equals($expectedSignature, $signature)) {
        return abort(403, 'Signature SSO tidak valid.');
    }

    // Find user in LOA
    $user = \App\Models\User::find($userId);
    if (!$user) {
        return abort(404, 'User tidak ditemukan di database master LOA.');
    }

    // Log the user in
    \Illuminate\Support\Facades\Auth::login($user, true);

    // Redirect to intended route or admin dashboard
    $intended = session()->pull('url.intended', url('/admin'));

    return redirect($intended);
})->name('sso.callback');


// API endpoint for article publishing from LOA/OJS
Route::post('/api/v1/articles/publish', [\App\Http\Controllers\Api\ArticleApiController::class, 'publish'])
    ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class]);


// Academic Metadata Routes (OAI-PMH & Sitemap)
Route::get('/oai', [\App\Http\Controllers\OaiPmhController::class, 'handle'])->name('oai');
Route::get('/sitemap.xml', [\App\Http\Controllers\SitemapController::class, 'sitemap'])->name('sitemap');
Route::get('/robots.txt', [\App\Http\Controllers\SitemapController::class, 'robots'])->name('robots');
