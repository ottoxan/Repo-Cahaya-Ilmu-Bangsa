<?php

use Illuminate\Support\Facades\Route;
use App\Models\Article;
use App\Models\ArticleView;
use App\Models\DownloadLog;
use App\Models\Submission;
use Illuminate\Http\Request;

Route::get('/', function () {
    $articles = Article::with('journal')
        ->where('status', 'published')
        ->latest('published_date')
        ->take(6)
        ->get();

    $submissions = Submission::with('journal')
        ->where('status', 'Approved')
        ->where('ojs_status', 'submitted')
        ->latest('approved_date')
        ->take(6)
        ->get();

    // Merge and sort in PHP
    $merged = collect()
        ->merge($articles)
        ->merge($submissions)
        ->sortByDesc(function ($item) {
            return $item->published_date ? $item->published_date->timestamp : 0;
        })
        ->take(6);

    return view('home', ['articles' => $merged]);
})->name('home');

Route::get('/search', function (Request $request) {
    $query = $request->query('q');
    $category = $request->query('category');
    $journalId = $request->query('journal_id');

    // 1. Query Articles
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

    $articles = $articlesQuery->get();

    // 2. Query Submissions
    $submissionsQuery = Submission::with('journal')
        ->where('status', 'Approved')
        ->where('ojs_status', 'submitted');

    if (!empty($query)) {
        $submissionsQuery->where(function ($q) use ($query) {
            $q->where('title', 'like', '%' . $query . '%')
              ->orWhere('abstract', 'like', '%' . $query . '%')
              ->orWhere('keywords', 'like', '%' . $query . '%')
              ->orWhere('author_name', 'like', '%' . $query . '%');
        });
    }

    if (!empty($journalId)) {
        $submissionsQuery->where('journal_id', $journalId);
    }

    $submissions = $submissionsQuery->get();

    // Filter submissions by category in PHP since category is an accessor
    if (!empty($category)) {
        $submissions = $submissions->filter(function ($sub) use ($category) {
            return $sub->category === $category;
        });
    }

    // Merge and Sort
    $merged = collect()
        ->merge($articles)
        ->merge($submissions)
        ->sortByDesc(function ($item) {
            return $item->published_date ? $item->published_date->timestamp : 0;
        });

    // Paginate manually using LengthAwarePaginator
    $perPage = 10;
    $currentPage = request()->get('page', 1);
    $currentPageItems = $merged->slice(($currentPage - 1) * $perPage, $perPage)->values();
    
    $paginated = new \Illuminate\Pagination\LengthAwarePaginator(
        $currentPageItems,
        $merged->count(),
        $perPage,
        $currentPage,
        [
            'path' => request()->url(),
            'query' => request()->query(),
        ]
    );

    return view('search', ['articles' => $paginated, 'query' => $query, 'category' => $category, 'journalId' => $journalId]);
})->name('search');

