@extends('layouts.admin')

@section('title', 'Kategori')

@section('content')
    <div class="page-head">
        <h1>Kategori Budaya</h1>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-gold">+ Tambah Kategori</a>
    </div>

    <div class="table-wrap">
        @if ($categories->count())
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Slug</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>{{ $category->description ?: '-' }}</td>
                            <td>
                                <div class="row-actions">
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-light">Ubah</a>
                                    <form method="POST"
                                          action="{{ route('admin.categories.destroy', $category) }}"
                                          onsubmit="return confirm('Hapus kategori {{ $category->name }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="empty">Belum ada kategori. Klik "Tambah Kategori" untuk membuat yang pertama.</p>
        @endif
    </div>

    {{ $categories->links('pagination::simple-default') }}
@endsection