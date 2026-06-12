@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-4">

    <div class="text-center mb-8">
        <h1 class="text-3xl font-extrabold text-slate-700 tracking-tight">Presensi Digital</h1>
        <p class="text-slate-500 mt-2 font-medium">
            @if(!$cekPresensi)
                Silakan isi kehadiran Anda hari ini.
            @elseif(!$cekPresensi->jam_pulang && $cekPresensi->status == 'Hadir')
                Tekan tombol di bawah untuk Absen Pulang.
            @else
                Aktivitas hari ini terekam: <span class="font-bold text-violet-500 bg-violet-50 px-2 py-0.5 rounded-md border border-violet-100">{{ $cekPresensi->status ?? 'Selesai' }}</span>
            @endif
        </p>
    </div>

    <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 relative overflow-hidden">
        <!-- Accent bar -->
        <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-violet-400 to-fuchsia-500"></div>

        <form id="presensiForm" action="{{ route($cekPresensi && !$cekPresensi->jam_pulang ? 'karyawan.presensi.pulang' : 'karyawan.presensi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="image" id="image-input">
            <input type="hidden" name="status" id="status-input" value="hadir">

            @if(!$cekPresensi)
                <div class="grid grid-cols-3 gap-3 mb-8 bg-slate-50 p-2 rounded-2xl border border-slate-200">
                    <button type="button" onclick="pilihStatus('hadir', this)" class="status-btn py-2.5 px-2 rounded-xl bg-white text-violet-500 font-bold shadow-sm border border-slate-200 transition-all text-sm truncate">
                        Hadir
                    </button>
                    <button type="button" onclick="pilihStatus('sakit', this)" class="status-btn py-2.5 px-2 rounded-xl text-slate-500 hover:text-slate-700 hover:bg-white/50 font-medium transition-all text-sm truncate border border-transparent">
                        Sakit
                    </button>
                    <button type="button" onclick="pilihStatus('izin', this)" class="status-btn py-2.5 px-2 rounded-xl text-slate-500 hover:text-slate-700 hover:bg-white/50 font-medium transition-all text-sm truncate border border-transparent">
                        Izin
                    </button>
                </div>

                <div id="camera-container" class="relative overflow-hidden rounded-[1.5rem] bg-slate-800 shadow-md mb-8 border-4 border-slate-100 group">
                    <video id="video" class="w-full h-auto aspect-[4/3] object-cover" autoplay playsinline></video>
                    <canvas id="canvas" class="hidden"></canvas>

                    <div class="absolute inset-0 flex flex-col justify-between p-4 pointer-events-none">
                        <div class="flex justify-between items-start">
                            <div class="w-8 h-8 rounded-full border-4 border-violet-500/50 animate-ping"></div>
                            <span class="bg-black/60 backdrop-blur-md text-emerald-400 font-mono text-sm font-bold px-4 py-1.5 rounded-full border border-white/10" id="clock-overlay">
                                00:00:00
                            </span>
                        </div>
                    </div>
                </div>

                <div id="keterangan-container" class="hidden mb-8">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Keterangan / Alasan</label>
                    <textarea name="keterangan" rows="4" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:bg-white focus:border-violet-500 focus:ring-2 focus:ring-emerald-500/20 outline-none transition-all shadow-sm" placeholder="Tuliskan alasan sakit atau izin Anda di sini secara detail..."></textarea>
                </div>

                <button type="button" id="btn-submit-masuk" onclick="submitPresensi()" class="w-full flex items-center justify-center gap-3 py-4 rounded-xl bg-violet-500 text-white font-bold text-lg shadow-xl shadow-violet-500/30 hover:bg-violet-400 active:scale-95 transition-all outline-none border-2 border-violet-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path></svg>
                    Ambil Foto & Masuk
                </button>

            @elseif(!$cekPresensi->jam_pulang && $cekPresensi->status == 'hadir')
                <div class="text-center py-8">
                    <div class="inline-flex h-24 w-24 items-center justify-center rounded-full bg-amber-50 text-amber-500 mb-4 shadow-inner border-[6px] border-white">
                        <svg class="w-12 h-12 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                    </div>
                    <h3 class="text-2xl font-extrabold text-slate-700 mb-1">Ceklok Pulang</h3>
                    <p class="text-sm font-medium text-slate-500 mb-8">Klik tombol di bawah untuk mencatat waktu pulang Anda sekarang.</p>

                    <button type="submit" class="w-full flex items-center justify-center gap-3 py-4 rounded-xl bg-amber-500 text-white font-bold text-lg shadow-xl shadow-amber-500/30 hover:bg-amber-600 transition-all transform hover:-translate-y-1">
                        Catat Waktu Pulang
                    </button>
                </div>

            @else
                <div class="text-center py-10 px-6 bg-violet-50 text-emerald-800 rounded-[1.5rem] border border-violet-100 flex flex-col items-center shadow-inner">
                    <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center mb-4 shadow-sm border border-violet-100">
                        <svg class="w-10 h-10 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <span class="text-xl font-extrabold tracking-tight mb-2">
                        @if($cekPresensi->status == 'hadir')
                            Siklus Presensi Selesai
                        @else
                            Pengajuan <span class="capitalize">{{ $cekPresensi->status }}</span> Diproses
                        @endif
                    </span>
                    <span class="text-sm font-medium opacity-80 text-violet-500">Terima kasih atas disiplin Anda hari ini. Selamat beristirahat!</span>
                </div>
                <a href="{{ route('karyawan.dashboard') }}" class="flex items-center justify-center gap-2 text-sm font-bold text-slate-500 hover:text-emerald-700 mt-8 bg-slate-50 hover:bg-violet-50 py-3 rounded-xl transition-colors border border-slate-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Dasbor Utama
                </a>
            @endif
        </form>
    </div>
