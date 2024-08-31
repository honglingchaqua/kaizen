<!-- resources/views/ar.blade.php -->

@extends('layouts.vertical', ['title' => $title, 'sub_title' => 'Forms & Extended'])

@section('css')
    <!-- CSS untuk Data Table -->
    @vite(['resources/css/gridjs-theme-mermaid.css', 'resources/css/sweetalert2.css'])
    
    <!-- CSS untuk Swiper slider -->
    @vite(['resources/css/swiper-bundle.min.css'])
    
    <!-- Kustom CSS untuk animasi berita -->
@endsection

@section('content')
<div class="pt-2">
    <div class="mb-2 p-2 bg-yellow-100 border border-yellow-300 rounded-lg">
        <h5 class="text-lg font-semibold text-yellow-800">Masalah Piutang Perusahaan</h5>
        <p class="text-yellow-700">Total Piutang: Rp. 1,3 M</p>
    </div>
</div>
@endsection
