@extends('layouts.admin')

@section('title', 'Ubah Kategori')

@section('content')
    <h1>Ubah Kategori</h1>

    <form method="POST" action="{{ route('admin.categories.update', $category) }}" class="form-card">
        @csrf
        @method('PUT')
        @include('admin.categories._form')
    </form>
@endsection