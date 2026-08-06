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
            <nav class="hidden items-center gap-8 text-xs font-semibold text-slate-600 sm:text-sm md:flex">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-orange-600 font-bold' : '' }} transition-colors hover:text-orange-600">
                    Beranda
                </a>
                <a href="{{ route('search') }}" class="{{ request()->routeIs('search') ? 'text-orange-600 font-bold' : '' }} transition-colors hover:text-orange-600">
                    Artikel & Riset
                </a>
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

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initStickyNavbar);
        } else {
            initStickyNavbar();
        }
    })();
</script>