Route::get('/article/{slug?}', function ($slug = null) {
    if (empty($slug)) {
        return redirect()->route('home');
    }

    $isSubmission = str_starts_with($slug, 'submission-');

    if ($isSubmission) {
        $id = (int) str_replace('submission-', '', $slug);
        $submission = Submission::with('journal')
            ->where('status', 'Approved')
            ->where('ojs_status', 'submitted')
            ->findOrFail($id);

        $keywords = $submission->keywords ?? '';
        $keywordsList = array_values(array_filter(array_map('trim', preg_split('/[;,]/', $keywords))));
        $tags = array_map(fn($kw) => '#' . str_replace(' ', '', $kw), $keywordsList);

        $loaUrl = env('LOA_URL', 'http://127.0.0.1:8000');
        $pdfFileUrl = $loaUrl . '/storage/' . $submission->manuscript_file;

        $volumeStr = $submission->volume ?? '';
        $volumeNum = $volumeStr;
        $issueNum = '';
        if (preg_match('/Vol\\.?\\s*(\\d+)\\s*,?\\s*No\\.?\\s*(\\d+)/i', $volumeStr, $matches)) {
            $volumeNum = $matches[1];
            $issueNum = $matches[2];
        }

        $articleData = [
            'id' => $submission->id,
            'title' => $submission->title,
            'abstract' => $submission->abstract,
            'authors' => $submission->authors,
            'author_institution' => '',
            'author_institutions' => [],
            'keywords' => $submission->keywords,
            'category' => $submission->category,
            'date_formatted' => $submission->published_date ? $submission->published_date->translatedFormat('j F Y') : '',
            'date' => $submission->published_date ? $submission->published_date->format('Y/m/d') : '',
            'year' => $submission->published_date ? $submission->published_date->format('Y') : '',
            'doi_url' => $submission->repository_redirect_url,
            'pdf_url' => route('article.download', ['slug' => $slug]),
            'pdf_preview_url' => $pdfFileUrl,
            'journal_url' => $submission->publication_link ?: ($submission->journal?->link ?? '#'),
            'journal' => $submission->journal?->name ?? 'Jurnal',
            'volume' => $volumeNum,
            'issue' => $issueNum,
            'pages' => '',
            'language' => 'id',
            'language_name' => 'Indonesia (id)',
            'indexing' => ['OpenAIRE', 'Zenodo', 'Google Scholar'],
            'publisher' => 'Cahaya Ilmu Bangsa',
            'doi' => $submission->repository_identifier,
            'references' => $submission->references ?? '',
            'tags' => $tags,
            'license' => 'Open Access (CC BY 4.0)',
            'journal_id' => $submission->journal_id,
        ];

        return view('articles.show', ['article' => $articleData]);
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

    // Parse volume/issue if they are stored as a combined string
    $volumeStr = $articleModel->volume ?? '';
    $volumeNum = $volumeStr;
    $issueNum = $articleModel->issue ?? '';
    if (preg_match('/Vol\\.?\\s*(\\d+)\\s*,?\\s*No\\.?\\s*(\\d+)/i', $volumeStr, $matches)) {
        $volumeNum = $matches[1];
        $issueNum = $matches[2];
    }
    $articleData['volume'] = $volumeNum;
    $articleData['issue'] = $issueNum;
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
    $isSubmission = str_starts_with($slug, 'submission-');

    if ($isSubmission) {
        $id = (int) str_replace('submission-', '', $slug);
        $submission = Submission::where('status', 'Approved')
            ->where('ojs_status', 'submitted')
            ->findOrFail($id);

        $loaUrl = env('LOA_URL', 'http://127.0.0.1:8000');
        return redirect($loaUrl . '/storage/' . $submission->manuscript_file);
    }

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
    $loaUrl = env('LOA_URL', 'http://127.0.0.1:8000');
    $callbackUrl = route('sso.callback');
    return redirect($loaUrl . '/sso/login?redirect=' . urlencode($callbackUrl));
})->name('login');

Route::get('/register-redirect', function () {
    $loaUrl = env('LOA_URL', 'http://127.0.0.1:8000');
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

    // Redirect to fallback parameter if present, otherwise intended
    $fallback = $request->query('fallback');
    $intended = $fallback ?: session()->pull('url.intended', url('/admin'));

    return redirect($intended);
})->name('sso.callback');


// API endpoint for article publishing from LOA/OJS
Route::post('/api/v1/articles/publish', [\App\Http\Controllers\Api\ArticleApiController::class, 'publish'])
    ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class]);


// Academic Metadata Routes (OAI-PMH & Sitemap)
Route::get('/oai', [\App\Http\Controllers\OaiPmhController::class, 'handle'])->name('oai');
Route::get('/sitemap.xml', [\App\Http\Controllers\SitemapController::class, 'sitemap'])->name('sitemap');
Route::get('/robots.txt', [\App\Http\Controllers\SitemapController::class, 'robots'])->name('robots');


