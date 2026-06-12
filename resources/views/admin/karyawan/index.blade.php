@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-700 tracking-tight">Data Karyawan</h1>
            <p class="text-slate-500 text-sm mt-1 font-medium">Kelola informasi dasar dan konfigurasi gaji karyawan.</p>
        </div>
        <a href="{{ route('admin.karyawan.create') }}" class="bg-violet-500 hover:bg-violet-400 text-white px-6 py-3 rounded-xl text-sm font-bold transition-all shadow-lg shadow-violet-500/20 flex items-center gap-2 transform hover:-translate-y-0.5">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
            Tambah Karyawan
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

    <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden relative">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50/80 text-slate-500 font-bold uppercase text-[10px] tracking-wider border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-5 rounded-tl-[2rem]">Profil Karyawan</th>
                        <th class="px-6 py-5">Kredensial</th>
                        <th class="px-6 py-5">Jenis Kelamin</th>
                        <th class="px-6 py-5">Kontak</th>
                        <th class="px-6 py-5">Alamat</th>
                        <th class="px-6 py-5 text-center rounded-tr-[2rem]">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100/80">
                    @foreach($karyawans as $karyawan)
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <div class="shrink-0 relative">
                                    @if($karyawan->foto_profil)
                                        <img class="h-12 w-12 rounded-2xl object-cover border-2 border-white shadow-sm" src="{{ $karyawan->foto_profil }}" alt="{{ $karyawan->name }}">
                                    @else
                                        <div class="h-12 w-12 rounded-2xl bg-gradient-to-br from-emerald-500 to-fuchsia-400 flex items-center justify-center text-white font-black text-lg uppercase shadow-inner border-2 border-white">
                                            {{ substr($karyawan->name, 0, 1) }}
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <span class="font-extrabold text-slate-700 text-base group-hover:text-emerald-700 transition-colors">{{ $karyawan->name }}</span>
                                    <p class="text-xs text-slate-400 font-medium">ID: {{ sprintf("EMP-%04d", $karyawan->id) }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-slate-100 border border-slate-200/60 font-mono text-xs text-slate-600 font-semibold shadow-sm">
                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                {{ $karyawan->username }}
                            </div>
                        </td>
                        <td class="px-6 py-4 font-medium text-slate-700">
                            {{ $karyawan->jenis_kelamin ?? '-' }}
                        </td>
                        <td class="px-6 py-4">
                            @if($karyawan->no_telp)
                                <div class="flex items-center gap-2">
                                    <span class="font-medium text-slate-700">{{ $karyawan->no_telp }}</span>
                                    <a href="https://wa.me/{{ preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $karyawan->no_telp)) }}" target="_blank" class="p-1.5 bg-violet-50 text-violet-500 rounded-lg hover:bg-emerald-100 hover:text-emerald-700 transition-colors" title="Hubungi via WhatsApp">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.274.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.1.824zm-3.423-14.416c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm.082 21.226c-1.574 0-3.109-.4-4.456-1.157l-4.954 1.3 1.321-4.832c-.836-1.398-1.277-3.003-1.277-4.664 0-5.467 4.448-9.914 9.915-9.914 5.466 0 9.913 4.448 9.913 9.915 0 5.467-4.448 9.914-9.914 9.914z"/></svg>
                                    </a>
                                </div>
                            @else
                                <span class="text-slate-400 italic">Belum ada WA</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-xs text-slate-500 max-w-[200px] truncate" title="{{ $karyawan->alamat }}">
                            {{ $karyawan->alamat ?? '-' }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.karyawan.edit', $karyawan->id) }}" class="p-2 bg-slate-50 text-slate-500 rounded-xl hover:bg-violet-50 hover:text-violet-500 border border-slate-200 hover:border-violet-200 transition-all shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </a>
                                <form action="{{ route('admin.karyawan.destroy', $karyawan->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin hapus karyawan ini? Data presensi & gaji terkait akan ikut terhapus.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 bg-slate-50 text-slate-500 rounded-xl hover:bg-red-50 hover:text-red-600 border border-slate-200 hover:border-red-200 transition-all shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($karyawans->isEmpty())
            <div class="p-16 text-center text-slate-400 flex flex-col items-center">
                <svg class="w-16 h-16 text-slate-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                <p class="font-semibold">Belum ada profil karyawan terdaftar.</p>
                <a href="{{ route('admin.karyawan.create') }}" class="mt-4 text-violet-500 font-bold hover:underline">Tambah Karyawan Baru</a>
            </div>
        @endif
    </div>
</div>
@endsection
