@extends('layouts.app')

@section('title', 'Jelajahi Budaya')
@section('description', 'Telusuri informasi budaya Sambas berdasarkan kata kunci dan kategori.')

@section('content')
    <section class="judul-halaman">
        <div class="kontainer">
            <span class="garis-emas"></span>
            <h1>Jelajahi Budaya</h1>
            <p class="subjudul">Cari dan telusuri warisan budaya Sambas berdasarkan kata kunci atau kategori.</p>
        </div>
    </section>

    <section class="seksi">
        <div class="kontainer">

            <form method="GET" action="{{ route('budaya.index') }}" class="filter" role="search">
                <div class="filter__kolom filter__kolom--cari">
                    <label for="q">Kata kunci</label>
                    <input type="search" id="q" name="q" value="{{ $q }}"
                           maxlength="100" placeholder="Cari judul atau kata kunci...">
                </div>

                <div class="filter__kolom">
                    <label for="kategori">Kategori</label>
                    <select id="kategori" name="kategori">
                        <option value="">Semua Kategori</option>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->slug }}" @selected($kategoriSlug === $kategori->slug)>
                                {{ $kategori->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="filter__aksi">
                    <button type="submit" class="btn btn--emas">Cari</button>
                    @if ($q !== '' || $kategoriSlug !== '')
                        <a href="{{ route('budaya.index') }}" class="btn btn--tipis">Reset</a>
                    @endif
                </div>
            </form>

            @if ($budayas->total() > 0)
                <p class="info-hasil" aria-live="polite">
                    Menampilkan {{ $budayas->firstItem() }}&ndash;{{ $budayas->lastItem() }}
                    dari {{ $budayas->total() }} konten
                    @if ($q !== '') untuk kata kunci &ldquo;{{ $q }}&rdquo; @endif
                </p>

                <div class="grid grid--kartu">
                    @foreach ($budayas as $budaya)
                        @include('partials.kartu-budaya', ['budaya' => $budaya])
                    @endforeach
                </div>

                {{ $budayas->links('pagination.warisaku') }}
            @else
                <div class="kosong" aria-live="polite">
                    <h2>Tidak ada hasil yang ditemukan</h2>
                    <p>
                        Coba gunakan kata kunci lain atau pilih kategori yang berbeda.
                    </p>
                    <a href="{{ route('budaya.index') }}" class="btn btn--emas">Tampilkan Semua</a>
                </div>
            @endif

        </div>
    </section>
@endsection