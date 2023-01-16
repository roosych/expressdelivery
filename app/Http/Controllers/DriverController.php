<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDriverRequest;
use App\Http\Requests\UpdateDriverRequest;
use App\Models\Driver;
use App\Models\VehicleType;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::query()->paginate(50);
        return view('drivers.index', compact('drivers'));
    }

    public function add()
    {
        $vehicle_types = VehicleType::query()
            ->where('status', true)
            ->get();

        return view('drivers.add', compact('vehicle_types'));
    }

    public function store(StoreDriverRequest $request)
    {
        $data = $request->validated();

        Driver::query()->create($data);

        return redirect()->route('drivers.index')->with('success', 'Successfully added!');
    }

    public function status(Request $request)
    {
        $data = [
            'service' => $request->service,
        ];

        Driver::query()
            ->where('id', $request->id)
            ->update($data);

        return response('success', 200);
    }

    public function edit(Driver $driver)
    {
        $vehicle_types = VehicleType::query()
            ->where('status', true)
            ->get();

        return view('drivers.edit', compact('driver', 'vehicle_types'));
    }

    public function update(UpdateDriverRequest $request, Driver $driver)
    {
        $data = $request->validated();

        Driver::query()->where('id', $driver->id)->update($data);

        return redirect()->route('drivers.index')->with('success', 'Successfully edited!');
    }
}
