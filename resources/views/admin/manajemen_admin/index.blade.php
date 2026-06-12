@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-700 tracking-tight">Manajemen Administrator</h1>
            <p class="text-slate-500 text-sm mt-1 font-medium">Kelola akses penuh dan konfigurasi profil untuk pengguna admin.</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="bg-slate-800 hover:bg-slate-800 text-white px-6 py-3 rounded-xl text-sm font-bold transition-all shadow-lg shadow-slate-900/20 flex items-center gap-2 transform hover:-translate-y-0.5">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
            Tambah Admin Baru
        </a>
    </div>

    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" class="bg-violet-50 border border-violet-200 text-emerald-800 px-5 py-4 rounded-2xl relative mb-6 flex items-center gap-3 shadow-sm">
            <div class="p-2 bg-emerald-100 text-violet-500 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <span class="font-semibold text-sm">{{ session('success') }}</span>
            <button @click="show = false" class="ml-auto text-emerald-500 hover:text-emerald-700 p-1"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
        </div>
    @endif
    
    @if(session('error'))
        <div x-data="{ show: true }" x-show="show" class="bg-red-50 border border-red-200 text-rose-800 px-5 py-4 rounded-2xl relative mb-6 flex items-center gap-3 shadow-sm">
            <div class="p-2 bg-red-100 text-red-600 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <span class="font-semibold text-sm">{{ session('error') }}</span>
            <button @click="show = false" class="ml-auto text-red-500 hover:text-red-700 p-1"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
        </div>
    @endif

    <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden relative">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50/80 text-slate-500 font-bold uppercase text-[10px] tracking-wider border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-5 rounded-tl-[2rem]">Profil Admin</th>
                        <th class="px-6 py-5">Kredensial</th>
                        <th class="px-6 py-5">Status Registrasi</th>
                        <th class="px-6 py-5 text-center rounded-tr-[2rem]">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100/80">
                    @foreach($admins as $admin)
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <div class="shrink-0 relative">
                                    @if($admin->foto_profil)
                                        <img class="h-12 w-12 rounded-2xl object-cover border-2 border-white shadow-sm" src="{{ $admin->foto_profil }}" alt="{{ $admin->name }}">
                                    @else
                                        <div class="h-12 w-12 rounded-2xl bg-gradient-to-tr from-slate-800 to-slate-900 flex items-center justify-center text-white font-black text-lg uppercase shadow-inner border-2 border-white">
                                            {{ substr($admin->name, 0, 1) }}
                                        </div>
                                    @endif
                                    @if(Auth::id() == $admin->id)
                                        <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-violet-500 border-2 border-white rounded-full z-10" title="Sedang Aktif"></div>
                                    @endif
                                </div>
                                <div>
                                    <span class="font-extrabold text-slate-700 text-base group-hover:text-emerald-700 transition-colors block">{{ $admin->name }}</span>
                                    @if(Auth::id() == $admin->id)
                                        <span class="text-[10px] uppercase font-bold text-violet-500 bg-violet-50 px-2 py-0.5 rounded-md mt-0.5 inline-block">Sesi Anda</span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-slate-50 border border-slate-200/60 font-mono text-xs text-slate-600 font-semibold shadow-sm">
                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                {{ $admin->username }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm font-bold text-slate-500">{{ $admin->created_at->translatedFormat('d F Y') }}</span>
                            <p class="text-[10px] text-slate-400 font-medium">Pk {{ $admin->created_at->format('H:i') }}</p>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.users.edit', $admin->id) }}" class="p-2 bg-slate-50 text-slate-500 rounded-xl hover:bg-violet-50 hover:text-violet-500 border border-slate-200 hover:border-violet-200 transition-all shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </a>
                                @if(Auth::id() != $admin->id)
                                <form action="{{ route('admin.users.destroy', $admin->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin hapus akun Admin ini? Aksi ini bersifat permanen.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 bg-slate-50 text-slate-500 rounded-xl hover:bg-red-50 hover:text-red-600 border border-slate-200 hover:border-red-200 transition-all shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
