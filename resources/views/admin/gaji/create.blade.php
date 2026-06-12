@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-700 tracking-tight">Kalkulasi Penggajian</h1>
            <p class="text-slate-500 text-sm mt-1 font-medium">Hitung dan terbitkan slip gaji bulanan karyawan dengan akurat.</p>
        </div>
        <a href="{{ route('admin.gaji.index') }}" class="px-5 py-2.5 bg-white border border-slate-200 text-slate-600 font-bold rounded-xl hover:bg-slate-50 hover:text-slate-900 transition-colors shadow-sm flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali
        </a>
    </div>

    <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden relative">
        <!-- Dekorasi Atas -->
        <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-violet-400 to-fuchsia-500"></div>

        <form x-data="{ showConfirm: false }" @submit.prevent="showConfirm = true" action="{{ route('admin.gaji.store') }}" method="POST" class="p-8 sm:p-10 space-y-8" x-ref="gajiForm">
            @csrf

            <!-- Popup Konfirmasi -->
            <div x-show="showConfirm" x-cloak
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 z-[100] flex items-center justify-center p-4"
                 @keydown.escape.window="showConfirm = false">

                <!-- Backdrop -->
                <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" @click="showConfirm = false"></div>

                <!-- Modal -->
                <div x-show="showConfirm"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-90 translate-y-4"
                     x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                     x-transition:leave-end="opacity-0 scale-90 translate-y-4"
                     class="relative bg-white rounded-3xl shadow-2xl border border-slate-100 max-w-md w-full overflow-hidden">

                    <!-- Top Accent -->
                    <div class="h-1.5 bg-gradient-to-r from-violet-500 to-fuchsia-500"></div>

                    <div class="p-8 text-center">
                        <!-- Icon -->
                        <div class="mx-auto w-16 h-16 bg-violet-50 border-2 border-violet-100 rounded-2xl flex items-center justify-center mb-5">
                            <svg class="w-8 h-8 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>

                        <!-- Title -->
                        <h3 class="text-xl font-extrabold text-slate-800 mb-2">Terbitkan Slip Gaji?</h3>

                        <!-- Message -->
                        <p class="text-sm text-slate-500 leading-relaxed mb-8">
                            Pastikan semua komponen gaji, potongan, dan denda telah diisi dengan benar. Slip gaji akan langsung diterbitkan setelah dikonfirmasi.
                        </p>

                        <!-- Buttons -->
                        <div class="flex items-center gap-3">
                            <button type="button" @click="showConfirm = false"
                                    class="flex-1 px-5 py-3 rounded-xl font-bold text-sm bg-slate-100 text-slate-600 hover:bg-slate-200 transition-all border border-slate-200">
                                Batal
                            </button>
                            <button type="button"
                                    @click="$refs.gajiForm.removeAttribute('x-ref'); $refs.gajiForm.onsubmit = null; $el.disabled = true; $el.innerHTML = '<svg class=\'w-5 h-5 animate-spin\' fill=\'none\' viewBox=\'0 0 24 24\'><circle class=\'opacity-25\' cx=\'12\' cy=\'12\' r=\'10\' stroke=\'currentColor\' stroke-width=\'4\'></circle><path class=\'opacity-75\' fill=\'currentColor\' d=\'M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z\'></path></svg> Memproses...'; $refs.gajiForm.submit();"
                                    class="flex-1 px-5 py-3 rounded-xl font-bold text-sm bg-violet-500 text-white hover:bg-violet-400 transition-all shadow-lg shadow-violet-500/25 flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                Ya, Terbitkan
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 border-b border-slate-100 pb-8">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-3 uppercase tracking-wider text-[11px]">Pilih Karyawan Target</label>
                    <div class="relative">
                        <select name="user_id" class="w-full pl-4 pr-10 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-violet-500 outline-none appearance-none font-medium text-slate-700 shadow-sm" required>
                            <option value="">-- Pilih Profil --</option>
                            @foreach($karyawans as $k)
                                <option value="{{ $k->id }}">
                                    {{ $k->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-3 uppercase tracking-wider text-[11px]">Periode Bulan</label>
                        <div class="relative">
                            <select name="bulan" class="w-full pl-4 pr-10 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none appearance-none font-bold text-slate-700 shadow-sm">
                                @foreach(['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $bulan)
                                    <option value="{{ $bulan }}" {{ date('F') == $bulan ? 'selected' : '' }}>{{ $bulan }}</option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-3 uppercase tracking-wider text-[11px]">Periode Tahun</label>
                        <input type="number" name="tahun" value="{{ date('Y') }}" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none font-bold text-slate-700 shadow-sm text-center">
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-sm font-extrabold text-slate-700 mb-5">Komponen Gaji Dasar</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div class="bg-indigo-50/50 p-6 rounded-2xl border border-indigo-100 group hover:bg-indigo-50 transition-colors">
                        <label class="block text-sm font-bold text-indigo-800 mb-3 flex items-center justify-between">
                            Gaji Pokok
                            <span class="p-1 bg-indigo-100 text-indigo-600 rounded"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-3 text-indigo-600 font-bold">Rp</span>
                            <input type="number" name="gaji_pokok" placeholder="Contoh : 1500000" class="w-full pl-12 pr-4 py-3 bg-white border border-indigo-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none text-indigo-900 font-black font-mono shadow-sm group-hover:border-indigo-300 transition-colors" required>
                        </div>
                    </div>

                    <div class="bg-indigo-50/50 p-6 rounded-2xl border border-indigo-100 group hover:bg-indigo-50 transition-colors">
                        <label class="block text-sm font-bold text-indigo-800 mb-3 flex items-center justify-between">
                            Tarif Uang Makan (Harian)
                            <span class="p-1 bg-indigo-100 text-indigo-600 rounded"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-3 text-indigo-600 font-bold">Rp</span>
                            <input type="number" name="tarif_uang_makan" class="w-full pl-12 pr-4 py-3 bg-white border border-indigo-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none text-indigo-900 font-black font-mono shadow-sm group-hover:border-indigo-300 transition-colors">
                        </div>
                        <p class="text-[11px] font-semibold text-indigo-600/70 mt-3 flex items-start gap-1">
                            Otomatis dikali total kehadiran
                        </p>
                    </div>

                    <div class="bg-indigo-50/50 p-6 rounded-2xl border border-indigo-100 group hover:bg-indigo-50 transition-colors">
                        <label class="block text-sm font-bold text-indigo-800 mb-3 flex items-center justify-between">
                            Tarif Uang Transport (Harian)
                            <span class="p-1 bg-indigo-100 text-indigo-600 rounded"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-3 text-indigo-600 font-bold">Rp</span>
                            <input type="number" name="tarif_uang_transport" class="w-full pl-12 pr-4 py-3 bg-white border border-indigo-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none text-indigo-900 font-black font-mono shadow-sm group-hover:border-indigo-300 transition-colors">
                        </div>
                        <p class="text-[11px] font-semibold text-indigo-600/70 mt-3 flex items-start gap-1">
                            Otomatis dikali total kehadiran
                        </p>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-sm font-extrabold text-slate-700 mb-5">Penyesuaian Kompensasi</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div class="bg-violet-50/50 p-6 rounded-2xl border border-violet-100 group hover:bg-violet-50 transition-colors">
                        <label class="block text-sm font-bold text-emerald-800 mb-3 flex items-center justify-between">
                            Uang Lembur (Total)
                            <span class="p-1 bg-emerald-100 text-violet-500 rounded"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg></span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-3 text-violet-500 font-bold">Rp</span>
                            <input type="number" name="uang_lembur" class="w-full pl-12 pr-4 py-3 bg-white border border-violet-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-violet-500 outline-none text-emerald-900 font-black font-mono shadow-sm group-hover:border-emerald-300 transition-colors">
                        </div>
                        <p class="text-[11px] font-semibold text-violet-500/70 mt-3 flex items-start gap-1">
                            <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Total nominal lembur (flat rate)
                        </p>
                    </div>

                    <div class="bg-red-50/50 p-6 rounded-2xl border border-red-100 group hover:bg-red-50 transition-colors">
                        <label class="block text-sm font-bold text-rose-800 mb-3 flex items-center justify-between">
                            Potongan / Kasbon
                            <span class="p-1 bg-red-100 text-red-600 rounded"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg></span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-3 text-red-600 font-bold">Rp</span>
                            <input type="number" name="potongan" class="w-full pl-12 pr-4 py-3 bg-white border border-red-200 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none text-rose-900 font-black font-mono shadow-sm group-hover:border-rose-300 transition-colors">
                        </div>
                        <p class="text-[11px] font-semibold text-red-600/70 mt-3 flex items-start gap-1">
                            <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Nominal pemotongan (Kasbon, BPJS, dll).
                        </p>
                    </div>

                    <div class="bg-red-50/50 p-6 rounded-2xl border border-red-100 group hover:bg-red-50 transition-colors">
                        <label class="block text-sm font-bold text-rose-800 mb-3 flex items-center justify-between">
                            Denda Keterlambatan
                            <span class="p-1 bg-red-100 text-red-600 rounded"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-3 text-red-600 font-bold">Rp</span>
                            <input type="number" name="denda_keterlambatan" class="w-full pl-12 pr-4 py-3 bg-white border border-red-200 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none text-rose-900 font-black font-mono shadow-sm group-hover:border-rose-300 transition-colors">
                        </div>
                        <p class="text-[11px] font-semibold text-red-600/70 mt-3 flex items-start gap-1">
                            <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Total nominal denda karena terlambat (mengurangi gaji)
                        </p>
                    </div>
                </div>
            </div>

            <div class="pt-6 flex justify-end border-t border-slate-100">
                <button type="submit" class="bg-violet-500 hover:bg-violet-400 text-white px-8 py-3.5 rounded-xl font-bold shadow-xl shadow-violet-500/30 transition-all transform hover:-translate-y-0.5 border border-transparent hover:border-emerald-400 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Hitung & Terbitkan Slip Gaji
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
