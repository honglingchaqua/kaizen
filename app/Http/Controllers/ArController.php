<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArController extends Controller
{
    public function index()
    {
        // Data yang akan dikirim ke view (opsional)
        $data = [
            'title' => 'Welcome to AR Page',
            'description' => 'This is a sample description for the AR page.',
        ];

        // Menampilkan view ar.blade.php dengan data
        return view('ar', $data);
    }
}
