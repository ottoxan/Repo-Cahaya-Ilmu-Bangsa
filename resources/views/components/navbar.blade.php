<header class="sticky top-0 z-50 w-full">
    <div id="navbar-container" 
         class="max-w-7xl mx-auto flex items-center justify-between gap-4 bg-white/95 backdrop-blur-md rounded-full border-b border-slate-100/80 p-2 my-2 sm:py-3 sm:px-5 transition-all duration-300 [&.is-scrolled]:shadow-xl [&.is-scrolled]:shadow-slate-950/10 [&.is-scrolled]:bg-white/90 [&.is-scrolled]:backdrop-blur-xl [&.is-scrolled]:border-slate-200/80">
        
        <!-- Brand Logo -->
        <a href="{{ route('home') }}" class="flex items-center gap-3 group">
            <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-xl bg-slate-950 group-hover:bg-orange-600 flex items-center justify-center text-white font-bold shadow-md group-hover:scale-105 transition-all">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>
            <div class="flex flex-col">
                <span class="font-extrabold text-sm sm:text-base text-slate-950 group-hover:text-orange-600 font-heading leading-tight tracking-tight transition-colors">
                    cahaya ilmu
                </span>
                <span class="font-extrabold text-sm sm:text-base text-slate-950 group-hover:text-orange-600 font-heading leading-tight tracking-tight -mt-1 transition-colors">
                    bangsa
                </span>
            </div>
        </a>

        <!-- Navigation Links & Right Actions -->
        <div class="flex items-center gap-6 sm:gap-10">
            <!-- Navigation Links -->
            <nav class="hidden md:flex items-center gap-8 text-xs sm:text-sm font-semibold text-slate-600">
                <a href="{{ route('home') }}" 
                   class="transition-colors hover:text-orange-600 {{ request()->routeIs('home') ? 'text-orange-600 font-bold' : '' }}">
                    Beranda
                </a>
                <a href="{{ route('search') }}" 
                   class="transition-colors hover:text-orange-600 {{ request()->routeIs('search') ? 'text-orange-600 font-bold' : '' }}">
                    Artikel & Riset
                </a>
                <a href="{{ route('search') }}?category=Jurnal" 
                   class="transition-colors hover:text-orange-600">
                    Jurnal
                </a>
                <a href="{{ route('article.show', ['slug' => 'sample-article']) }}" 
                   class="transition-colors hover:text-orange-600 {{ request()->routeIs('article.show') ? 'text-orange-600 font-bold' : '' }}">
                    Tentang Kami
                </a>
            </nav>

            <!-- Auth Navigation Actions -->
            @if (Route::has('login'))
                <div class="flex items-center gap-3 sm:gap-4">
                    @auth
                        <a href="{{ url('/admin') }}" 
                           class="px-6 py-2.5 rounded-full bg-slate-950 hover:bg-orange-600 text-white font-semibold text-xs sm:text-sm shadow-md transition-all transform hover:scale-105 active:scale-95 whitespace-nowrap">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" 
                           class="text-xs sm:text-sm font-semibold text-slate-700 hover:text-orange-600 transition-colors px-2 py-1">
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" 
                               class="px-6 py-2.5 rounded-full bg-slate-950 hover:bg-orange-600 text-white font-semibold text-xs sm:text-sm shadow-md transition-all transform hover:scale-105 active:scale-95 whitespace-nowrap">
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
    (function () {
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

            window.addEventListener('scroll', handleScroll, { passive: true });
            handleScroll();
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initStickyNavbar);
        } else {
            initStickyNavbar();
        }
    })();
</script>
