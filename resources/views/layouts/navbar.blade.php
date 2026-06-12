<header class="h-20 bg-white/70 backdrop-blur-xl border-b border-slate-200/60 flex items-center justify-between px-6 lg:px-8 z-40 sticky top-0 transition-all">

    <div class="flex items-center gap-4">

        <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden text-slate-500 hover:text-violet-500 focus:outline-none transition-colors p-2 rounded-xl hover:bg-violet-50 cursor-pointer">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h7"></path></svg>
        </button>

        <h2 class="text-xl font-extrabold text-slate-700 tracking-tight hidden md:block">
            @if(request()->routeIs('admin.dashboard') || request()->routeIs('karyawan.dashboard')) Dashboard Overview
            @elseif(request()->routeIs('admin.karyawan.*')) Manajemen Karyawan
            @elseif(request()->routeIs('admin.users.*')) Data Admin
            @elseif(request()->routeIs('admin.gaji.*') || request()->routeIs('karyawan.gaji.*')) Siklus Penggajian
            @elseif(request()->routeIs('admin.presensi.*') || request()->routeIs('karyawan.presensi.*')) Sistem Presensi
            @else Sistem Terpadu
            @endif
        </h2>
    </div>

    <div class="flex items-center gap-4 md:gap-6">


        <div class="h-6 w-px bg-slate-200 hidden md:block"></div>

        <div class="relative" x-data="{ dropdownOpen: false }">
            <button @click="dropdownOpen = !dropdownOpen" @click.outside="dropdownOpen = false" class="flex items-center gap-3 focus:outline-none group bg-white border border-slate-200 hover:border-emerald-300 px-2 py-1.5 rounded-full pr-4 transition-all shadow-sm hover:shadow">
                <div class="h-8 w-8 rounded-full bg-gradient-to-tr from-emerald-500 to-fuchsia-400 shadow-inner flex items-center justify-center text-white font-bold text-sm uppercase">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="text-left hidden sm:block">
                    <div class="text-sm font-extrabold text-slate-700 group-hover:text-violet-500 transition leading-tight">{{ Auth::user()->name }}</div>
                    <div class="text-[10px] text-slate-500 font-bold uppercase tracking-wider capitalize">{{ Auth::user()->role }}</div>
                </div>
                <svg :class="{'rotate-180': dropdownOpen}" class="w-4 h-4 text-slate-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>

            <div x-show="dropdownOpen"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 style="display: none;"
                 class="absolute ring-1 ring-slate-900/5 right-0 mt-3 w-56 bg-white rounded-2xl shadow-xl overflow-hidden z-50">

                <div class="px-4 py-3 border-b border-slate-100 sm:hidden bg-slate-50/80">
                    <p class="text-sm font-extrabold text-slate-700">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest mt-0.5">{{ Auth::user()->role }}</p>
                </div>

                <div class="p-2 space-y-1">
                    @if(Auth::user()->role == 'admin')
                    <a href="{{ route('admin.users.edit', Auth::id()) }}" class="flex items-center px-3 py-2 rounded-xl text-sm font-semibold text-slate-600 hover:bg-violet-50 hover:text-emerald-700 transition">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Edit Profil
                    </a>
                    @endif

                    <div class="border-t border-slate-100 my-1"></div>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center px-3 py-2 rounded-xl text-sm text-red-600 hover:bg-red-50 hover:text-red-700 transition font-bold">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            Sign Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
