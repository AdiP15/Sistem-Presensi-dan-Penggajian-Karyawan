<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Slip Gaji - {{ $gaji->bulan }} {{ $gaji->tahun }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #2d3748;
            font-size: 13px;
            line-height: 1.4;
            margin: 0;
            padding: 20px;
        }
        .header-table {
            width: 100%;
            border-bottom: 2px solid #319795; /* Teal color */
            padding-bottom: 15px;
            margin-bottom: 25px;
        }
        .header-table td {
            vertical-align: middle;
        }
        .company-name {
            font-size: 24px;
            font-weight: bold;
            color: #2c7a7b;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .company-address {
            font-size: 11px;
            color: #718096;
            margin-top: 4px;
        }
        .slip-title {
            text-align: right;
        }
        .slip-title h2 {
            margin: 0;
            font-size: 22px;
            color: #2d3748;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .slip-title p {
            margin: 4px 0 0 0;
            font-size: 12px;
            color: #4a5568;
            font-weight: bold;
        }
        
        .info-box {
            background-color: #f7fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 15px;
            margin-bottom: 25px;
        }
        .info-table {
            width: 100%;
        }
        .info-table td {
            padding: 4px 0;
        }
        .info-label {
            width: 110px;
            color: #718096;
            font-size: 12px;
            text-transform: uppercase;
            font-weight: bold;
        }
        .info-value {
            font-weight: bold;
            color: #2d3748;
        }

        .section-title {
            font-size: 14px;
            font-weight: bold;
            color: #2d3748;
            margin-bottom: 10px;
            text-transform: uppercase;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 5px;
        }

        .salary-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        .salary-table th {
            background-color: #edf2f7;
            color: #4a5568;
            font-size: 11px;
            text-transform: uppercase;
            padding: 10px;
            text-align: left;
            border-bottom: 2px solid #cbd5e0;
        }
        .salary-table th.amount-col {
            text-align: right;
            width: 150px;
        }
        .salary-table td {
            padding: 10px;
            border-bottom: 1px solid #e2e8f0;
        }
        .salary-table td.amount {
            text-align: right;
            font-family: 'Courier New', Courier, monospace;
            font-weight: bold;
        }
        .subtotal-row td {
            background-color: #f7fafc;
            font-weight: bold;
            border-top: 1px solid #cbd5e0;
        }
        
        .net-pay-box {
            margin-top: 30px;
            background-color: #e6fffa;
            border: 1px solid #319795;
            padding: 20px;
            border-radius: 8px;
            text-align: right;
        }
        .net-pay-label {
            font-size: 14px;
            color: #285e61;
            text-transform: uppercase;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .net-pay-amount {
            font-size: 26px;
            font-weight: bold;
            color: #234e52;
            font-family: 'Courier New', Courier, monospace;
        }

        .footer {
            margin-top: 50px;
            width: 100%;
        }
        .signature-table {
            width: 100%;
        }
        .signature-table td {
            width: 50%;
            text-align: center;
        }
        .signature-area {
            margin-top: 80px;
            border-top: 1px solid #a0aec0;
            display: inline-block;
            padding-top: 5px;
            width: 200px;
            font-weight: bold;
            color: #4a5568;
        }

        .note {
            margin-top: 50px;
            font-size: 10px;
            color: #a0aec0;
            text-align: center;
            font-style: italic;
        }
    </style>
</head>
<body>

    <table class="header-table">
        <tr>
            <td>
                <h1 class="company-name">Sistem Presensi & Penggajian</h1>
                <div class="company-address">Jalan Contoh Alamat No. 123, Kota, Provinsi, Kode Pos</div>
            </td>
            <td class="slip-title">
                <h2>SLIP GAJI</h2>
                <p>Periode: {{ $gaji->bulan }} {{ $gaji->tahun }}</p>
            </td>
        </tr>
    </table>

    <div class="info-box">
        <table class="info-table">
            <tr>
                <td class="info-label">ID Karyawan</td>
                <td class="info-value">: EMP-{{ sprintf("%04d", $gaji->user->id) }}</td>
                <td class="info-label">Departemen/Posisi</td>
                <td class="info-value">: {{ strtoupper($gaji->user->role) }}</td>
            </tr>
            <tr>
                <td class="info-label">Nama Lengkap</td>
                <td class="info-value">: {{ strtoupper($gaji->user->name) }}</td>
                <td class="info-label">Total Hari Hadir</td>
                <td class="info-value">: {{ $gaji->total_hari_hadir }} Hari</td>
            </tr>
        </table>
    </div>

    <!-- TABEL PENERIMAAN -->
    <div class="section-title">Rincian Penerimaan</div>
    <table class="salary-table">
        <thead>
            <tr>
                <th>Keterangan Komponen</th>
                <th class="amount-col">Jumlah (IDR)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Gaji Pokok Dasar</td>
                <td class="amount">{{ number_format($gaji->gaji_pokok, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Uang Makan (Harian)</td>
                <td class="amount">{{ number_format($gaji->uang_makan, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Uang Transport (Harian)</td>
                <td class="amount">{{ number_format($gaji->uang_transport, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Kompensasi Lembur</td>
                <td class="amount">{{ number_format($gaji->uang_lembur, 0, ',', '.') }}</td>
            </tr>
            <tr class="subtotal-row">
                <td style="text-align: right; padding-right: 15px;">TOTAL PENERIMAAN</td>
                @php
                    $total_penerimaan = $gaji->gaji_pokok + $gaji->uang_makan + $gaji->uang_transport + $gaji->uang_lembur;
                @endphp
                <td class="amount" style="color: #2c7a7b;">{{ number_format($total_penerimaan, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <!-- TABEL POTONGAN -->
    <div class="section-title" style="margin-top: 30px;">Rincian Potongan</div>
    <table class="salary-table">
        <thead>
            <tr>
                <th>Keterangan Komponen</th>
                <th class="amount-col">Jumlah (IDR)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Kasbon / Pemotongan Lainnya</td>
                <td class="amount" style="color: #e53e3e;">{{ number_format($gaji->potongan, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Denda Keterlambatan</td>
                <td class="amount" style="color: #e53e3e;">{{ number_format($gaji->denda_keterlambatan, 0, ',', '.') }}</td>
            </tr>
            <tr class="subtotal-row">
                <td style="text-align: right; padding-right: 15px;">TOTAL POTONGAN</td>
                @php
                    $total_potongan = $gaji->potongan + $gaji->denda_keterlambatan;
                @endphp
                <td class="amount" style="color: #e53e3e;">{{ number_format($total_potongan, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <!-- TOTAL TAKE HOME PAY -->
    <div class="net-pay-box">
        <div class="net-pay-label">Total Diterima (Take Home Pay)</div>
        <div class="net-pay-amount">Rp {{ number_format($gaji->total_gaji, 0, ',', '.') }}</div>
    </div>

    <div class="footer">
        <table class="signature-table">
            <tr>
                <td>
                    <p style="color: #718096; font-size: 12px; margin-bottom: 5px;">Penerima,</p>
                    <div style="height: 60px;"></div>
                    <div class="signature-area">{{ strtoupper($gaji->user->name) }}</div>
                </td>
                <td>
                    <p style="color: #718096; font-size: 12px; margin-bottom: 5px;">Kota Anda, {{ \Carbon\Carbon::parse($gaji->created_at)->format('d F Y') }}</p>
                    <p style="color: #718096; font-size: 12px; margin-top: 0;">Disetujui Oleh,</p>
                    <div style="height: 45px;"></div>
                    <div class="signature-area">MANAGER KEUANGAN</div>
                </td>
            </tr>
        </table>
    </div>

    <div class="note">
        Slip gaji ini digenerate secara otomatis oleh sistem komputer dan sah digunakan sebagai bukti penerimaan gaji tanpa perlu stempel perusahaan. Harap simpan dokumen ini dengan baik.
    </div>

</body>
</html>
