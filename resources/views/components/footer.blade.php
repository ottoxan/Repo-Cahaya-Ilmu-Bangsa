<footer class="bg-[#07131B] text-slate-300 border-t border-white/10 mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 lg:gap-12">
            
            <!-- Brand Info -->
            <div class="md:col-span-1 space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-orange-600 to-amber-500 flex items-center justify-center text-white font-bold shadow-md shadow-orange-500/30">
                        C
                    </div>
                    <span class="font-bold text-lg text-white font-heading">Cahaya Ilmu Bangsa</span>
                </div>
                <p class="text-xs leading-relaxed text-slate-400 font-light">
                    Menyinari peradaban nusantara melalui repositori riset terakreditasi, naskah ilmiah, dan literasi kebangsaan.
                </p>
                <div class="pt-2 text-xs text-slate-500">
                    &copy; {{ date('Y') }} PT Cahaya Ilmu Bangsa. All rights reserved.
                </div>
            </div>

            <!-- Quick Navigation -->
            <div>
                <h4 class="text-xs font-bold uppercase tracking-wider text-orange-400 mb-4">Navigasi Utama</h4>
                <ul class="space-y-2.5 text-xs">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a></li>
                    <li><a href="{{ route('search') }}" class="hover:text-white transition-colors">Eksplorasi Artikel</a></li>
                    <li><a href="{{ route('search') }}?category=Pendidikan" class="hover:text-white transition-colors">Kategori Pendidikan</a></li>
                    <li><a href="{{ route('search') }}?category=Sains" class="hover:text-white transition-colors">Sains & Teknologi</a></li>
                </ul>
            </div>

            <!-- Services -->
            <div>
                <h4 class="text-xs font-bold uppercase tracking-wider text-orange-400 mb-4">Layanan Penerbitan</h4>
                <ul class="space-y-2.5 text-xs">
                    <li><a href="#" class="hover:text-white transition-colors">Kirimkan Naskah</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Pedoman Penulisan</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Hak Cipta & DOI</a></li>
                    <li><a href="/admin" class="hover:text-white transition-colors">Portal Penulis & Editor</a></li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div>
                <h4 class="text-xs font-bold uppercase tracking-wider text-orange-400 mb-4">Berlangganan Wawasan</h4>
                <p class="text-xs text-slate-400 mb-3 font-light">
                    Dapatkan buletin riset mingguan langsung di email Anda.
                </p>
                <form onsubmit="event.preventDefault(); alert('Terima kasih telah berlangganan!');" class="space-y-2">
                    <input type="email" 
                           placeholder="Alamat email Anda..." 
                           required
                           class="w-full px-3.5 py-2 text-xs bg-[#0D2432] border border-white/15 rounded-full focus:outline-none focus:ring-2 focus:ring-orange-500 text-white placeholder-slate-500">
                    <button type="submit" 
                            class="w-full py-2 px-4 text-xs font-bold text-white bg-gradient-to-r from-orange-500 to-amber-500 hover:from-orange-600 hover:to-amber-600 rounded-full transition-all shadow-md shadow-orange-500/20">
                        Berlangganan Gratis
                    </button>
                </form>
            </div>

        </div>
    </div>
</footer>
