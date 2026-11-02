<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kartu Pendaftaran PPDB - {{ $registration->registration_number }}</title>
    <style>
        @page {
            margin: 20mm 15mm 20mm 15mm;
        }
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 11pt;
            color: #1f2937;
            line-height: 1.4;
        }
        /* Kop Surat */
        .kop-table {
            width: 100%;
            border-bottom: 3px double #1f2937;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        .kop-logo {
            width: 70px;
            text-align: center;
            vertical-align: middle;
        }
        .kop-text {
            text-align: center;
            vertical-align: middle;
        }
        .kop-title {
            font-size: 15pt;
            font-weight: bold;
            text-transform: uppercase;
            color: #111827;
            margin: 0;
        }
        .kop-subtitle {
            font-size: 9.5pt;
            color: #4b5563;
            margin: 3px 0 0 0;
        }
        /* Card Title */
        .card-header {
            text-align: center;
            margin-bottom: 18px;
        }
        .card-header h2 {
            font-size: 13pt;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 0;
            color: #1e3a8a;
        }
        .card-header .reg-number {
            display: inline-block;
            margin-top: 5px;
            padding: 4px 14px;
            background-color: #f1f5f9;
            border: 1px solid #cbd5e1;
            font-family: monospace;
            font-size: 12pt;
            font-weight: bold;
            color: #0f172a;
            border-radius: 4px;
        }
        /* Main Info Table */
        .content-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .section-header {
            background-color: #e2e8f0;
            font-weight: bold;
            font-size: 9.5pt;
            padding: 6px 10px;
            text-transform: uppercase;
            color: #1e293b;
        }
        .data-row td {
            padding: 5px 8px;
            font-size: 9.5pt;
            vertical-align: top;
            border-bottom: 1px solid #f1f5f9;
        }
        .label-col {
            width: 32%;
            color: #4b5563;
        }
        .colon-col {
            width: 3%;
            text-align: center;
        }
        .value-col {
            width: 65%;
            font-weight: 600;
            color: #111827;
        }
        /* Photo & QR */
        .photo-box {
            width: 110px;
            height: 140px;
            border: 1px dashed #94a3b8;
            background-color: #f8fafc;
            text-align: center;
            vertical-align: middle;
            font-size: 9pt;
            color: #64748b;
        }
        /* Footer signature */
        .footer-table {
            width: 100%;
            margin-top: 25px;
        }
        .footer-table td {
            vertical-align: top;
            font-size: 9.5pt;
        }
        .notice-box {
            margin-top: 20px;
            padding: 10px;
            background-color: #eff6ff;
            border-left: 3px solid #2563eb;
            font-size: 8.5pt;
            color: #1e40af;
            line-height: 1.4;
        }
    </style>
