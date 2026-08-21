<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png') }}">
    <title>{{ $title ?? 'Cahaya Ilmu Bangsa' }} - Repositori & Portal Riset</title>
    <meta name="description" content="{{ $description ?? 'Repositori naskah, jurnal ilmiah, dan artikel sains Cahaya Ilmu Bangsa.' }}">
    {{ $meta ?? '' }}

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .font-heading {
            font-family: 'Outfit', sans-serif;
        }

        /* Scroll Reveal Slide-In Animations */
        .reveal {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }
        .reveal.is-visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        .delay-100 { transition-delay: 100ms; }
        .delay-200 { transition-delay: 200ms; }
        .delay-300 { transition-delay: 300ms; }
        .delay-400 { transition-delay: 400ms; }
    </style>

    @stack('styles')
</head>
<body class="text-slate-800 min-h-screen flex flex-col selection:bg-slate-900 selection:text-white antialiased">

    <!-- Fullscreen Book Loader Overlay -->
    <div id="page-preloader" 
         class="fixed inset-0 z-[9999] flex flex-col items-center justify-center bg-white transition-opacity duration-700 ease-out">
        <div class="flex flex-col items-center gap-4">
            <img src="{{ asset('assets/images/Book Loader.gif') }}" 
                 alt="Memuat Cahaya Ilmu Bangsa..." 
                 class="w-36 sm:w-48 h-auto object-contain">
        </div>
    </div>

    <!-- Outer Container Frame -->
    <div class="w-full mx-auto bg-white flex flex-col min-h-screen">

        <!-- Navigation Header -->
        <x-navbar />

        <!-- Main Content Area -->
        <main class="flex-grow">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <x-footer />

    </div>

    <!-- Back to Top Floating Button -->
    <button id="back-to-top" aria-label="Kembali ke Atas"
        class="fixed bottom-6 right-6 z-50 flex h-11 w-11 items-center justify-center rounded-full bg-orange-600 text-white shadow-xl shadow-orange-600/30 opacity-0 pointer-events-none transition-all duration-300 hover:bg-orange-700 hover:scale-110 active:scale-95">
        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7"></path>
        </svg>
    </button>

    <script>
        (function () {
            // Preloader handler
            const loader = document.getElementById('page-preloader');
            if (loader) {
                const minDisplayTime = 700;
                const startTime = Date.now();

                function hideLoader() {
                    const elapsed = Date.now() - startTime;
                    const remaining = Math.max(0, minDisplayTime - elapsed);

                    setTimeout(function () {
                        loader.classList.add('opacity-0', 'pointer-events-none');
                        setTimeout(function () {
                            loader.remove();
                            initScrollReveal(); // Trigger scroll reveal after loader disappears
                        }, 700);
                    }, remaining);
                }

                if (document.readyState === 'complete') {
                    hideLoader();
                } else {
                    window.addEventListener('load', hideLoader);
                }
            } else {
                initScrollReveal();
            }

            // Scroll Reveal Intersection Observer
            function initScrollReveal() {
                const observerOptions = {
                    threshold: 0.1,
                    rootMargin: '0px 0px -40px 0px'
                };

                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('is-visible');
                            observer.unobserve(entry.target);
                        }
                    });
                }, observerOptions);

                document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
            }

            // Back to Top Button Handler
            const backToTopBtn = document.getElementById('back-to-top');
            if (backToTopBtn) {
                window.addEventListener('scroll', () => {
                    if (window.scrollY > 300) {
                        backToTopBtn.classList.remove('opacity-0', 'pointer-events-none');
                        backToTopBtn.classList.add('opacity-100', 'pointer-events-auto');
                    } else {
                        backToTopBtn.classList.add('opacity-0', 'pointer-events-none');
                        backToTopBtn.classList.remove('opacity-100', 'pointer-events-auto');
                    }
                }, { passive: true });

                backToTopBtn.addEventListener('click', () => {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            }
        })();
    </script>

    @stack('scripts')

    <!-- SSO Iframe Check & Dynamic Auth Synchronization -->
    <iframe id="sso-iframe" src="{{ env('LOA_URL', 'http://127.0.0.1:8000') }}/sso/iframe-check?origin={{ urlencode(url('/')) }}" style="display:none;"></iframe>

    <script>
        (function() {
            let localUserLoggedIn = {{ Auth::check() ? 'true' : 'false' }};
            const loaUrl = "{{ env('LOA_URL', 'http://127.0.0.1:8000') }}";

            window.addEventListener('message', function(event) {
                if (!event.origin.startsWith(loaUrl)) return;

                if (event.data && event.data.type === 'cib_sso_status') {
                    const sso = event.data.data;

                    const authContainer = document.getElementById('sso-auth-container');
                    const guestContainer = document.getElementById('sso-guest-container');

                    if (sso.logged_in && !localUserLoggedIn) {
                        localUserLoggedIn = true;
                        
                        // Dynamically update UI immediately
                        if (authContainer) authContainer.style.display = 'block';
                        if (guestContainer) guestContainer.style.display = 'none';

                        // Silent Auto-Login via AJAX
                        fetch('/sso/callback-ajax', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify(sso)
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (!data.success) {
                                // If sync failed, revert UI
                                localUserLoggedIn = false;
                                if (authContainer) authContainer.style.display = 'none';
                                if (guestContainer) guestContainer.style.display = 'flex';
                            }
                        })
                        .catch(() => {
                            localUserLoggedIn = false;
                            if (authContainer) authContainer.style.display = 'none';
                            if (guestContainer) guestContainer.style.display = 'flex';
                        });
                    } 
                }
            });

            // Helper to reload iframe check
            function checkSso() {
                const iframe = document.getElementById('sso-iframe');
                if (iframe) {
                    iframe.src = iframe.src;
                }
            }

            // Check on tab focus/switch
            window.addEventListener('focus', checkSso);

            // Check periodically in background every 15 seconds
            setInterval(checkSso, 15000);
        })();
    </script>
</body>
</html>
