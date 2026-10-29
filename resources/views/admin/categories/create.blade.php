@extends('layouts.admin')

@section('title', 'Tambah Kategori')

@section('content')
    <h1>Tambah Kategori</h1>

    <form method="POST" action="{{ route('admin.categories.store') }}" class="form-card">
        @csrf
        @include('admin.categories._form')
    </form>
@endsection