@extends('layouts.vertical', ['title' => 'Data Table & Swiper', 'sub_title' => 'Forms & Extended'])

@section('css')
    <!-- CSS untuk Data Table dan Swiper slider -->
    @vite(['resources/css/gridjs-theme-mermaid.css', 'resources/css/sweetalert2.css', 'resources/css/swiper-bundle.min.css'])
    <!-- CSS untuk Swiper slider -->
    @vite(['node_modules/swiper/swiper-bundle.min.css'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Kustom CSS untuk animasi berita -->
    <style>
        .news-marquee-wrapper {
            overflow: hidden;
            white-space: nowrap;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.1);
            background: #1a202c; /* Warna latar belakang */
            padding: 1rem;
            border-radius: 0.5rem;
        }

        .news-marquee {
            display: inline-block;
            white-space: nowrap;
            animation: marquee 10s linear infinite;
        }

        @keyframes marquee {
            0% {
                transform: translateX(500%);
            }
            100% {
                transform: translateX(-100%);
            }
        }

        .news-marquee h1 {
            color: #f7fafc; /* Warna teks */
            font-size: 1.5rem;
            font-weight: bold;
            margin: 0;
        }

        /* Kustom CSS untuk ikon lonceng */
        .bell-icon {
            position: relative;
            top: -5px;
            margin-right: 5px;
            font-size: 1rem;
            color: #ff9800;
            animation: ring 2s infinite;
        }

        @keyframes ring {
            0% { transform: rotate(0); }
            10% { transform: rotate(15deg); }
            20% { transform: rotate(-15deg); }
            30% { transform: rotate(15deg); }
            40% { transform: rotate(-15deg); }
            50% { transform: rotate(0); }
        }
    </style>
@endsection

@section('content')
<div class="bg-white rounded-2xl flex justify-center mb-4">
    <img src="/images/Black Retro Minimalist Vegan Cafe Logo.png" alt="Atas" class="mx-auto h-24">
</div>

<div class="container mx-auto p-4">
    <!-- Wrapper untuk animasi berita -->
    <div class="news-marquee-wrapper mb-4">
        <div class="news-marquee">
            <h1>
                <i class="fas fa-car mr-2"></i> <!-- Ikon mobil -->
                Waktunya Service Nih !!
            </h1>
        </div>
    </div>

    <div class="w-full overflow-x-auto overflow-y-auto max-h-[24rem] border border-gray-300 rounded bg-white">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="w-full bg-gray-100 border-b border-gray-200">
                    <th class="px-4 py-2 text-left">No Pol</th>
                    <th class="px-4 py-2 text-left">No Rangka</th>
                    <th class="px-4 py-2 text-left">Model</th>
                    <th class="px-4 py-2 text-left">Warna</th>
                    <th class="px-4 py-2 text-left">Tanggal DEC</th>
                    <th class="px-4 py-2 text-left">Tanggal Next Service</th>
                    <th class="px-4 py-2 text-left">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vehicles as $vehicle)
                    <tr>
                        <td class="px-4 py-2 border-b border-gray-200">
                            @if ($vehicle->service_alert)
                                <i class="fas fa-bell bell-icon"></i>
                            @endif
                            {{ $vehicle->nopol }}
                        </td>
                        <td class="px-4 py-2 border-b border-gray-200">
                            <a href="/vehicles/{{ $vehicle->id }}/edit" class="text-blue-600 hover:text-blue-800">
                                <button class="text-blue-600 hover:text-blue-800">
                                    {{ $vehicle->no_rangka }}
                                </button>
                            </a>
                        </td>
                        
                        <td class="px-4 py-2 border-b border-gray-200">{{ $vehicle->model }}</td>
                        <td class="px-4 py-2 border-b border-gray-200">{{ $vehicle->warna }}</td>
                        <td class="px-4 py-2 border-b border-gray-200">{{ $vehicle->tgl_dec }}</td>
                        <td class="px-4 py-2 border-b border-gray-200">{{ $vehicle->tanggal_next_service }}</td>
                        <td class="px-4 py-2 border-b border-gray-200">
                            <a href="https://wa.me/+628117483800?text=Hi%2C%20I%20would%20like%20to%20book%20a%20service%20for%20vehicle%20with%20ID%20{{ $vehicle->id }}" 
                               class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition"
                               target="_blank">
                               <i class="fas fa-tools mr-1"></i> Booking Service
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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

    <!-- Include SweetAlert2 -->
    @vite(['node_modules/sweetalert2/dist/sweetalert2.all.min.js'])

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Check if the alert is needed (e.g., user is logged in)
            @if (session('status') === 'logged_in')
                Swal.fire({
                    title: 'Selamat Datang!',
                    text: 'Selamat Datang Adi Sarana',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            @endif

            // Open modal and populate content
            document.querySelectorAll('.open-modal').forEach(button => {
                button.addEventListener('click', function () {
                    const vehicleInfo = this.dataset.vehicleInfo; // Data vehicle info
                    document.getElementById('modal-body').innerHTML = vehicleInfo;
                    modal.classList.remove('hidden');
                });
            });

            // Close modal
            closeModalButtons.forEach(button => {
                button.addEventListener('click', function () {
                    modal.classList.add('hidden');
                });
            });

            // Close modal on background click
            modal.addEventListener('click', function (event) {
                if (event.target === modal) {
                    modal.classList.add('hidden');
                }
            });
        });
    </script>
@endsection
