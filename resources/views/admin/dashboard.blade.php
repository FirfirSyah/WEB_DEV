@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <h1>Selamat datang, {{ auth()->user()->name }}</h1>
    <p>Gunakan menu di atas untuk mengelola data WARISAKU SAMBAS.</p>
@endsection