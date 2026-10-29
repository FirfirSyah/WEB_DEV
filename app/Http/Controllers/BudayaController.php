<?php

namespace App\Http\Controllers;

use App\Models\Budaya;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BudayaController extends Controller
{
    public function index(Request $request)
    {
        // Batasi panjang kata kunci, lalu escape karakter wildcard LIKE
        $q = Str::limit(trim((string) $request->query('q')), 100, '');
        $kategoriSlug = (string) $request->query('kategori');
        $like = '%' . addcslashes($q, '%_\\') . '%';

        $kategoris = Kategori::orderBy('nama')->get();

        $budayas = Budaya::published()
            ->with('kategori')
            ->when($q !== '', function ($query) use ($like) {
                $query->where(function ($w) use ($like) {
                    $w->where('judul', 'like', $like)
                      ->orWhere('ringkasan', 'like', $like)
                      ->orWhere('deskripsi', 'like', $like);
                });
            })
            ->when($kategoriSlug !== '', function ($query) use ($kategoriSlug) {
                $query->whereHas('kategori', fn ($k) => $k->where('slug', $kategoriSlug));
            })
            ->latest()
            ->orderByDesc('id')
            ->paginate(9)
            ->withQueryString();

        return view('budaya.index', compact('budayas', 'kategoris', 'q', 'kategoriSlug'));
    }

    public function show(string $slug)
    {
        $budaya = Budaya::published()
            ->with(['kategori', 'sumbers'])
            ->where('slug', $slug)
            ->firstOrFail();

        $terkait = Budaya::published()
            ->with('kategori')
            ->where('kategori_id', $budaya->kategori_id)
            ->where('id', '!=', $budaya->id)
            ->latest()
            ->orderByDesc('id')
            ->take(3)
            ->get();

        return view('budaya.show', compact('budaya', 'terkait'));
    }
}