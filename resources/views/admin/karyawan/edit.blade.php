@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 sm:p-10 rounded-[2rem] shadow-sm border border-slate-100">
    <div class="mb-8 border-b border-slate-100 pb-6 flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-extrabold text-slate-700 tracking-tight">Edit Profil Karyawan</h2>
            <p class="text-slate-500 text-sm mt-1 font-medium">Perbarui data kredensial atau kompensasi karyawan.</p>
        </div>
        <div class="w-12 h-12 bg-slate-50 rounded-2xl border border-slate-100 flex items-center justify-center text-slate-400">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
        </div>
    </div>

    <form action="{{ route('admin.karyawan.update', $karyawan->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6 lg:space-y-8">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-3 uppercase tracking-wider text-[11px]">Foto Profil Akun</label>
            <div class="flex items-center space-x-5">
                <div class="shrink-0">
                    @if($karyawan->foto_profil)
                        <img class="h-20 w-20 object-cover rounded-2xl border-4 border-slate-50 shadow-sm" src="{{ $karyawan->foto_profil }}" alt="Foto Profil">
                    @else
                        <div class="h-20 w-20 rounded-2xl bg-gradient-to-br from-emerald-500 to-fuchsia-400 flex items-center justify-center text-white font-black text-2xl uppercase shadow-inner border-4 border-slate-50">
                            {{ substr($karyawan->name, 0, 1) }}
                        </div>
                    @endif
                </div>
                <label class="block flex-1 border border-slate-200 border-dashed rounded-2xl p-3 hover:bg-slate-50 transition-colors cursor-pointer group">
                    <div class="flex items-center gap-4">
                        <div class="p-2 bg-violet-50 text-violet-500 rounded-lg group-hover:bg-emerald-100 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div>
                            <input type="file" name="foto_profil" class="block w-full text-sm text-slate-500 file:mr-0 file:my-0 file:p-0 file:border-0 file:bg-transparent file:text-emerald-700 file:font-bold hover:file:underline cursor-pointer"/>
                            <span class="text-[11px] text-slate-400 mt-1 block">Abaikan jika tidak ingin mengubah foto.</span>
                        </div>
                    </div>
                </label>
            </div>
        </div>

        <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100 space-y-5">
            <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">Informasi Dasar</h3>
            
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap</label>
                <input type="text" name="name" value="{{ $karyawan->name }}" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-violet-500 outline-none transition-shadow shadow-sm text-slate-700 font-medium" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Username Akses</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 font-mono text-sm">@</div>
                        <input type="text" name="username" value="{{ $karyawan->username }}" class="w-full pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-violet-500 outline-none transition-shadow shadow-sm text-slate-700 font-medium" required>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Setel Ulang Password <span class="text-slate-400 font-normal ml-1">(Opsional)</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <input type="password" name="password" class="w-full pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-violet-500 outline-none transition-shadow shadow-sm text-slate-700 font-medium placeholder-slate-300" placeholder="Biarkan kosong jika tetap">
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Nomor Telepon (WA)</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 font-mono text-sm">+62</div>
                        <input type="text" name="no_telp" value="{{ $karyawan->no_telp }}" class="w-full pl-12 pr-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-violet-500 outline-none transition-shadow shadow-sm text-slate-700 font-medium">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Jenis Kelamin</label>
                    <div class="relative">
                        <select name="jenis_kelamin" class="w-full pl-4 pr-10 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-violet-500 outline-none appearance-none font-medium text-slate-700 shadow-sm">
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="Laki-laki" {{ $karyawan->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ $karyawan->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Alamat Lengkap</label>
                <textarea name="alamat" rows="3" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-violet-500 outline-none transition-shadow shadow-sm text-slate-700 font-medium">{{ $karyawan->alamat }}</textarea>
            </div>
        </div>

        <div class="pt-6 flex justify-end items-center space-x-4 border-t border-slate-100 mt-4">
            <a href="{{ route('admin.karyawan.index') }}" class="px-6 py-3 bg-white border border-slate-200 text-slate-600 font-bold rounded-xl hover:bg-slate-50 hover:text-slate-900 transition-colors">Batal</a>
            <button type="submit" class="px-8 py-3 bg-violet-500 text-white font-bold rounded-xl hover:bg-violet-400 shadow-xl shadow-emerald-500/30 transition-all transform hover:-translate-y-0.5 border border-transparent hover:border-violet-500">
                Pembaruan Data
            </button>
        </div>
    </form>
</div>
@endsection
