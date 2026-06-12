<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPP</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            scroll-behavior: smooth;
        }

        .hero-pattern {
            background-color: #f8fafc;
            background-image: radial-gradient(#e2e8f0 1px, transparent 1px);
            background-size: 32px 32px;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }

        @keyframes float-delayed {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(15px); }
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-float { animation: float 6s ease-in-out infinite; }
        .animate-float-delayed { animation: float-delayed 7s ease-in-out infinite; }
        .animate-slide-up { animation: slideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }

        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }

        /* Lazy Loading Animation Classes */
        .lazy-hidden {
            opacity: 0;
            transform: translateY(40px);
            transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .lazy-visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-700 antialiased selection:bg-blue-500/20 selection:text-blue-900 overflow-x-hidden">

    <div class="absolute inset-0 hero-pattern -z-10 h-[800px] w-full mix-blend-multiply opacity-50 mask-image:linear-gradient(to_bottom,white,transparent)"></div>
    <div class="absolute top-0 inset-x-0 h-[500px] bg-gradient-to-b from-blue-50/50 to-transparent -z-10"></div>

    <!-- Navigation -->
    <nav class="relative z-50 flex items-center justify-between px-6 py-5 max-w-7xl mx-auto opacity-0 animate-slide-up bg-white/70 backdrop-blur-md mt-4 rounded-2xl border border-white/50 shadow-sm">
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logo.png') }}" class="h-8 w-auto object-contain" alt="Logo">
            <span class="font-bold text-xl tracking-tight text-slate-900">SPP</span>
        </div>

        <div class="hidden md:flex items-center gap-8 text-sm font-semibold text-slate-500">
            <a href="#features" class="hover:text-slate-900 transition-colors">Fitur Platform</a>
            <a href="#workflow" class="hover:text-slate-900 transition-colors">Alur Kerja</a>
            <a href="#benefits" class="hover:text-slate-900 transition-colors">Manfaat</a>
        </div>

        <div>
            @if (Route::has('login'))
                @auth
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="px-5 py-2.5 rounded-xl text-sm font-bold bg-slate-800 text-white hover:bg-slate-800 transition-all shadow-md hover:shadow-lg hover:-translate-y-0.5">Masuk Sistem</a>
                    @else
                        <a href="{{ route('karyawan.dashboard') }}" class="px-5 py-2.5 rounded-xl text-sm font-bold bg-slate-800 text-white hover:bg-slate-800 transition-all shadow-md hover:shadow-lg hover:-translate-y-0.5">Masuk Sistem</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold bg-slate-800 text-white hover:bg-slate-800 transition-all shadow-md hover:shadow-lg hover:-translate-y-0.5">
                        <span>Akses Portal</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                @endauth
            @endif
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="relative z-10 max-w-7xl mx-auto px-6 pt-24 pb-32 flex flex-col lg:flex-row items-center gap-16">

        <!-- Left Content -->
        <div class="flex-1 text-center lg:text-left">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 border border-blue-100 text-blue-600 mb-8 opacity-0 animate-slide-up delay-100 shadow-sm">
                <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                <span class="text-xs font-bold uppercase tracking-wider">Siap Digunakan</span>
            </div>

            <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold leading-tight tracking-tight text-slate-900 mb-6 opacity-0 animate-slide-up delay-200">
                Sistem <span class="text-blue-600">Presensi</span> <br /> dan Penggajian.
            </h1>

            <p class="text-lg text-slate-500 mb-10 max-w-2xl mx-auto lg:mx-0 leading-relaxed opacity-0 animate-slide-up delay-300 font-medium">
                Platform manajemen yang sangat aman, cepat, dan berdesain premium untuk Sistem Presensi dan Penggajian. Lacak absensi, kelola laporan, dan distribusikan gaji tanpa hambatan.
            </p>

            <div class="flex flex-col sm:flex-row items-center gap-4 justify-center lg:justify-start opacity-0 animate-slide-up delay-300">
                <a href="{{ route('login') }}" class="px-8 py-4 rounded-xl text-base font-bold bg-slate-800 text-white hover:bg-slate-800 w-full sm:w-auto text-center shadow-xl hover:shadow-2xl transition-all hover:-translate-y-0.5">
                    Buka Aplikasi
                </a>
                <a href="#features" class="px-8 py-4 rounded-xl text-base font-bold bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 w-full sm:w-auto text-center flex items-center justify-center gap-2 shadow-sm transition-all hover:-translate-y-0.5">
                    Jelajahi Platform
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </a>
            </div>

            <!-- Quick Stats -->
            <div class="mt-16 grid grid-cols-3 gap-6 border-t border-slate-200 pt-8 opacity-0 animate-slide-up delay-300">
                <div>
                    <h4 class="text-3xl font-extrabold text-slate-900 mb-1">0<span class="text-lg text-slate-400 font-semibold text-slate-400">ms</span></h4>
                    <p class="text-xs text-slate-500 uppercase tracking-widest font-semibold">Fokus Latensi</p>
                </div>
                <div>
                    <h4 class="text-3xl font-extrabold text-slate-900 mb-1">2<span class="text-lg text-slate-400 font-semibold">x</span></h4>
                    <p class="text-xs text-slate-500 uppercase tracking-widest font-semibold">Kecepatan</p>
                </div>
                <div>
                    <h4 class="text-3xl font-extrabold text-slate-900 mb-1">100<span class="text-lg text-slate-400 font-semibold">%</span></h4>
                    <p class="text-xs text-slate-500 uppercase tracking-widest font-semibold">Akurasi</p>
                </div>
            </div>
        </div>

        <!-- Right Visuals (Dashboard Preview Image) -->
        <div class="flex-1 relative w-full opacity-0 animate-slide-up delay-200">
            <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-white/50 bg-white p-2 transform animate-float">
                <div class="absolute inset-0 bg-gradient-to-tr from-blue-500/5 to-transparent mix-blend-overlay z-10 pointer-events-none rounded-2xl"></div>
                <!-- Preview Dashboard -->
                <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=1000&auto=format&fit=crop" alt="Dashboard Preview" class="w-full h-auto object-cover rounded-xl hover:scale-[1.01] transition-transform duration-500" loading="lazy">
            </div>
        </div>

    </main>

    <!-- Features Section -->
    <section id="features" class="relative z-10 py-24 bg-white border-t border-slate-100 lazy-hidden">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-20">
                <h2 class="text-xs font-extrabold tracking-widest text-blue-600 uppercase mb-3 bg-blue-50 inline-block px-4 py-1.5 rounded-full">Infrastruktur Inti</h2>
                <h3 class="text-4xl md:text-5xl font-extrabold text-slate-900 text-balance tracking-tight">Dirancang untuk alur operasional yang mulus.</h3>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-slate-50 border border-slate-100 p-8 rounded-3xl group hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="w-14 h-14 rounded-2xl bg-white border border-slate-200 shadow-sm flex items-center justify-center text-slate-700 mb-6 group-hover:bg-blue-600 group-hover:text-white group-hover:border-blue-600 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-3">Absen Instan</h4>
                    <p class="text-slate-500 text-sm leading-relaxed font-medium">Sistem absensi tanpa hambatan yang dirancang untuk mencatat waktu masuk dan keluar secara presisi dengan klik minimal. Dilengkapi dengan jejak audit yang ketat.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-slate-50 border border-slate-100 p-8 rounded-3xl group hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="w-14 h-14 rounded-2xl bg-white border border-slate-200 shadow-sm flex items-center justify-center text-slate-700 mb-6 group-hover:bg-indigo-600 group-hover:text-white group-hover:border-indigo-600 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-3">Dasbor Analitik</h4>
                    <p class="text-slate-500 text-sm leading-relaxed font-medium">Tampilan terpusat untuk administrator. Pantau kehadiran tim, buat laporan analitik, dan ambil keputusan manajemen berbasis data.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-slate-50 border border-slate-100 p-8 rounded-3xl group hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="w-14 h-14 rounded-2xl bg-white border border-slate-200 shadow-sm flex items-center justify-center text-slate-700 mb-6 group-hover:bg-violet-500 group-hover:text-white group-hover:border-emerald-600 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-3">Slip Gaji Terenkripsi (PDF)</h4>
                    <p class="text-slate-500 text-sm leading-relaxed font-medium">Pembuatan slip gaji otomatis. Karyawan dapat melihat dan mengunduh laporan gaji format PDF yang sangat otentik dan terstandarisasi dengan aman.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Workflow Section -->
    <section id="workflow" class="relative z-10 py-24 bg-slate-50 border-t border-slate-100 lazy-hidden">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-20">
                <h2 class="text-xs font-extrabold tracking-widest text-indigo-600 uppercase mb-3 bg-indigo-50 inline-block px-4 py-1.5 rounded-full">Alur Kerja</h2>
                <h3 class="text-4xl md:text-5xl font-extrabold text-slate-900 text-balance tracking-tight">Proses sederhana untuk hasil maksimal.</h3>
            </div>

            <div class="grid md:grid-cols-4 gap-6 text-center">
                <!-- Step 1 -->
                <div class="relative group">
                    <div class="hidden md:block absolute top-1/4 left-1/2 w-full border-t-2 border-dashed border-slate-200 -z-10 group-hover:border-indigo-300 transition-colors"></div>
                    <div class="w-16 h-16 mx-auto rounded-2xl bg-white border border-slate-200 shadow-sm flex items-center justify-center text-indigo-600 mb-6 group-hover:scale-110 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300 relative z-10">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                        <span class="absolute -top-2 -right-2 w-6 h-6 bg-slate-800 text-white rounded-full text-xs font-bold flex items-center justify-center shadow-md">1</span>
                    </div>
                    <h4 class="font-bold text-slate-900 mb-2">Akses Sistem</h4>
                    <p class="text-slate-500 text-sm">Login dengan kredensial aman dari perangkat manapun.</p>
                </div>

                <!-- Step 2 -->
                <div class="relative group">
                    <div class="hidden md:block absolute top-1/4 left-1/2 w-full border-t-2 border-dashed border-slate-200 -z-10 group-hover:border-blue-300 transition-colors"></div>
                    <div class="w-16 h-16 mx-auto rounded-2xl bg-white border border-slate-200 shadow-sm flex items-center justify-center text-blue-600 mb-6 group-hover:scale-110 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300 relative z-10">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="absolute -top-2 -right-2 w-6 h-6 bg-slate-800 text-white rounded-full text-xs font-bold flex items-center justify-center shadow-md">2</span>
                    </div>
                    <h4 class="font-bold text-slate-900 mb-2">Absensi Harian</h4>
                    <p class="text-slate-500 text-sm">Validasi kehadiran seketika dengan sistem terenkripsi.</p>
                </div>

                <!-- Step 3 -->
                <div class="relative group">
                    <div class="hidden md:block absolute top-1/4 left-1/2 w-full border-t-2 border-dashed border-slate-200 -z-10 group-hover:border-cyan-300 transition-colors"></div>
                    <div class="w-16 h-16 mx-auto rounded-2xl bg-white border border-slate-200 shadow-sm flex items-center justify-center text-cyan-500 mb-6 group-hover:scale-110 group-hover:bg-cyan-500 group-hover:text-white transition-all duration-300 relative z-10">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        <span class="absolute -top-2 -right-2 w-6 h-6 bg-slate-800 text-white rounded-full text-xs font-bold flex items-center justify-center shadow-md">3</span>
                    </div>
                    <h4 class="font-bold text-slate-900 mb-2">Rekap Data</h4>
                    <p class="text-slate-500 text-sm">Dashboard admin otomatis mengakumulasi jam dan durasi kerja.</p>
                </div>

                <!-- Step 4 -->
                <div class="relative group">
                    <div class="w-16 h-16 mx-auto rounded-2xl bg-white border border-slate-200 shadow-sm flex items-center justify-center text-violet-500 mb-6 group-hover:scale-110 group-hover:bg-violet-500 group-hover:text-white transition-all duration-300 relative z-10">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="absolute -top-2 -right-2 w-6 h-6 bg-slate-800 text-white rounded-full text-xs font-bold flex items-center justify-center shadow-md">4</span>
                    </div>
                    <h4 class="font-bold text-slate-900 mb-2">Distribusi Gaji</h4>
                    <p class="text-slate-500 text-sm">Penerbitan slip PDF terotomatisasi secara transparan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section id="benefits" class="relative z-10 py-24 bg-white border-t border-slate-100 lazy-hidden">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center gap-16">

                <!-- Left Details -->
                <div class="flex-1 space-y-10">
                    <div>
                        <h2 class="text-xs font-extrabold tracking-widest text-violet-500 uppercase mb-3 bg-violet-50 inline-block px-4 py-1.5 rounded-full">Keuntungan Eksklusif</h2>
                        <h3 class="text-4xl lg:text-5xl font-extrabold text-slate-900 text-balance tracking-tight">Kinerja lebih baik untuk tim Anda.</h3>
                    </div>

                    <div class="space-y-6">
                        <!-- Benefit Item -->
                        <div class="flex items-start gap-4">
                            <div class="mt-1 w-10 h-10 rounded-xl bg-violet-50 text-emerald-500 flex items-center justify-center shrink-0 border border-violet-100">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-slate-900 mb-1">Akurasi Perhitungan Tepat</h4>
                                <p class="text-slate-500 text-sm leading-relaxed">Sistem meminimalkan ruang untuk kesalahan manual (human-error) sehingga rekap kehadiran dan penghitungan gaji selalu presisi.</p>
                            </div>
                        </div>

                        <!-- Benefit Item -->
                        <div class="flex items-start gap-4">
                            <div class="mt-1 w-10 h-10 rounded-xl bg-indigo-50 text-indigo-500 flex items-center justify-center shrink-0 border border-indigo-100">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-slate-900 mb-1">Pangkas Waktu Administratif</h4>
                                <p class="text-slate-500 text-sm leading-relaxed">Penghematan waktu luar biasa bagi petugas admin, karena laporan akhir bulan dihasilkan otomatis tanpa rekap manual yang melelahkan.</p>
                            </div>
                        </div>

                        <!-- Benefit Item -->
                        <div class="flex items-start gap-4">
                            <div class="mt-1 w-10 h-10 rounded-xl bg-blue-50 text-blue-500 flex items-center justify-center shrink-0 border border-blue-100">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-slate-900 mb-1">Privasi dan Keamanan</h4>
                                <p class="text-slate-500 text-sm leading-relaxed">Seluruh data gaji dan profil karyawan terlindungi dengan sistem keamana serta manajemen hak akses yang ketat sesuai regulasi.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Visual -->
                <div class="flex-1 w-full relative">
                    <div class="absolute inset-0 bg-violet-500 rounded-[3rem] transform translate-x-4 translate-y-4 opacity-5 pointer-events-none"></div>
                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=1000&auto=format&fit=crop" alt="Tim Sistem Presensi dan Penggajian" class="relative z-10 w-full h-[500px] object-cover rounded-[3rem] shadow-xl border border-slate-100" loading="lazy">

                    <div class="absolute -left-6 bottom-12 bg-white p-4 rounded-2xl shadow-xl border border-slate-100 z-20 animate-float hidden sm:flex items-center gap-4">
                        <div class="w-12 h-12 bg-emerald-100 text-violet-500 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-0.5">Produktivitas</p>
                            <p class="text-xl font-extrabold text-slate-900">+45%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer / Bottom CTA -->
    <footer class="relative z-10 bg-slate-800 pt-24 pb-10 border-t-4 border-blue-600">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmZmZmYiIGZpbGwtb3BhY2l0eT0iMC4wNSI+PHBhdGggZD0iTTM2IDM0djI2SDI0VjM0SDN2LTEyaDIxdjEyem0tMTAgMGg0di04aDR2LTEyaC04djIwaDB6bTItMjZIMTR2NGg0djJIMTB2NGg0djJIMTB2Mmg4djJoNHYyaDh2MkgxVjJoMzR2MmgtMnpNMCAwaDJoNjR2NjRIMHptMTYgMjJWMmg1djIwem0xNCAwVjJoLTR2MjB6Ii8+PC9nPjwvZz48L3N2Zz4=')] opacity-10"></div>
        <div class="max-w-7xl mx-auto px-6 text-center relative z-10">
            <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-6 tracking-tight">Siap memasuki ekosistem?</h2>
            <p class="text-slate-400 max-w-xl mx-auto mb-10 font-medium">Akses aman hanya diberikan kepada personel yang berwenang. Silakan lanjutkan ke portal autentikasi.</p>

            <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-10 py-4 rounded-xl text-base font-bold bg-white text-slate-900 hover:bg-slate-100 shadow-xl hover:-translate-y-0.5 transition-all mb-20">
                Mulai Proses Login
                <svg class="w-5 h-5 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>

            <div class="flex flex-col md:flex-row items-center justify-between pt-8 border-t border-white/10 text-xs text-slate-400 font-semibold tracking-wide">
                <p>&copy; {{ date('Y') }} SPP. Hak cipta dilindungi.</p>
                <div class="flex items-center gap-6 mt-4 md:mt-0">
                    <a href="#" class="hover:text-white transition-colors">Privasi</a>
                    <a href="#" class="hover:text-white transition-colors">Syarat</a>
                    <a href="#" class="hover:text-white transition-colors">v2.0.4</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('lazy-visible');
                        // Optional: remove observer after animating once
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: "0px 0px -50px 0px"
            });

            document.querySelectorAll('.lazy-hidden').forEach(el => observer.observe(el));
        });
    </script>
</body>
</html>
