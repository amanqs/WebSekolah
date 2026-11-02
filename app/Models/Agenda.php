<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'start_date',
        'end_date',
        'time',
        'location',
        'organizer',
        'description',
        'is_active',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
    ];

    public static function boot(): void
    {
        parent::boot();
        static::creating(function ($item) {
            if (empty($item->slug)) {
                $item->slug = Str::slug($item->title);
            }
        });
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('start_date', 'asc');
    }

    public function scopeUpcoming(Builder $query): Builder
    {
        return $query->where('is_active', true)
            ->where('start_date', '>=', now()->toDateString())
            ->orderBy('start_date', 'asc');
    }
}

