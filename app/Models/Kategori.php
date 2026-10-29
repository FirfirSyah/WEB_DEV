<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategori extends Model
{
    protected $table = 'kategoris';

    protected $fillable = [
        'nama',
        'slug',
        'deskripsi',
        'ikon',
    ];

    public function budayas(): HasMany
    {
        return $this->hasMany(Budaya::class, 'kategori_id');
    }
}