<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use App\Models\VehicleType;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicle_types = VehicleType::query()->paginate(10);
        return view('vehicles.index', compact('vehicle_types'));
    }

    public function add()
    {
        return view('vehicles.add');
    }

    public function store(StoreVehicleRequest $request)
    {
        $data = $request->validated();

        //dd($data);

        VehicleType::query()->create($data);

        return redirect()->route('vehicles.index')->with('success', 'Successfully added!');

    }

    public function status(Request $request)
    {
        $data = [
            'status' => $request->status,
        ];

        VehicleType::query()
            ->where('id', $request->id)
            ->update($data);

        return response('success', 200);
    }

    public function edit(VehicleType $type)
    {
        return view('vehicles.edit', compact('type'));
    }

    public function update(UpdateVehicleRequest $request, VehicleType $type)
    {
        $data = $request->validated();

        VehicleType::query()->where('id', $type->id)->update($data);

        return redirect()->route('vehicles.index')->with('success', 'Successfully edited!');
    }
}
