@extends('layouts.vertical', ['title' => 'Data Table & Swiper', 'sub_title' => 'Forms & Extended'])

@section('css')
    <!-- CSS untuk Data Table -->
    @vite(['node_modules/gridjs/dist/theme/mermaid.css', 'node_modules/sweetalert2/dist/sweetalert2.css'])
    
    <!-- CSS untuk Swiper slider -->
    @vite(['node_modules/swiper/swiper-bundle.min.css'])
@endsection

@section('content')
<div class="flex flex-col gap-6 mb-6">
    <!-- Data Table Section -->
    <div class="card">
        <div class="card-header flex justify-between items-center">
            <h4 class="card-title">List Kendaraan Kamu Nih</h4>
        </div>
        <div class="p-6">
            <p class="text-sm text-slate-700 dark:text-slate-400 mb-4">
                Daftar kendaraan yang terdaftar. Anda dapat menambahkan, mengedit, atau menghapus kendaraan.
            </p>
            
            <!-- Filter Dropdown -->
            <div class="filters-container mb-4 flex flex-wrap gap-4">
                <select id="customerFilter" class="filter-dropdown border rounded px-4 py-2">
                    <option value="">Semua Customer</option>
                    <option value="PT. ADI SARANA ARMADA, TBK">PT. ADI SARANA ARMADA, TBK</option>
                </select>
            
                <select id="tahunFilter" class="filter-dropdown border rounded px-8 py-2">
                    <option value="">Semua Tahun</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <!-- Tambahkan tahun sesuai kebutuhan -->
                </select>
            
                <select id="bulanFilter" class="filter-dropdown border rounded px-4 py-2">
                    <option value="">Semua Bulan</option>
                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
            
                <select id="masaPakaiFilter" class="filter-dropdown border rounded px-4 py-2">
                    <option value="">Semua Masa Pakai</option>
                    <option value="1-3">1-3 tahun</option>
                    <option value="4-6">4-6 tahun</option>
                    <option value="7-9">7-9 tahun</option>
                    <option value=">10">> 10 tahun</option>
                </select>
            
                <select id="warnaFilter" class="filter-dropdown border rounded px-4 py-2">
                    <option value="">Semua Warna</option>
                    <option value="PUTIH">Putih</option>
                    <option value="HITAM">Hitam</option>
                    <option value="HITAM METALIK">Hitam Metalik</option>
                    <option value="HITAM - ORANYE">Hitam Oranye</option>
                    <option value="HITAM - PUTIH">Hitam Putih</option>
                    <option value="HITAM - SILVER">Hitam Silver</option>
                    <option value="HITAM SILVER METALIK">Hitam Silver Metalik</option>
                    <option value="HITAM BIRU METALIK">Hitam Biru Metalik</option>
                    <option value="HITAM KUNING">Hitam Kuning</option>
                    <option value="HITAM MERAH">Hitam Merah</option>
                    <option value="SILVER METALIK">Silver Metalik</option>
                    <option value="ABU-ABU METALIK">Abu-Abu Metalik</option>
                    <option value="Merah">Merah</option>
                    <option value="BIRU METALIK">Biru Metalik</option>
                    <option value="BIRU TUA METALIK">Biru Tua Metalik</option>
                    <option value="COKLAT METALIK">Coklat Metalik</option>
                    <option value="KUNING">Kuning</option>
                    <option value="KUNING METALIK">Kuning Metalik</option>
                </select>
            </div>
            

            <div id="table-gridjs"></div>
        </div>
    </div>
</div>

<div class="flex flex-wrap justify-center gap-6">
    <!-- Card 1 -->
    <div class="card w-96 h-96 bg-white shadow-md rounded-lg overflow-hidden">
        <div class="card-header flex justify-center items-center p-4 border-b border-gray-200">
            <h4 class="card-title text-lg font-semibold">Service Marketing</h4>
        </div>
        <div class="px-2 py-2 flex-grow">
            <div class="swiper pagination-dynamic-swiper rounded">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="/images/small/WhatsApp Image 2024-08-27 at 1.54.42 PM.jpeg" alt="" class="w-full h-full object-cover">
                    </div>
                    <div class="swiper-slide">
                        <img src="/images/small/WhatsApp Image 2024-08-27 at 1.53.50 PM.jpeg" alt="" class="w-full h-full object-cover">
                    </div>
                    <div class="swiper-slide">
                        <img src="/images/small/WhatsApp Image 2024-08-27 at 1.56.19 PM.jpeg" alt="" class="w-full h-full object-cover">
                    </div>
                </div>
                <div class="swiper-pagination dynamic-pagination"></div>
            </div>
        </div>
    </div>

    <!-- Card 2 -->
    <div class="card w-96 h-96 bg-white shadow-md rounded-lg overflow-hidden">
        <div class="card-header flex justify-center items-center p-4 border-b border-gray-200">
            <h4 class="card-title text-lg font-semibold">Body Paint Marketing</h4>
        </div>
        <div class="px-2 py-2 flex-grow">
            <div class="swiper pagination-dynamic-swiper rounded">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="/images/small/WhatsApp Image 2024-08-27 at 2.15.29 PM.jpeg" alt="" class="w-full h-full object-cover">
                    </div>
                    <div class="swiper-slide">
                        <img src="/images/small/WhatsApp Image 2024-08-27 at 2.14.57 PM.jpeg" alt="" class="w-full h-full object-cover">
                    </div>
                    <div class="swiper-slide">
                        <img src="/images/small/WhatsApp Image 2024-08-27 at 2.36.19 PM.jpeg" alt="" class="w-full h-full object-cover">
                    </div>
                </div>
                <div class="swiper-pagination dynamic-pagination"></div>
            </div>
        </div>
    </div>

    <!-- Card 3 -->
    <div class="card w-96 h-96 bg-white shadow-md rounded-lg overflow-hidden">
        <div class="card-header flex justify-center items-center p-4 border-b border-gray-200">
            <h4 class="card-title text-lg font-semibold">Sales Campaign</h4>
        </div>
        <div class="px-2 py-2 flex-grow">
            <div class="swiper pagination-dynamic-swiper rounded">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="/images/small/Gambar WhatsApp 2024-08-23 pukul 08.51.34_a49e3368.jpg" alt="" class="w-full h-full object-cover">
                    </div>
                    <div class="swiper-slide">
                        <img src="/images/small/Screenshot 2024-08-27 140527.png" alt="" class="w-full h-full object-cover">
                    </div>
                    <div class="swiper-slide">
                        <img src="/images/small/Screenshot 2024-08-27 140554.png" alt="" class="w-full h-full object-cover">
                    </div>
                </div>
                <div class="swiper-pagination dynamic-pagination"></div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    <!-- JavaScript untuk Data Table -->
    @vite(['resources/js/pages/table-gridjs.js'])

    <!-- JavaScript untuk Swiper slider -->
    @vite(['resources/js/pages/extended-swiper.js'])
    @vite(['resources/js/pages/highlight.js'])
@endsection