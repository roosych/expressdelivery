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
        $on_service = $drivers->where('service', true)->count();

        //return response()->json(['type' => 'FeatureCollection', 'features' => ['properties' => $drivers],]);

        return view('dashboard.index', compact('drivers', 'on_service', 'users', 'vehicle_types'));
    }
}
