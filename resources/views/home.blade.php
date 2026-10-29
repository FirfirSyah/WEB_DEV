@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    {{-- HERO --}}
    <section class="hero">
        <div class="kontainer hero__isi">
            <div>
                <p class="eyebrow">Warisan Budaya Kalimantan Barat</p>
                <h1>Kenali Warisan Budaya Sambas</h1>
                <p>
                    WARISAKU SAMBAS menghimpun tradisi, kesenian, kuliner, pakaian adat, dan situs
                    bersejarah Sambas dalam satu tempat, lengkap dengan sumber rujukannya.
                </p>
                <p>
                    <a href="{{ route('budaya.index') }}" class="btn btn--emas">Mulai Menjelajah</a>
                    <a href="{{ route('tentang') }}" class="btn btn--garis">Tentang Proyek</a>
                </p>
            </div>

            {{-- Ganti panel ini dengan foto budaya berlisensi bila sudah tersedia (cantumkan sumbernya) --}}
            <div class="hero__visual" aria-hidden="true">
                <div>
                    <span class="eyebrow">Kabupaten Sambas</span>
                    <p>Kalimantan Barat</p>
                </div>
            </div>
        </div>
        <div class="ornamen" aria-hidden="true"></div>
    </section>

    {{-- BUDAYA PILIHAN (carousel React) --}}
    <section class="seksi" id="budaya-pilihan">
        <div class="kontainer">
            <div class="seksi__kepala">
                <span class="garis-emas"></span>
                <h2>Budaya Pilihan</h2>
                <p>Geser kartu, klik kartu di samping, atau gunakan tombol panah di keyboard.</p>
            </div>

            {{-- Isi di dalam div ini adalah cadangan; React menggantinya bila JavaScript aktif --}}
            <div id="carousel-root" data-items="{{ json_encode($items, JSON_UNESCAPED_UNICODE) }}">
                <div class="grid grid--kartu">
                    @forelse ($budayas as $budaya)
                        @include('partials.kartu-budaya', ['budaya' => $budaya])
                    @empty
                        <p>Belum ada konten yang dipublikasikan.</p>
                    @endforelse
                </div>
            </div>

            <p class="tengah">
                <a href="{{ route('budaya.index') }}" class="btn btn--emas">Lihat Semua Budaya</a>
            </p>
        </div>
    </section>

    {{-- KATEGORI --}}
    <section class="seksi seksi--pucat" id="kategori">
        <div class="kontainer">
            <div class="seksi__kepala">
                <span class="garis-emas"></span>
                <h2>Kategori Budaya</h2>
                <p>Telusuri warisan budaya berdasarkan kelompoknya.</p>
            </div>

            <div class="grid grid--kategori">
                @forelse ($kategoris as $kategori)
                    <a class="kat" href="{{ route('budaya.index', ['kategori' => $kategori->slug]) }}">
                        <h3>{{ $kategori->nama }}</h3>
                        <span>{{ $kategori->budayas_count }} konten</span>
                    </a>
                @empty
                    <p>Belum ada kategori. Jalankan <code>php artisan db:seed</code>.</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- AJAKAN --}}
    <section class="cta">
        <div class="kontainer">
            <h2>Mari Kenali dan Jaga Warisan Kita</h2>
            <p>Pelestarian budaya dimulai dari mengenalnya. Pelajari tujuan dan cara kurasi konten di WARISAKU SAMBAS.</p>
            <a href="{{ route('tentang') }}" class="btn btn--emas">Baca Selengkapnya</a>
        </div>
    </section>
@endsection

@push('scripts')
    @viteReactRefresh
    @vite('resources/js/carousel.jsx')
@endpush