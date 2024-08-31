@extends('layouts.vertical', ['title' => 'Data Edit', 'sub_title' => 'Forms & Extended'])

@section('css')
    @vite(['node_modules/gridjs/dist/theme/mermaid.css', 'node_modules/sweetalert2/dist/sweetalert2.css', 'node_modules/swiper/swiper-bundle.min.css'])
@endsection

@section('content')
<div class="card">
    <div class="card-header flex items-center justify-between">
        <div>
            <h3 class="card-title font-bold text-xl">Info Kendaraan</h3>
            <h4 class="card-title font-bold text-xl">{{ $vehicle->nopol }}</h4>
        </div>
        <button type="button" class="bg-danger text-white flex items-center justify-center rounded" style="width: 2cm; height: 2cm;" onclick="window.location.href='https://wa.me/+628117483800?text=Hi%2C%20I%20would%20like%20to%20book%20a%20service%20for%20vehicle%20with%20ID%20'">
            Booking Service
        </button>
    </div>
    
    <div class="p-6">
        <form id="vehicleForm" method="POST" action="{{ route('vehicles.update', $vehicle->id) }}">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="nopol" class="text-gray-800 text-sm font-medium inline-block mb-2">Nopol</label>
                    <input type="text" class="form-input w-full bg-gray-300" name="nopol" id="nopol" value="{{ $vehicle->nopol }}" required readonly>
                </div>
                <div>
                    <label for="no_rangka" class="text-gray-800 text-sm font-medium inline-block mb-2">No Rangka</label>
                    <input type="text" class="form-input w-full bg-gray-300" name="no_rangka" id="no_rangka" value="{{ $vehicle->no_rangka }}" required readonly>
                </div>
                <div>
                    <label for="model" class="text-gray-800 text-sm font-medium inline-block mb-2">Model</label>
                    <input type="text" class="form-input w-full bg-gray-300" name="model" id="model" value="{{ $vehicle->model }}" required readonly>
                </div>
                <div>
                    <label for="warna" class="text-gray-800 text-sm font-medium inline-block mb-2">Warna</label>
                    <input type="text" class="form-input w-full bg-gray-300" name="warna" id="warna" value="{{ $vehicle->warna }}" required readonly>
                </div>
                <div>
                    <label for="tgl_dec" class="text-gray-800 text-sm font-medium inline-block mb-2">Tanggal DEC</label>
                    <input type="date" class="form-input w-full bg-gray-300" name="tgl_dec" id="tgl_dec" value="{{ $vehicle->tgl_dec }}" required readonly>
                </div>
                
                <div>
                    <label for="masa_pakai" class="text-gray-800 text-sm font-medium inline-block mb-2">Masa Pakai </label>
                    <input type="text" class="form-input w-full bg-gray-300" name="masa_pakai" id="masa_pakai" value="{{ $vehicle->masa_pakai }}" required readonly >
                </div>
                
                <div>
                    <label for="last_service" class="text-gray-800 text-sm font-medium inline-block mb-2">Tanggal Last Service </label>
                    <input type="date" class="form-input w-full bg-gray-300" name="last_service" id="last_service" value="{{ $vehicle->tanggal_last_service }}" required readonly >
                </div>

                <div>
                    <label for="next_service" class="text-gray-800 text-sm font-medium inline-block mb-2">Tanggal Next Service </label>
                    <input type="date" class="form-input w-full bg-gray-300" name="next_service" id="next_service" value="{{ $vehicle->tanggal_next_service }}" required readonly >
                </div>

                <div class="col-span-1 md:col-span-2">
                    <label for="note" class="text-gray-800 text-sm font-medium inline-block mb-2">Note Service</label>
                    <input type="text" class="form-input w-full bg-gray-300" name="note" id="note"  value="{{ $vehicle->note }}">
                </div>

                <!-- New Input: Asuransi -->
                <div>
                    <label for="asuransi" class="text-gray-800 text-sm font-medium inline-block mb-2">Asuransi</label>
                    <input type="text" class="form-input w-full bg-gray-300" name="asuransi" id="asuransi" value="{{ $vehicle->asuransi }}" required readonly >
                </div>

                <!-- New Input: Aktif Tanggal -->
                <div>
                    <label for="aktif_tanggal" class="text-gray-800 text-sm font-medium inline-block mb-2">Aktif Tanggal</label>
                    <input type="date" class="form-input w-full bg-gray-300" name="aktif_tanggal" id="aktif_tanggal" value="{{ $vehicle->aktif_tanggal }}" required readonly>
                    <p id="remainingDays" class="text-gray-600 mt-2"></p>
                </div>
            </div>

            <!-- Tombol Oke -->
            <div class="flex justify-end mt-4">
                <button type="button" class="btn bg-primary text-white w-full" id="submitBtn" data-redirect-url="{{ url()->previous() }}">Oke</button>
            </div>
            
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const bulanDecInput = document.getElementById('tgl_dec');
        const masaPakaiInput = document.getElementById('masa_pakai');
        const aktifTanggalInput = document.getElementById('aktif_tanggal');
        const remainingDaysParagraph = document.getElementById('remainingDays');
        const vehicleForm = document.getElementById('vehicleForm');
        const submitBtn = document.getElementById('submitBtn');

        function calculateDuration(startDate) {
            const start = new Date(startDate);
            const now = new Date();

            let years = now.getFullYear() - start.getFullYear();
            let months = now.getMonth() - start.getMonth();

            if (months < 0) {
                years--;
                months += 12;
            }

            return { years, months };
        }

        function updateMasaPakai() {
            const bulanDec = bulanDecInput.value;

            if (bulanDec) {
                const [year, month] = bulanDec.split('-').map(Number);
                const startDate = new Date(year, month - 1, 1);

                const { years, months } = calculateDuration(startDate);

                masaPakaiInput.value = `${years} tahun ${months} bulan`;
            } else {
                masaPakaiInput.value = '';
            }
        }

        function updateRemainingDays() {
            const aktifTanggal = aktifTanggalInput.value;

            if (aktifTanggal) {
                const aktifDate = new Date(aktifTanggal);
                const today = new Date();

                const diffTime = aktifDate - today;
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                if (diffDays > 0) {
                    remainingDaysParagraph.innerText = `Masa aktif asuransi kamu masih berlaku selama ${diffDays} hari.`;
                    remainingDaysParagraph.classList.remove("text-red-500");
                } else {
                    remainingDaysParagraph.innerText = "Masa aktif asuransi kamu sudah habis.";
                    remainingDaysParagraph.classList.add("text-red-500");
                }
            } else {
                remainingDaysParagraph.innerText = '';
            }
        }

        function showConfirmation() {
            Swal.fire({
                title: 'Okedeh',
                icon: 'success',
                confirmButtonText: 'OKE',
                buttonsStyling: false,
                didOpen: () => {
                    Swal.getConfirmButton().classList.add('bg-green-500', 'text-white', 'px-4', 'py-2', 'rounded');
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const redirectUrl = submitBtn.getAttribute('data-redirect-url');
                    window.location.href = redirectUrl;
                }
            });
        }

        updateMasaPakai();
        updateRemainingDays();

        bulanDecInput.addEventListener('change', updateMasaPakai);
        aktifTanggalInput.addEventListener('change', updateRemainingDays);

        submitBtn.addEventListener('click', function(event) {
            event.preventDefault();
            showConfirmation();
        });
    });
</script>

@endsection

@section('script')
    @vite(['resources/js/pages/table-gridjs.js', 'resources/js/pages/extended-swiper.js', 'resources/js/pages/highlight.js'])
@endsection
