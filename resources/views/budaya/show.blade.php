@extends('layouts.app')

@section('title', $budaya->judul)
@section('description', Str::limit($budaya->ringkasan, 150))

@section('content')
    <section class="judul-halaman">
        <div class="kontainer">
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <ol>
                    <li><a href="{{ route('home') }}">Beranda</a></li>
                    <li><a href="{{ route('budaya.index') }}">Jelajahi Budaya</a></li>
                    <li aria-current="page">{{ $budaya->judul }}</li>
                </ol>
            </nav>
            <span class="lencana">{{ $budaya->kategori->nama }}</span>
            <h1>{{ $budaya->judul }}</h1>
        </div>
    </section>

    <div class="kontainer">
        <article class="detail">
            @if ($budaya->gambar)
                <img class="detail__gambar" src="{{ asset('storage/' . $budaya->gambar) }}"
                     alt="{{ $budaya->judul }}">
            @else
                <div class="detail__gambar detail__gambar--ph" aria-hidden="true"></div>
            @endif

            <p class="detail__ringkasan">{{ $budaya->ringkasan }}</p>

            <dl class="meta">
                <div>
                    <dt>Kategori</dt>
                    <dd>{{ $budaya->kategori->nama }}</dd>
                </div>
                @if ($budaya->asal_lokasi)
                    <div>
                        <dt>Asal / Lokasi</dt>
                        <dd>{{ $budaya->asal_lokasi }}</dd>
                    </div>
                @endif
            </dl>

            <div class="isi">
                {!! nl2br(e($budaya->deskripsi)) !!}
            </div>

            <section class="sumber" aria-labelledby="judul-sumber">
                <h2 id="judul-sumber">Sumber Rujukan</h2>

                @forelse ($budaya->sumbers as $sumber)
                    @if ($loop->first) <ol> @endif
                        <li>
                            <strong>{{ $sumber->judul_sumber }}</strong>
                            @if ($sumber->penulis_lembaga) &mdash; {{ $sumber->penulis_lembaga }} @endif
                            @if ($sumber->tahun) ({{ $sumber->tahun }}) @endif
                            @if ($sumber->url && Str::startsWith($sumber->url, ['http://', 'https://']))
                                <br><a href="{{ $sumber->url }}" target="_blank" rel="noopener noreferrer">{{ $sumber->url }}</a>
                            @endif
                            @if ($sumber->catatan)
                                <br><span class="catatan">{{ $sumber->catatan }}</span>
                            @endif
                        </li>
                    @if ($loop->last) </ol> @endif
                @empty
                    <p>Belum ada sumber rujukan yang dicantumkan untuk konten ini.</p>
                @endforelse
            </section>

            <p><a href="{{ route('budaya.index') }}" class="tautan"><span aria-hidden="true">&larr;</span> Kembali ke daftar budaya</a></p>
        </article>
    </div>

    @if ($terkait->isNotEmpty())
        <section class="seksi seksi--pucat">
            <div class="kontainer">
                <div class="seksi__kepala">
                    <span class="garis-emas"></span>
                    <h2>Budaya Terkait</h2>
                    <p>Konten lain dalam kategori {{ $budaya->kategori->nama }}.</p>
                </div>
                <div class="grid grid--kartu">
                    @foreach ($terkait as $item)
                        @include('partials.kartu-budaya', ['budaya' => $item])
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection