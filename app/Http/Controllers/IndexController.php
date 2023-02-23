<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\User;
use App\Models\VehicleType;

class IndexController extends Controller
{
    public function index()
    {



        $users = User::all()->count();
        $vehicle_types = VehicleType::all()->count();
        $drivers = Driver::all();
        //dd($drivers);
        $available_now = $drivers->where('service', true)->count();

        //return response()->json(['type' => 'FeatureCollection', 'features' => ['properties' => $drivers],]);

        return view('dashboard.index', compact('drivers', 'available_now', 'users', 'vehicle_types'));
    }
}