</div>

<script>
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const imageInput = document.getElementById('image-input');
    const statusInput = document.getElementById('status-input');
    const form = document.getElementById('presensiForm');
    const cameraContainer = document.getElementById('camera-container');
    const ketContainer = document.getElementById('keterangan-container');
    const btnSubmit = document.getElementById('btn-submit-masuk');
    const statusBtns = document.querySelectorAll('.status-btn');

    function updateTime() {
        const clockEl = document.getElementById('clock-overlay');
        if(clockEl) {
            const now = new Date();
            clockEl.innerText = now.toLocaleTimeString('id-ID');
        }
    }
    setInterval(updateTime, 1000);

    if (video) {
        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            navigator.mediaDevices.getUserMedia({ video: { facingMode: "user" }})
                .then(function(stream) {
                    video.srcObject = stream;
                })
                .catch(function(err) {
                    console.log("Kamera Error: " + err);
                    cameraContainer.innerHTML = `<div class="p-8 text-center text-rose-400 bg-slate-800 h-full flex flex-col justify-center items-center">
                        <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        <p class="text-sm font-bold">Akses Kamera Diblokir</p>
                        <p class="text-[10px] mt-1 opacity-80">Harap izinkan akses kamera pada browser Anda.</p>
                    </div>`;
                });
        }
    }

    function pilihStatus(status, clickedBtn) {
        statusInput.value = status;

        statusBtns.forEach(btn => {
            btn.className = "status-btn py-2.5 px-2 rounded-xl text-slate-500 hover:text-slate-700 hover:bg-white/50 font-medium transition-all text-sm truncate border border-transparent";
        });

        let activeColor = status === 'hadir' ? 'text-violet-500 shadow-sm border-slate-200' : 
                         (status === 'sakit' ? 'text-amber-600 shadow-sm border-slate-200' : 'text-blue-600 shadow-sm border-slate-200');
                         
        clickedBtn.className = `status-btn py-2.5 px-2 rounded-xl bg-white ${activeColor} font-bold transition-all text-sm truncate border`;

        if (status === 'hadir') {
            cameraContainer.classList.remove('hidden');
            ketContainer.classList.add('hidden');
            btnSubmit.innerHTML = `<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path></svg> Ambil Foto & Masuk`;
            btnSubmit.className = "w-full flex items-center justify-center gap-3 py-4 rounded-xl bg-violet-500 text-white font-bold text-lg shadow-xl shadow-violet-500/30 hover:bg-violet-400 active:scale-95 transition-all outline-none border-2 border-violet-500";
        } else {
            cameraContainer.classList.add('hidden');
            ketContainer.classList.remove('hidden');
            btnSubmit.innerHTML = `Kirim Pengajuan <span class="capitalize">${status}</span>`;
            
            let btnBg = status === 'sakit' ? 'bg-amber-600 hover:bg-amber-700 shadow-amber-600/30 border-amber-500' : 'bg-blue-600 hover:bg-blue-700 shadow-blue-600/30 border-blue-500';
            btnSubmit.className = `w-full flex items-center justify-center gap-3 py-4 rounded-xl text-white font-bold text-lg shadow-xl active:scale-95 transition-all outline-none border-2 ${btnBg}`;
        }
    }

    function submitPresensi() {
        if (statusInput.value === 'hadir') {
            if (!video) return;
            const context = canvas.getContext('2d');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            imageInput.value = canvas.toDataURL('image/png');
        } else {
            imageInput.value = '';
        }
        form.submit();
    }
</script>
@endsection
