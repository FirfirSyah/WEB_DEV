<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Budaya extends Model
{
    protected $table = 'budayas';

    protected $fillable = [
        'kategori_id',
        'judul',
        'slug',
        'ringkasan',
        'deskripsi',
        'gambar',
        'asal_lokasi',
        'status',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function sumbers(): HasMany
    {
        return $this->hasMany(SumberBudaya::class, 'budaya_id');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }
}