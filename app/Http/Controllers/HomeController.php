<?php

namespace App\Http\Controllers;

use App\Models\Budaya;
use App\Models\Kategori;

class HomeController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::withCount([
            'budayas' => fn ($q) => $q->where('status', 'published'),
        ])->orderBy('nama')->get();

        $budayas = Budaya::published()
            ->with('kategori')
            ->latest()
            ->orderByDesc('id')
            ->take(8)
            ->get();

        // Data untuk carousel React
        $items = $budayas->map(fn ($b) => [
            'id'        => $b->id,
            'judul'     => $b->judul,
            'ringkasan' => $b->ringkasan,
            'kategori'  => $b->kategori->nama,
            'gambar'    => $b->gambar ? asset('storage/' . $b->gambar) : null,
            'url'       => route('budaya.show', $b->slug),
        ])->values();

        return view('home', compact('kategoris', 'budayas', 'items'));
    }
}