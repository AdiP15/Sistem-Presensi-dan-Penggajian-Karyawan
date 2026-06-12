@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 sm:p-10 rounded-[2rem] shadow-sm border border-slate-100 relative overflow-hidden">
    <!-- Decor -->
    <div class="absolute top-0 left-0 w-full h-2 bg-violet-500 pointer-events-none"></div>

    <div class="mb-8 border-b border-slate-100 pb-6 flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-extrabold text-slate-700 tracking-tight">Edit Kredensial Administrator</h2>
            <p class="text-slate-500 text-sm mt-1 font-medium">Perbarui informasi dasar dan hak akses sistem.</p>
        </div>
        <div class="w-12 h-12 bg-slate-50 rounded-2xl border border-slate-200 flex items-center justify-center text-slate-600 shadow-sm">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
        </div>
    </div>

    <form action="{{ route('admin.users.update', $admin->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6 lg:space-y-8">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-3 uppercase tracking-wider text-[11px]">Foto Profil Administratif</label>
            <div class="flex items-center space-x-5">
                <div class="shrink-0">
                    @if($admin->foto_profil)
                        <img class="h-20 w-20 object-cover rounded-2xl border-4 border-slate-50 shadow-sm" src="{{ $admin->foto_profil }}" alt="Foto Profil">
                    @else
                        <div class="h-20 w-20 rounded-2xl bg-gradient-to-tr from-slate-800 to-slate-900 flex items-center justify-center text-white font-black text-2xl uppercase shadow-inner border-4 border-slate-50">
                            {{ substr($admin->name, 0, 1) }}
                        </div>
                    @endif
                </div>
                <label class="block flex-1 border border-slate-200 border-dashed rounded-2xl p-3 hover:bg-slate-50 transition-colors cursor-pointer group">
                    <div class="flex items-center gap-4">
                        <div class="p-2 bg-slate-800 text-white rounded-lg group-hover:bg-slate-800 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div>
                            <input type="file" name="foto_profil" class="block w-full text-sm text-slate-500 file:mr-0 file:my-0 file:p-0 file:border-0 file:bg-transparent file:text-slate-700 file:font-bold hover:file:underline cursor-pointer"/>
                            <span class="text-[11px] text-slate-400 mt-1 block">Abaikan jika tidak ingin mengubah foto.</span>
                        </div>
                    </div>
                </label>
            </div>
        </div>

        <div class="bg-violet-50/50 p-6 rounded-2xl border border-violet-100 space-y-5">
            <h3 class="text-xs font-bold text-violet-500 uppercase tracking-widest mb-4">Informasi Kredensial Utama</h3>
            
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap</label>
                <input type="text" name="name" value="{{ $admin->name }}" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-violet-500 outline-none transition-shadow shadow-sm text-slate-700 font-medium" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Username Administrator</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 font-mono text-sm">@</div>
                        <input type="text" name="username" value="{{ $admin->username }}" class="w-full pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-violet-500 outline-none transition-shadow shadow-sm text-slate-700 font-medium" required>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Setel Ulang Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <input type="password" name="password" class="w-full pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-violet-500 outline-none transition-shadow shadow-sm text-slate-700 font-medium placeholder-slate-300" placeholder="Biarkan kosong jika tetap">
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-6 flex justify-end items-center space-x-4 border-t border-slate-100 mt-4">
            <a href="{{ route('admin.users.index') }}" class="px-6 py-3 bg-white border border-slate-200 text-slate-600 font-bold rounded-xl hover:bg-slate-50 hover:text-slate-900 transition-colors">Batal</a>
            <button type="submit" class="px-8 py-3 bg-violet-500 text-white font-bold rounded-xl hover:bg-violet-400 shadow-xl shadow-emerald-500/30 transition-all transform hover:-translate-y-0.5 border border-transparent">
                Perbarui Admin
            </button>
        </div>
    </form>
</div>
@endsection
