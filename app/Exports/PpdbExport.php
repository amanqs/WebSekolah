<?php

namespace App\Exports;

use App\Models\PpdbRegistration;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PpdbExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    public function collection()
    {
        return PpdbRegistration::all();
    }

    public function headings(): array
    {
        return [
            'No. Registrasi',
            'Tahun Ajaran',
            'Nama Lengkap',
            'NISN',
            'NIK',
            'Jenis Kelamin',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Agama',
            'Alamat',
            'No. WhatsApp / HP',
            'Nama Ayah',
            'Pekerjaan Ayah',
            'Nama Ibu',
            'Pekerjaan Ibu',
            'No. Telp Ortu',
            'Asal Sekolah',
            'Nilai Rata-rata',
            'Pilihan Jurusan',
            'Status Kelulusan PPDB',
            'Catatan Admin',
            'Tanggal Daftar',
        ];
    }

    /**
     * @param PpdbRegistration $registration
     */
    public function map($registration): array
    {
        return [
            $registration->registration_number,
            $registration->academic_year,
            $registration->full_name,
            $registration->nisn,
            $registration->nik,
            $registration->gender === 'L' ? 'Laki-Laki' : 'Perempuan',
            $registration->birth_place,
            $registration->birth_date?->format('d/m/Y'),
            $registration->religion,
            $registration->address,
            $registration->phone_number,
            $registration->father_name,
            $registration->father_occupation,
            $registration->mother_name,
            $registration->mother_occupation,
            $registration->parent_phone,
            $registration->previous_school_name,
            $registration->average_score,
            $registration->chosen_major,
            strtoupper($registration->status),
            $registration->admin_notes,
            $registration->created_at?->format('d/m/Y H:i'),
        ];
    }
}

