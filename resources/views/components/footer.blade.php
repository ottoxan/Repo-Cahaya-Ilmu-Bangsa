<footer class="mt-20 border-t border-white/10 bg-[#07131B] text-slate-300">
    <div class="mx-auto max-w-[90vw] px-4 py-12 sm:px-6 lg:px-8 lg:py-16">
        <div class="grid grid-cols-1 gap-8 md:grid-cols-4 lg:gap-12">

            <!-- Brand Info -->
            
            <div class="flex h-30 w-auto">
                <img src="{{ asset('assets/images/footer_logo.svg') }}" alt="logo">
            </div>
            

            <!-- Quick Navigation -->
            <div>
                <h4 class="mb-4 text-xs font-bold uppercase tracking-wider text-orange-400">Navigasi Utama</h4>
                <ul class="space-y-2.5 text-xs">
                    <li><a href="{{ route('home') }}" class="transition-colors hover:text-white">Beranda</a></li>
                    <li><a href="{{ route('search') }}" class="transition-colors hover:text-white">Eksplorasi Artikel</a></li>
                </ul>
            </div>

            <!-- Services & Links -->
            <div>
                <h4 class="mb-4 text-xs font-bold uppercase tracking-wider text-orange-400">Layanan & Jurnal</h4>
                <ul class="space-y-2.5 text-xs">
                    <li>
                        <a href="https://journal.cib.institute" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 transition-colors hover:text-white">
                            <span>Jurnal CIB Institute</span>
                            <svg class="h-3 w-3 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                        </a>
                    </li>
                    <li>
                        <a href="https://loa.jurnalcib.com/" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 transition-colors hover:text-white">
                            <span>Cek LoA (Letter of Acceptance)</span>
                            <svg class="h-3 w-3 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                        </a>
                    </li>
                    <li>
                        <a href="/admin" class="transition-colors hover:text-white">Portal Penulis & Editor</a>
                    </li>
                </ul>
            </div>

        </div>
    </div>

    <!-- Bottom Credit Bar -->
    <div class="py-4">
        <div class="mx-auto flex max-w-[90vw] flex-col items-center justify-between gap-2 px-4 text-xs text-slate-400 sm:flex-row sm:px-6 lg:px-8">
            <div>
                &copy; 2027 Cahaya Ilmu Bangsa. All rights reserved.
            </div>
            <div class="flex items-center gap-1.5 font-medium">
                <span>Developed by</span>
                <span class="font-bold text-orange-400">RyuDevs</span>
            </div>
        </div>
    </div>
</footer>
