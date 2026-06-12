<div x-show="sidebarOpen"
     @click="sidebarOpen = false"
     x-transition:enter="transition-opacity ease-linear duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity ease-linear duration-300"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 bg-slate-800/80 z-40 lg:hidden"
     style="display: none;">
</div>

<aside class="flex flex-col fixed inset-y-0 left-0 z-50 w-64 bg-slate-800 border-r border-slate-700 text-slate-300 transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0 shadow-lg"
       :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">

    <div class="relative flex items-center justify-center h-20 border-b border-slate-700 bg-slate-800 shrink-0">
        <!-- Text Logo Minimalist -->
        <div class="flex items-center gap-2">
            <span class="text-2xl font-black tracking-tighter text-white">SPP<span class="text-violet-400">.</span></span>
        </div>

        <button @click="sidebarOpen = false" class="absolute right-4 lg:hidden text-slate-400 hover:text-white focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>

    <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-1">

        <div class="px-3 mb-3 text-[10px] font-bold text-slate-500 uppercase tracking-widest">Menu Utama</div>

        @php $dashboardRoute = Auth::user()->role == 'admin' ? 'admin.dashboard' : 'karyawan.dashboard'; @endphp
        <a href="{{ route($dashboardRoute) }}"
           class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs($dashboardRoute) ? 'bg-violet-500 text-white font-semibold shadow-md shadow-violet-500/20' : 'text-slate-400 hover:bg-slate-700 hover:text-white font-medium' }}">
            <svg class="w-5 h-5 transition-colors {{ request()->routeIs($dashboardRoute) ? 'text-white' : 'text-slate-500 group-hover:text-violet-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
            <span class="ml-3">Dashboard</span>
        </a>

        @if(Auth::user()->role == 'admin')
            <div class="mt-8 px-3 mb-3 text-[10px] font-bold text-slate-500 uppercase tracking-widest">Administrator</div>

            <a href="{{ route('admin.karyawan.index') }}" class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.karyawan.*') ? 'bg-violet-500 text-white font-semibold shadow-md shadow-violet-500/20' : 'text-slate-400 hover:bg-slate-700 hover:text-white font-medium' }}">
                <svg class="w-5 h-5 {{ request()->routeIs('admin.karyawan.*') ? 'text-white' : 'text-slate-500 group-hover:text-violet-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                <span class="ml-3">Data Karyawan</span>
            </a>

            <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.users.*') ? 'bg-violet-500 text-white font-semibold shadow-md shadow-violet-500/20' : 'text-slate-400 hover:bg-slate-700 hover:text-white font-medium' }}">
                <svg class="w-5 h-5 {{ request()->routeIs('admin.users.*') ? 'text-white' : 'text-slate-500 group-hover:text-violet-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                <span class="ml-3">Data Admin</span>
            </a>

            <div x-data="{ open: {{ request()->routeIs('admin.presensi.*') ? 'true' : 'false' }} }" class="mt-1">
                <button @click="open = !open" class="w-full flex items-center justify-between px-4 py-3 rounded-xl transition-colors group {{ request()->routeIs('admin.presensi.*') ? 'bg-violet-500 text-white font-semibold shadow-md shadow-violet-500/20' : 'text-slate-400 hover:bg-slate-700 hover:text-white font-medium' }}">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 {{ request()->routeIs('admin.presensi.*') ? 'text-white' : 'text-slate-500 group-hover:text-violet-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span class="ml-3">Presensi Ruang</span>
                    </div>
                    <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform text-slate-500 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="open" x-cloak class="mt-1 pl-11 space-y-1">
                    <a href="{{ route('admin.presensi.index') }}" class="block px-3 py-2 rounded-lg text-sm {{ request()->routeIs('admin.presensi.index') ? 'text-white font-bold bg-slate-700 shadow-sm' : 'text-slate-400 hover:text-white hover:bg-slate-700/50 font-medium' }}">Harian</a>
                    <a href="{{ route('admin.presensi.rekap') }}" class="block px-3 py-2 rounded-lg text-sm {{ request()->routeIs('admin.presensi.rekap') ? 'text-white font-bold bg-slate-700 shadow-sm' : 'text-slate-400 hover:text-white hover:bg-slate-700/50 font-medium' }}">Rekap</a>
                </div>
            </div>

            <a href="{{ route('admin.gaji.index') }}" class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.gaji.*') ? 'bg-violet-500 text-white font-semibold shadow-md shadow-violet-500/20' : 'text-slate-400 hover:bg-slate-700 hover:text-white font-medium' }}">
                <svg class="w-5 h-5 {{ request()->routeIs('admin.gaji.*') ? 'text-white' : 'text-slate-500 group-hover:text-violet-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="ml-3">Penggajian</span>
            </a>
        @endif

        @if(Auth::user()->role == 'karyawan')
            <div class="mt-8 px-3 mb-3 text-[10px] font-bold text-slate-500 uppercase tracking-widest">Aktivitas Saya</div>

            <div x-data="{ open: {{ request()->routeIs('karyawan.presensi.*') ? 'true' : 'false' }} }">
                <button @click="open = !open" class="w-full flex items-center justify-between px-4 py-3 rounded-xl transition-colors group {{ request()->routeIs('karyawan.presensi.*') ? 'bg-violet-500 text-white font-semibold shadow-md shadow-violet-500/20' : 'text-slate-400 hover:bg-slate-700 hover:text-white font-medium' }}">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 transition-colors {{ request()->routeIs('karyawan.presensi.*') ? 'text-white' : 'text-slate-500 group-hover:text-violet-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        <span class="ml-3">Menu Presensi</span>
                    </div>
                    <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform text-slate-500 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="open" class="mt-1 pl-11 space-y-1">
                    <a href="{{ route('karyawan.presensi.create') }}" class="block px-3 py-2 rounded-lg text-sm {{ request()->routeIs('karyawan.presensi.create') ? 'text-white font-bold bg-slate-700 shadow-sm' : 'text-slate-400 hover:text-white hover:bg-slate-700/50 font-medium' }}">Isi Presensi</a>
                    <a href="{{ route('karyawan.presensi.riwayat') }}" class="block px-3 py-2 rounded-lg text-sm {{ request()->routeIs('karyawan.presensi.riwayat') ? 'text-white font-bold bg-slate-700 shadow-sm' : 'text-slate-400 hover:text-white hover:bg-slate-700/50 font-medium' }}">Riwayat</a>
                </div>
            </div>

            <a href="{{ route('karyawan.gaji.index') }}" class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('karyawan.gaji.*') ? 'bg-violet-500 text-white font-semibold shadow-md shadow-violet-500/20' : 'text-slate-400 hover:bg-slate-700 hover:text-white font-medium' }}">
                <svg class="w-5 h-5 {{ request()->routeIs('karyawan.gaji.*') ? 'text-white' : 'text-slate-500 group-hover:text-violet-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="ml-3">Slip Gaji</span>
            </a>
        @endif
    </nav>
</aside>
