<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PpdbRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_number',
        'academic_year',
        'full_name',
        'nisn',
        'nik',
        'gender',
        'birth_place',
        'birth_date',
        'religion',
        'address',
        'phone_number',
        'father_name',
        'father_occupation',
        'mother_name',
        'mother_occupation',
        'parent_income',
        'parent_phone',
        'previous_school_name',
        'previous_school_address',
        'average_score',
        'chosen_major',
        'file_photo',
        'file_kk',
        'file_birth_certificate',
        'file_report_or_diploma',
        'status',
        'admin_notes',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'average_score' => 'decimal:2',
    ];

    public static function boot(): void
    {
        parent::boot();

        static::creating(function ($registration) {
            if (empty($registration->registration_number)) {
                $year = date('Y');
                $count = static::whereYear('created_at', $year)->count() + 1;
                $registration->registration_number = sprintf('PPDB-%s-%04d', $year, $count);
            }
        });
    }

    public function scopeVerified(Builder $query): Builder
    {
        return $query->where('status', 'verified');
    }

    public function scopeAccepted(Builder $query): Builder
    {
        return $query->where('status', 'accepted');
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'Menunggu Verifikasi',
            'verified' => 'Terverifikasi (Tahap Seleksi)',
            'accepted' => 'DITERIMA (LOLOS)',
            'rejected' => 'TIDAK LOLOS',
            default => 'Pending',
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'warning',
            'verified' => 'info',
            'accepted' => 'success',
            'rejected' => 'danger',
            default => 'gray',
        };
    }

    public function getPhotoUrlAttribute(): string
    {
        if ($this->file_photo) {
            return asset('storage/' . $this->file_photo);
        }

        return 'https://ui-avatars.com/api/?name=' . urlencode($this->full_name) . '&background=1e40af&color=fff&size=200';
    }
}

