<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Graduation extends Model
{
    use HasFactory;

    protected $fillable = [
        'academic_year',
        'nisn',
        'exam_number',
        'name',
        'birth_date',
        'class_name',
        'status',
        'average_score',
        'note',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'average_score' => 'decimal:2',
    ];

    public function scopeActiveYear(Builder $query, string $year): Builder
    {
        return $query->where('academic_year', $year);
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'lulus' => 'LULUS',
            'tidak_lulus' => 'TIDAK LULUS',
            'tertunda' => 'DITUNDA / HUBUNGI SEKOLAH',
            default => 'TIDAK DIKETAHUI',
        };
    }
}