// SSO AJAX Synchronization Routes
Route::post('/sso/callback-ajax', function (\Illuminate\Http\Request $request) {
    $userId = $request->input('user_id');
    $expiresAt = $request->input('expires_at');
    $signature = $request->input('signature');

    if (empty($userId) || empty($expiresAt) || empty($signature)) {
        return response()->json(['success' => false, 'message' => 'Missing parameters'], 400);
    }

    if (now()->timestamp > $expiresAt) {
        return response()->json(['success' => false, 'message' => 'Expired token'], 403);
    }

    $ssoSecret = env('SSO_SECRET', 'cib_sso_secret_key_2026_jwt');
    $expectedSignature = hash_hmac('sha256', $userId . '|' . $expiresAt, $ssoSecret);

    if (!hash_equals($expectedSignature, $signature)) {
        return response()->json(['success' => false, 'message' => 'Invalid signature'], 403);
    }

    $user = \App\Models\User::find($userId);
    if (!$user) {
        return response()->json(['success' => false, 'message' => 'User not found'], 404);
    }

    \Illuminate\Support\Facades\Auth::login($user, true);

    return response()->json(['success' => true]);
});

Route::post('/sso/logout-ajax', function () {
    \Illuminate\Support\Facades\Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return response()->json(['success' => true]);
});


// SSO Iframe check route for LOA (Auto-detect status login in background)
Route::get('/sso/iframe-check', function (\Illuminate\Http\Request $request) {
    $origin = $request->query('origin');
    if (empty($origin)) {
        return response('Origin required', 400);
    }

    $origin = urldecode($origin);

    $user = \Illuminate\Support\Facades\Auth::user();
    $data = ['logged_in' => false];

    if ($user) {
        $expiresAt = now()->addMinutes(5)->timestamp;
        $ssoSecret = env('SSO_SECRET', 'cib_sso_secret_key_2026_jwt');
        $signature = hash_hmac('sha256', $user->id . '|' . $expiresAt, $ssoSecret);

        $data = [
            'logged_in' => true,
            'user_id' => $user->id,
            'expires_at' => $expiresAt,
            'signature' => $signature,
        ];
    }

    $jsonData = json_encode($data);

    $targetUrl = env('LOA_URL', 'http://127.0.0.1:8000');
    $targetHost = parse_url($targetUrl, PHP_URL_HOST);
    $targetPort = parse_url($targetUrl, PHP_URL_PORT);
    $portSuffix = $targetPort ? ':' . $targetPort : '';
    $allowedOrigins = "http://" . $targetHost . $portSuffix . " https://" . $targetHost . $portSuffix;

    return response($jsonData ? "
        <!DOCTYPE html>
        <html>
        <body>
        <script>
            window.parent.postMessage({
                type: 'cib_sso_status',
                data: {$jsonData}
            }, '*');
        </script>
        </body>
        </html>
    " : "")
    ->header('Content-Type', 'text/html')
    ->header('Content-Security-Policy', "frame-ancestors 'self' http://127.0.0.1:8000 http://localhost:8000 " . $allowedOrigins)
    ->header('X-Frame-Options', 'ALLOWALL');
})->name('sso.iframe-check');


// SSO Single Log-Out (SLO) Route
Route::get('/sso/logout', function (\Illuminate\Http\Request $request) {
    \Illuminate\Support\Facades\Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    $redirect = $request->query('redirect');
    $sso = $request->query('sso');

    if ($sso) {
        return redirect($redirect ?: '/');
    }

    $loaUrl = env('LOA_URL', 'http://127.0.0.1:8000');
    return redirect($loaUrl . '/sso/logout?sso=true&redirect=' . urlencode($redirect ?: 'http://127.0.0.1:8001'));
})->name('sso.logout');


// SSO Local Session Check Route
Route::post('/sso/local-check', function () {
    return response()->json([
        'logged_in' => \Illuminate\Support\Facades\Auth::check()
    ]);
})->name('sso.local-check');


// Repository Identifier (DOI Custom) Redirection Route
Route::get('/{identifier}', function ($identifier) {
    $submission = \App\Models\Submission::where('repository_identifier', $identifier)->first();
    
    if ($submission && !empty($submission->repository_landing_page)) {
        return redirect($submission->repository_landing_page, 301);
    }
    
    abort(404);
})->where('identifier', '^[A-Za-z0-9]+-\\d{4}-\\d+$');
