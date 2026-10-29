<article class="kartu">
    @if ($budaya->gambar)
        <img class="kartu__gambar" src="{{ asset('storage/' . $budaya->gambar) }}"
             alt="{{ $budaya->judul }}" loading="lazy">
    @else
        <div class="kartu__ph" aria-hidden="true"></div>
    @endif

    <div class="kartu__isi">
        <span class="lencana">{{ $budaya->kategori->nama }}</span>
        <h3><a href="{{ route('budaya.show', $budaya->slug) }}">{{ $budaya->judul }}</a></h3>
        <p>{{ $budaya->ringkasan }}</p>
        <a class="tautan" href="{{ route('budaya.show', $budaya->slug) }}">
            Baca Selengkapnya <span aria-hidden="true">&rarr;</span>
        </a>
    </div>
</article>