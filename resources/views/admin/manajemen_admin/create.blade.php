@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 sm:p-10 rounded-[2rem] shadow-sm border border-slate-100 relative overflow-hidden">
    <!-- Decor -->
    <div class="absolute top-0 left-0 w-full h-2 bg-slate-800 pointer-events-none"></div>

    <div class="mb-8 border-b border-slate-100 pb-6 flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-extrabold text-slate-700 tracking-tight">Administrator Baru</h2>
            <p class="text-slate-500 text-sm mt-1 font-medium">Beri akses dashboard dan kuasa sistem ke pengguna baru.</p>
        </div>
        <div class="w-12 h-12 bg-slate-50 rounded-2xl border border-slate-200 flex items-center justify-center text-slate-600 shadow-sm">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
        </div>
    </div>

    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 lg:space-y-8">
        @csrf

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-3 uppercase tracking-wider text-[11px]">Foto Profil Administratif</label>
            <div class="flex items-center space-x-5">
                <div class="shrink-0 relative group cursor-pointer">
                    <div class="h-20 w-20 object-cover rounded-2xl bg-slate-50 border-2 border-dashed border-slate-300 flex items-center justify-center text-slate-400 group-hover:border-slate-800 group-hover:bg-slate-100 transition-colors">
                        <svg class="h-8 w-8 group-hover:text-slate-700 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                </div>
                <label class="block flex-1">
                    <span class="sr-only">Choose profile photo</span>
                    <input type="file" name="foto_profil" class="block w-full text-sm text-slate-500
                        file:mr-4 file:py-2.5 file:px-5
                        file:rounded-xl file:border-0
                        file:text-sm file:font-bold
                        file:bg-slate-800 file:text-white
                        hover:file:bg-slate-800 transition-colors cursor-pointer shadow-sm
                    "/>
                    <p class="text-xs text-slate-400 mt-2 font-medium">Opsional. Maksimal 2MB, format JPG/PNG.</p>
                </label>
            </div>
        </div>

        <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100 space-y-5">
            <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">Informasi Kredensial Akses</h3>
            
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap</label>
                <input type="text" name="name" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900 focus:border-slate-900 outline-none transition-shadow shadow-sm text-slate-700 font-medium" required placeholder="Contoh: Admin Utama">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Username Administrator</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 font-mono text-sm">@</div>
                        <input type="text" name="username" class="w-full pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900 focus:border-slate-900 outline-none transition-shadow shadow-sm text-slate-700 font-medium" required placeholder="adminbaru">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Password Login</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <input type="password" name="password" class="w-full pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900 focus:border-slate-900 outline-none transition-shadow shadow-sm text-slate-700 font-medium" required placeholder="Minimal 6 karakter">
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-6 flex justify-end items-center space-x-4 border-t border-slate-100 mt-4">
            <a href="{{ route('admin.users.index') }}" class="px-6 py-3 bg-white border border-slate-200 text-slate-600 font-bold rounded-xl hover:bg-slate-50 hover:text-slate-900 transition-colors">Batal</a>
            <button type="submit" class="px-8 py-3 bg-slate-800 text-white font-bold rounded-xl hover:bg-slate-800 shadow-xl shadow-slate-900/20 transition-all transform hover:-translate-y-0.5 border border-transparent">
                Tambah Admin
            </button>
        </div>
    </form>
</div>
@endsection
