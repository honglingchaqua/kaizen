<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $vehicles = Service::all();
        return view('service.index', compact('service'));
    }
}
