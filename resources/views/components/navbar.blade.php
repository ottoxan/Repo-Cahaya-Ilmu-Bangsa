<header class="sticky top-0 z-50 w-full">
    <div id="navbar-container"
        class="mx-auto my-2 flex max-w-[90vw] items-center justify-between gap-4 rounded-full border-b border-slate-100/80 bg-white/95 p-2 backdrop-blur-md transition-all duration-300 sm:px-5 sm:py-3 [&.is-scrolled]:border-slate-200/80 [&.is-scrolled]:bg-white/90 [&.is-scrolled]:shadow-xl [&.is-scrolled]:shadow-slate-950/10 [&.is-scrolled]:backdrop-blur-xl">

        <!-- Brand Logo -->
        <a href="{{ route('home') }}" class="group flex items-center gap-3">
            <div class="flex h-8 w-8 items-center justify-center transition-all group-hover:scale-105 sm:h-9 sm:w-9">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo CIB">
            </div>
            <div class="flex flex-col">
                <span class="font-heading text-sm font-extrabold leading-tight tracking-tight text-slate-950 transition-colors group-hover:text-orange-600 sm:text-base">
                    cahaya ilmu
                </span>
                <span class="font-heading -mt-1 text-sm font-extrabold leading-tight tracking-tight text-slate-950 transition-colors group-hover:text-orange-600 sm:text-base">
                    bangsa
                </span>
            </div>
        </a>

        <!-- Navigation Links & Right Actions -->
        <div class="flex items-center gap-6 sm:gap-10">
            <!-- Navigation Links -->
            <nav class="hidden items-center gap-6 text-xs font-semibold text-slate-600 transition-all duration-300 sm:gap-8 sm:text-sm md:flex">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-orange-600 font-bold' : '' }} whitespace-nowrap transition-colors hover:text-orange-600">
                    Beranda
                </a>
                <a href="{{ route('search') }}" class="{{ request()->routeIs('search') ? 'text-orange-600 font-bold' : '' }} whitespace-nowrap transition-colors hover:text-orange-600">
                    Artikel & Riset
                </a>
                <!-- Inline Expanding Search Component -->
                <div id="nav-search-wrapper" class="relative flex items-center transition-all duration-300">
                    <!-- Search Toggle Button -->
                    <button id="nav-search-toggle" type="button" aria-label="Buka Pencarian"
                        class="flex items-center gap-2 rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-semibold text-slate-600 transition-all hover:border-orange-300 hover:bg-orange-50 hover:text-orange-600 focus:outline-none sm:text-sm shrink-0">
                        <svg class="h-4 w-4 text-slate-500 transition-colors group-hover:text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <span>Cari</span>
                    </button>

                    <!-- Expanding Search Form (Inline width transition pushes nav items left) -->
                    <form id="nav-search-form" action="{{ route('search') }}" method="GET"
                        class="pointer-events-none flex w-0 items-center overflow-hidden rounded-full border-0 bg-white opacity-0 shadow-xl shadow-orange-500/10 transition-all duration-300 ease-in-out shrink-0">
                        <div class="flex w-56 items-center gap-2 rounded-full border border-orange-400 px-3.5 py-1.5 sm:w-72 md:w-80">
                            <svg class="h-4 w-4 shrink-0 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <input id="nav-search-input" type="text" name="q" value="{{ request('q') }}" placeholder="Cari artikel, jurnal, DOI..."
                                class="w-full bg-transparent text-xs text-slate-900 placeholder-slate-400 focus:outline-none sm:text-sm">
                            <button type="submit" aria-label="Cari" class="shrink-0 rounded-full bg-orange-600 p-1 text-white transition-colors hover:bg-orange-700">
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </button>
                            <button id="nav-search-close" type="button" aria-label="Tutup Pencarian" class="shrink-0 p-1 text-slate-400 hover:text-slate-600">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </nav>

            <!-- Auth Navigation Actions -->
            @if (Route::has('login'))
                <div class="flex items-center gap-3 sm:gap-4">
                    @auth
                        <a href="{{ url('/admin') }}"
                            class="transform whitespace-nowrap rounded-full bg-slate-950 px-6 py-2.5 text-xs font-semibold text-white shadow-md transition-all hover:scale-105 hover:bg-orange-600 active:scale-95 sm:text-sm">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-2 py-1 text-xs font-semibold text-slate-700 transition-colors hover:text-orange-600 sm:text-sm">
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="transform whitespace-nowrap rounded-full bg-slate-950 px-6 py-2.5 text-xs font-semibold text-white shadow-md transition-all hover:scale-105 hover:bg-orange-600 active:scale-95 sm:text-sm">
                                Register
                            </a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>

    </div>
</header>

<script>
    (function() {
        function initStickyNavbar() {
            const navDiv = document.getElementById('navbar-container');
            if (!navDiv) return;

            function handleScroll() {
                if (window.scrollY > 20) {
                    navDiv.classList.add('is-scrolled');
                } else {
                    navDiv.classList.remove('is-scrolled');
                }
            }

            window.addEventListener('scroll', handleScroll, {
                passive: true
            });
            handleScroll();
        }

        function initNavSearch() {
            const toggleBtn = document.getElementById('nav-search-toggle');
            const searchForm = document.getElementById('nav-search-form');
            const searchInput = document.getElementById('nav-search-input');
            const closeBtn = document.getElementById('nav-search-close');
            const wrapper = document.getElementById('nav-search-wrapper');

            if (!toggleBtn || !searchForm || !searchInput || !closeBtn) return;

            function openSearch() {
                toggleBtn.classList.add('hidden');
                searchForm.classList.remove('w-0', 'opacity-0', 'pointer-events-none');
                searchForm.classList.add('w-56', 'sm:w-72', 'md:w-80', 'opacity-100', 'pointer-events-auto');
                setTimeout(() => searchInput.focus(), 150);
            }

            function closeSearch() {
                searchForm.classList.remove('w-56', 'sm:w-72', 'md:w-80', 'opacity-100', 'pointer-events-auto');
                searchForm.classList.add('w-0', 'opacity-0', 'pointer-events-none');
                setTimeout(() => toggleBtn.classList.remove('hidden'), 200);
            }

            toggleBtn.addEventListener('click', openSearch);
            closeBtn.addEventListener('click', closeSearch);

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && searchForm.classList.contains('opacity-100')) {
                    closeSearch();
                }
            });

            document.addEventListener('click', (e) => {
                if (wrapper && !wrapper.contains(e.target) && searchForm.classList.contains('opacity-100')) {
                    closeSearch();
                }
            });
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => {
                initStickyNavbar();
                initNavSearch();
            });
        } else {
            initStickyNavbar();
            initNavSearch();
        }
    })();
</script>
