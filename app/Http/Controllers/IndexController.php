<?php

namespace App\Http\Controllers;

use App\Models\Driver;

class IndexController extends Controller
{
    public function index()
    {

        $drivers = Driver::all();
        $on_service = $drivers->where('service', true)->count();

        return view('dashboard.index', compact('drivers', 'on_service'));
    }
}
