<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Carbon\Carbon;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::all();
        return view('vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        return view('vehicles.create');
    }

    public function anyData()
    {
        $vehicles = Vehicle::all();  // Fetch data dari database
        return response()->json($vehicles);  // Kembalikan sebagai JSON
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nopol' => 'required|string|max:255',
            'no_rangka' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'warna' => 'required|string|max:255',
            'tgl_dec' => 'required|date',
            'tanggal_last_service' => 'required|date',
            'km_sekarang' => 'nullable|integer',
            'tanggal_next_service' => 'nullable|date',
            'note' => 'nullable|string|max:255',
            'remember_stnk' => 'nullable|string|max:255',
            'estimasi_aspirasi' => 'nullable|string|max:255',
            'last_check_tanggal' => 'nullable|date',
            'promo_trade_in' => 'nullable|string|max:255',
            'otr' => 'nullable|string|max:255',
            'dp' => 'nullable|string|max:255',
            'tenor1' => 'nullable|string|max:255',
            'tenor2' => 'nullable|string|max:255',
            'asuransi' => 'nullable|string|max:255',
            'aktif_tanggal' => 'nullable|date',
        ]);

        Vehicle::create($validated);

        return redirect()->route('vehicles.index')->with('success', 'Kendaraan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        return view('vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, $id)
    {
       
        $validated = $request->validate([
            'nopol' => 'required|string|max:255',
            'no_rangka' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'warna' => 'required|string|max:255',
            'tgl_dec' => 'required|date',
            'masa_pakai' => 'required|string|max:255',
            'tanggal_last_service' => 'required|date',
            'tanggal_next_service' => 'nullable|date',
            'note' => 'nullable|string|max:255',
            'asuransi' => 'nullable|string|max:255',
            'aktif_tanggal' => 'nullable|date',
        ]);

        $vehicle = Vehicle::findOrFail($id);
        $vehicle->update($validated);

        return redirect()->route('vehicles.index')->with('success', 'Kendaraan berhasil diupdate');
    }

    public function destroy($id)
    {
        Vehicle::findOrFail($id)->delete();
        return response()->json(['success' => 'Kendaraan berhasil dihapus']);
    }
}
