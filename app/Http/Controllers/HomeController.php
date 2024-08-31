<?php

namespace App\Http\Controllers;

use App\Models\Vehicle; // Pastikan model Vehicle di-import
use Carbon\Carbon; // Untuk manipulasi tanggal

class HomeController extends Controller
{
    public function index()
    {
        // Tentukan tanggal saat ini
        $currentDate = Carbon::now();
        
        // Tentukan tanggal 3 bulan yang lalu
        $threeMonthsAgo = $currentDate->copy()->subMonths(3);
        
        // Tentukan tanggal 3 bulan ke depan
        $threeMonthsAhead = $currentDate->copy()->addMonths(3);

        // Ambil data antara 3 bulan yang lalu sampai 3 bulan ke depan
        $vehicles = Vehicle::whereBetween('tanggal_next_service', [$threeMonthsAgo, $threeMonthsAhead])
                            ->get()
                            ->map(function ($vehicle) use ($currentDate) {
                                // Tentukan rentang waktu untuk alert (3 hari sebelum dan sesudah hari ini)
                                $startAlertDate = $currentDate->copy()->subDays(3);
                                $endAlertDate = $currentDate->copy()->addDays(3);
                                
                                // Cek apakah tanggal_next_service berada dalam rentang waktu alert
                                $serviceDate = Carbon::parse($vehicle->tanggal_next_service);
                                $vehicle->service_alert = $serviceDate->between($startAlertDate, $endAlertDate);
                                
                                return $vehicle;
                            });

        // Kirim data ke view
        return view('home', ['vehicles' => $vehicles]);
    }
}
