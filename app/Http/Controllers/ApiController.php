<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ApiController extends Controller
{
    public function getData()
    {
        // URL API
        $apiUrl = 'http://202.77.105.101:1003/centralapi/index.php/agass/HistoryService/hcibynopol?norangka=MHKA4GB5JJJ018105';

        // Membuat instance Guzzle Client
        $client = new Client();

        try {
            // Mengirimkan request GET ke API
            $response = $client->request('GET', $apiUrl);

            // Mendapatkan isi response
            $data = json_decode($response->getBody(), true);

            // Mengirim data ke view
            return view('data.index', ['data' => $data]);
        } catch (\Exception $e) {
            // Handle error jika request gagal
            return response()->json(['error' => 'Terjadi kesalahan saat mengakses API'], 500);
        }
    }
}