</head>
<body>

    <!-- KOP SURAT SEKOLAH -->
    <table class="kop-table">
        <tr>
            <td class="kop-logo">
                @if($settings->logo_light && file_exists(storage_path('app/public/' . $settings->logo_light)))
                    <img src="{{ storage_path('app/public/' . $settings->logo_light) }}" style="max-height: 65px; max-width: 65px;">
                @else
                    <div style="font-size: 32pt; color: #1e40af;">🏛️</div>
                @endif
            </td>
            <td class="kop-text">
                <div class="kop-title">{{ $settings->school_name }}</div>
                <div class="kop-subtitle">NPSN: {{ $settings->npsn }} | Jenjang: {{ $settings->school_level }}</div>
                <div class="kop-subtitle">{{ $settings->address }}</div>
                <div class="kop-subtitle">Telp: {{ $settings->phone }} | Email: {{ $settings->email }}</div>
            </td>
        </tr>
    </table>

    <!-- CARD TITLE -->
    <div class="card-header">
        <h2>Kartu Bukti Pendaftaran PPDB Online</h2>
        <div>Tahun Pelajaran: {{ $registration->academic_year }}</div>
        <div class="reg-number">{{ $registration->registration_number }}</div>
    </div>

    <!-- MAIN BODY: LEFT DETAILS, RIGHT PHOTO -->
    <table style="width: 100%;">
        <tr>
            <td style="width: 76%; vertical-align: top;">
                <!-- 1. DATA CALON SISWA -->
                <table class="content-table">
                    <tr>
                        <td colspan="3" class="section-header">A. Data Diri Calon Peserta Didik</td>
                    </tr>
                    <tr class="data-row">
                        <td class="label-col">Nama Lengkap</td>
                        <td class="colon-col">:</td>
                        <td class="value-col">{{ $registration->full_name }}</td>
                    </tr>
                    <tr class="data-row">
                        <td class="label-col">NISN / NIK</td>
                        <td class="colon-col">:</td>
                        <td class="value-col">{{ $registration->nisn }} / {{ $registration->nik ?: '-' }}</td>
                    </tr>
                    <tr class="data-row">
                        <td class="label-col">Jenis Kelamin</td>
                        <td class="colon-col">:</td>
                        <td class="value-col">{{ $registration->gender === 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
                    </tr>
                    <tr class="data-row">
                        <td class="label-col">Tempat, Tanggal Lahir</td>
                        <td class="colon-col">:</td>
                        <td class="value-col">{{ $registration->birth_place }}, {{ $registration->birth_date?->translatedFormat('d F Y') }}</td>
                    </tr>
                    <tr class="data-row">
                        <td class="label-col">Agama</td>
                        <td class="colon-col">:</td>
                        <td class="value-col">{{ $registration->religion }}</td>
                    </tr>
                    <tr class="data-row">
                        <td class="label-col">Nomor WhatsApp / HP</td>
                        <td class="colon-col">:</td>
                        <td class="value-col">{{ $registration->phone_number }}</td>
                    </tr>
                    <tr class="data-row">
                        <td class="label-col">Alamat Lengkap</td>
                        <td class="colon-col">:</td>
                        <td class="value-col">{{ $registration->address }}</td>
                    </tr>

                    <!-- 2. DATA ORANG TUA / WALI -->
                    <tr>
                        <td colspan="3" class="section-header" style="padding-top: 10px;">B. Data Orang Tua / Wali</td>
                    </tr>
                    <tr class="data-row">
                        <td class="label-col">Nama Ayah / Ibu</td>
                        <td class="colon-col">:</td>
                        <td class="value-col">{{ $registration->father_name }} / {{ $registration->mother_name }}</td>
                    </tr>
                    <tr class="data-row">
                        <td class="label-col">No. Kontak Orang Tua</td>
                        <td class="colon-col">:</td>
                        <td class="value-col">{{ $registration->parent_phone }}</td>
                    </tr>

                    <!-- 3. ASAL SEKOLAH & JURUSAN -->
                    <tr>
                        <td colspan="3" class="section-header" style="padding-top: 10px;">C. Sekolah Asal & Pilihan</td>
                    </tr>
                    <tr class="data-row">
                        <td class="label-col">Asal Sekolah</td>
                        <td class="colon-col">:</td>
                        <td class="value-col">{{ $registration->previous_school_name }}</td>
                    </tr>
                    <tr class="data-row">
                        <td class="label-col">Nilai Rata-rata</td>
                        <td class="colon-col">:</td>
                        <td class="value-col">{{ $registration->average_score ?: '-' }}</td>
                    </tr>
                    <tr class="data-row">
                        <td class="label-col">Pilihan Jurusan / Peminatan</td>
                        <td class="colon-col">:</td>
                        <td class="value-col">{{ $registration->chosen_major ?: '-' }}</td>
                    </tr>
                </table>
            </td>

            <!-- RIGHT PHOTO BOX -->
            <td style="width: 24%; vertical-align: top; text-align: center; padding-left: 15px;">
                <div class="photo-box">
                    @if($registration->file_photo && file_exists(storage_path('app/public/' . $registration->file_photo)))
                        <img src="{{ storage_path('app/public/' . $registration->file_photo) }}" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <div style="padding-top: 45px;">
                            PAS FOTO<br>3 x 4
                        </div>
                    @endif
                </div>

                <div style="margin-top: 20px; font-size: 8pt; color: #4b5563; text-align: center;">
                    <div style="border: 1px solid #cbd5e1; padding: 6px; border-radius: 4px;">
                        <strong>QR VERIFIKASI</strong><br>
                        <span style="font-family: monospace; font-size: 7.5pt;">{{ $registration->registration_number }}</span>
                    </div>
                </div>
            </td>
        </tr>
    </table>

    <!-- INSTRUCTIONS NOTICE -->
    <div class="notice-box">
        <strong>PETUNJUK PENTING:</strong>
        <ol style="margin: 3px 0 0 15px; padding: 0;">
            <li>Kartu ini adalah bukti sah pendaftaran online di {{ $settings->school_name }}.</li>
            <li>Bawalah kartu pendaftaran ini beserta berkas fisik asli (KK, Akta Kelahiran, Ijazah/SKL) pada saat jadwal verifikasi fisik dan daftar ulang.</li>
            <li>Pantau perkembangan status seleksi melalui portal resmi sekolah.</li>
        </ol>
    </div>

    <!-- SIGNATURE AREA -->
    <table class="footer-table">
        <tr>
            <td style="width: 50%; text-align: center;">
                Calon Peserta Didik,
                <br><br><br><br>
                <strong>( {{ $registration->full_name }} )</strong>
            </td>
            <td style="width: 50%; text-align: center;">
                Dicetak pada: {{ date('d F Y') }}<br>
                Panitia PPDB {{ $settings->school_name }},
                <br><br><br><br>
                <strong>( Tim Panitia PPDB )</strong>
            </td>
        </tr>
    </table>

</body>
</html>

