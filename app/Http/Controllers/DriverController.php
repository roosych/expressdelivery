<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDriverRequest;
use App\Http\Requests\UpdateDriverRequest;
use App\Models\Driver;
use App\Models\VehicleType;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use function Symfony\Component\String\length;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::query()->get();
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

        //dd($data);

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

    public function map()
    {
        $data = $this->getAllDrivers();

        return view('drivers.map', compact('data'));
    }

    public function getAllDrivers()
    {
        $data = Driver::with('vehicle_type')
            ->where('status', true)
            ->get()
            ->toArray();

        //dd($data);

        $res = array();

        foreach ($data as $item)
        {
            //dd($item);
            array_push($res, [
                "type" => "FeatureCollection",
                "features" => [
                    [
                        "type" => "Feature",
                        "properties" => [
                            "id" => $item['id'],
                            "fullname" => $item['fullname'],
                            "service" => (boolean)$item['service'],
                            "latitude" => $item['latitude'],
                            "longitude" => $item['longitude'],
                            "phone" => $item['phone'],
                            "location" => $item['location'],
                            "zipcode" => $item['zipcode'],
                            "capacity" => $item['capacity'],
                            "dimension" => $item['dimension'],
                            "vehicle_type" => $item['vehicle_type']['name'],
                            "note" => $item['note'],
                        ],
                        "geometry" => [
                            "type" => "Point",
                            "coordinates" => [$item['longitude'], $item['latitude']],
                        ],
                    ],
                ],
            ]);

        }

        $drivers = json_encode($res);

        return $drivers;
    }

}
