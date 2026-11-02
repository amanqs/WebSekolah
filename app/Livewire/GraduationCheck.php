<?php

namespace App\Livewire;

use App\Models\Graduation;
use App\Settings\GeneralSettings;
use Carbon\Carbon;
use Livewire\Component;

class GraduationCheck extends Component
{
    public string $nisn = '';
    public string $birth_date = '';
    public ?Graduation $result = null;
    public bool $hasSearched = false;
    public ?string $errorMessage = null;

    public function check(GeneralSettings $settings): void
    {
        $this->errorMessage = null;
        $this->result = null;
        $this->hasSearched = false;

        $this->validate([
            'nisn' => 'required|digits:10',
            'birth_date' => 'nullable|date',
        ]);

        if (!$settings->graduation_is_active) {
            $this->errorMessage = 'Pengumuman kelulusan saat ini belum diaktifkan oleh pihak sekolah.';
            return;
        }

        // Check countdown
        if ($settings->graduation_announcement_datetime) {
            $releaseTime = Carbon::parse($settings->graduation_announcement_datetime);
            if (now()->lessThan($releaseTime)) {
                $this->errorMessage = 'Waktu pengumuman belum tiba. Silakan tunggu hingga hitung mundur selesai.';
                return;
            }
        }

        $query = Graduation::where('nisn', $this->nisn);
        if ($this->birth_date) {
            $query->whereDate('birth_date', $this->birth_date);
        }

        $student = $query->first();

        $this->hasSearched = true;
        if ($student) {
            $this->result = $student;
        } else {
            $this->errorMessage = 'Data siswa dengan NISN ' . $this->nisn . ' tidak ditemukan dalam database kelulusan tahun ' . ($settings->graduation_academic_year ?? 'ini') . '. Pastikan nomor NISN yang Anda masukkan sudah benar.';
        }
    }

    public function resetSearch(): void
    {
        $this->reset(['nisn', 'birth_date', 'result', 'hasSearched', 'errorMessage']);
    }

    public function render(GeneralSettings $settings)
    {
        $targetDate = $settings->graduation_announcement_datetime ? Carbon::parse($settings->graduation_announcement_datetime) : null;
        $isLocked = $targetDate ? now()->lessThan($targetDate) : false;

        return view('livewire.graduation-check', [
            'settings' => $settings,
            'targetDate' => $targetDate,
            'isLocked' => $isLocked,
        ]);
    }
}

