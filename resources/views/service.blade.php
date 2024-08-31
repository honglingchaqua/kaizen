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
<div class="container">
    <h1>List of Services</h1>

    <!-- Cek apakah ada data service -->
    @if($services->count() > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Service</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                <!-- Looping data services -->
                @foreach($services as $key => $service)
                    <tr>
                        <td>{{ $key + 1 }}</td> <!-- Nomor urut -->
                        <td>{{ $service->name }}</td> <!-- Kolom nama -->
                        <td>{{ $service->description }}</td> <!-- Kolom deskripsi -->
                        <td>{{ $service->price }}</td> <!-- Kolom harga -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Tidak ada data service yang tersedia.</p>
    @endif
</div>
@endsection