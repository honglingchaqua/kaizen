@extends('layouts.vertical', ['title' => 'Tambah Kendaraan', 'sub_title' => 'Tambah Kendaraan Baru'])

@section('css')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endsection

@section('content')
    <div class="card">
        <div class="card-header text-center">
            <h4 class="card-title">Tambah Kendaraan</h4>
        </div>
        <div class="p-6">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form id="vehicleForm" method="POST" action="{{ route('vehicles.store') }}">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Input fields -->
                    <div class="flex flex-col">
                        <label for="nopol" class="text-gray-800 text-sm font-medium mb-1">Nopol</label>
                        <input type="text" class="form-input" name="nopol" id="nopol" value="{{ old('nopol') }}" required>
                    </div>
                    <div class="flex flex-col">
                        <label for="no_rangka" class="text-gray-800 text-sm font-medium mb-1">No Rangka</label>
                        <input type="text" class="form-input" name="no_rangka" id="no_rangka" value="{{ old('no_rangka') }}" required>
                    </div>
                    <div class="flex flex-col">
                        <label for="model" class="text-gray-800 text-sm font-medium mb-1">Model</label>
                        <select class="form-select" name="model" id="model" required>
                            <option value="" disabled {{ old('model') ? '' : 'selected' }}>Silahkan Pilih Model Mobil Anda</option>
                            <option value="Avanza" {{ old('model') == 'Avanza' ? 'selected' : '' }}>Avanza</option>
                            <option value="Fortuner" {{ old('model') == 'Fortuner' ? 'selected' : '' }}>Fortuner</option>
                            <option value="Hilux" {{ old('model') == 'Hilux' ? 'selected' : '' }}>Hilux</option>
                            <option value="Innova" {{ old('model') == 'Innova' ? 'selected' : '' }}>Innova</option>
                            <option value="Raize" {{ old('model') == 'Raize' ? 'selected' : '' }}>Raize</option>
                            <option value="Agya" {{ old('model') == 'Agya' ? 'selected' : '' }}>Agya</option>
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <label for="warna" class="text-gray-800 text-sm font-medium mb-1">Warna</label>
                        <select class="form-select" name="warna" id="warna" required>
                            <option value="" disabled {{ old('warna') ? '' : 'selected' }}>Silahkan Pilih Warna Mobil Anda</option>
                            <option value="Hitam" {{ old('warna') == 'Hitam' ? 'selected' : '' }}>Hitam</option>
                            <option value="Putih" {{ old('warna') == 'Putih' ? 'selected' : '' }}>Putih</option>
                            <option value="Merah" {{ old('warna') == 'Merah' ? 'selected' : '' }}>Merah</option>
                            <option value="Biru" {{ old('warna') == 'Biru' ? 'selected' : '' }}>Biru</option>
                            <option value="Hijau" {{ old('warna') == 'Hijau' ? 'selected' : '' }}>Hijau</option>
                            <option value="Abu-abu" {{ old('warna') == 'Abu-abu' ? 'selected' : '' }}>Abu-abu</option>
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <label for="bulan_dec" class="text-gray-800 text-sm font-medium mb-1">Bulan DEC</label>
                        <input type="month" class="form-input" name="bulan_dec" id="bulan_dec" value="{{ old('bulan_dec') }}" required>
                    </div>
                    <div class="flex flex-col mt-4">
                        <label for="bulan_tahun_awal" class="text-gray-800 text-sm font-medium mb-1">Bulan dan Tahun Awal</label>
                        <input type="month" class="form-input" name="bulan_tahun_awal" id="bulan_tahun_awal" value="{{ old('bulan_tahun_awal') }}" required>
                    </div>
                    <div class="flex flex-col">
                        <label for="masa_pakai" class="text-gray-800 text-sm font-medium mb-1">Masa Pakai (bulan)</label>
                        <input type="number" class="form-input" name="masa_pakai" id="masa_pakai" value="{{ old('masa_pakai') }}" readonly>
                    </div>
                    <div class="flex flex-col">
                        <label for="tanggal_last_service" class="text-gray-800 text-sm font-medium mb-1">Tanggal Last Service</label>
                        <input type="date" class="form-input" name="tanggal_last_service" id="tanggal_last_service" value="{{ old('tanggal_last_service') }}" required>
                    </div>
                    <div class="flex flex-col">
                        <label for="km_sekarang" class="text-gray-800 text-sm font-medium mb-1">KM Sekarang</label>
                        <input type="text" class="form-input" name="km_sekarang" id="km_sekarang" value="{{ old('km_sekarang') }}">
                    </div>
                    <div class="flex flex-col">
                        <label for="tanggal_next_service" class="text-gray-800 text-sm font-medium mb-1">Tanggal Next Service</label>
                        <input type="date" class="form-input" name="tanggal_next_service" id="tanggal_next_service" value="{{ old('tanggal_next_service') }}">
                    </div>
                    <div class="flex flex-col">
                        <label for="note" class="text-gray-800 text-sm font-medium mb-1">Note</label>
                        <input type="text" class="form-input" name="note" id="note" value="{{ old('note') }}">
                    </div>
                </div>
                <div class="flex justify-end mt-4">
                    <button type="submit" class="btn bg-primary text-white">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const kmInput = document.getElementById('km_sekarang');
            const vehicleForm = document.getElementById('vehicleForm');
            const bulanTahunAwalInput = document.getElementById('bulan_tahun_awal');
            const masaPakaiInput = document.getElementById('masa_pakai');

            // Format input KM
            kmInput.addEventListener('input', function(e) {
                let formattedNumber = e.target.value.replace(/,/g, '')
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                e.target.value = formattedNumber;
            });

            // Hitung masa pakai otomatis
            bulanTahunAwalInput.addEventListener('change', function() {
                const selectedDate = new Date(bulanTahunAwalInput.value);
                const currentDate = new Date();

                if (selectedDate > currentDate) {
                    alert('Tanggal yang dipilih tidak boleh lebih dari tanggal saat ini.');
                    masaPakaiInput.value = '';
                    return;
                }

                const diffInMonths = (currentDate.getFullYear() - selectedDate.getFullYear()) * 12 + (currentDate.getMonth() - selectedDate.getMonth());
                masaPakaiInput.value = diffInMonths >= 0 ? diffInMonths : 0;
            });

            vehicleForm.addEventListener('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission
                kmInput.value = kmInput.value.replace(/,/g, ''); // Remove commas before submission

                Swal.fire({
                    title: 'Data berhasil disimpan',
                    icon: 'success',
                    confirmButtonText: 'OKE',
                    buttonsStyling: false,
                    didOpen: () => {
                        const confirmButton = Swal.getConfirmButton();
                        confirmButton.classList.add('bg-green-500', 'text-white', 'px-4', 'py-2', 'rounded');
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        vehicleForm.submit(); // Submit the form if confirmed
                    }
                });
            });
        });
    </script>
@endsection
