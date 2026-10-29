<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SumberBudaya extends Model
{
    protected $table = 'sumber_budayas';

    protected $fillable = [
        'budaya_id',
        'judul_sumber',
        'penulis_lembaga',
        'tahun',
        'url',
        'catatan',
    ];

    public function budaya(): BelongsTo
    {
        return $this->belongsTo(Budaya::class, 'budaya_id');
    }
}