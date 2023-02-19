<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDriverRequest;
use App\Http\Requests\UpdateDriverRequest;
use App\Models\Driver;
use App\Models\Equipment;
use App\Models\Image;
use App\Models\Owner;
use App\Models\VehicleType;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use function Nette\Utils\isEmpty;
use function Symfony\Component\String\length;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::query()
            ->with(['vehicle_type', 'owner'])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('drivers.index', compact('drivers'));
    }

    public function add()
    {
        $vehicle_types = VehicleType::query()
            ->where('status', true)
            ->get();

        $equipment = Equipment::query()->get();
        $owners = Owner::query()->get();

        return view('drivers.add', compact('vehicle_types', 'equipment', 'owners'));
    }

    public function store(StoreDriverRequest $request)
    {
        $data = $request->validated();

        if (!$request->has('equipment'))
        {
            $data['equipment'] = [];
        }

        // из-за того что затрагиваются две модели (водитель и экипировка), страхуемся транзакциями
        DB::beginTransaction();

        try {
            $driver = Driver::query()->create($data);

            $driver->equipment()->sync($data['equipment']);

            DB::commit();
        }

        catch (\Exception $e) {

            DB::rollback();

            return redirect()->back()->with('error', 'Something went wrong!');

        }

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

        $equipment = Equipment::query()->get();
        $owners = Owner::query()->get();

        return view('drivers.edit', compact('driver', 'vehicle_types', 'equipment', 'owners'));
    }

    public function update(UpdateDriverRequest $request, Driver $driver)
    {
        $data = $request->validated();

        $driver->equipment()->sync($request['equipment']);

        //dd($data);

        Driver::query()->where('id', $driver->id)->update($data);



        return redirect()->back()->with('success', 'Successfully edited!');
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

            $equipments = ['Straps', 'Air ride', 'Ramps'];

            array_push($res, [
                "type" => "FeatureCollection",
                "features" => [
                    [
                        "type" => "Feature",
                        "properties" => [
                            "id" => (int)$item['id'],
                            "fullname" => (string)$item['fullname'],
                            "service" => (boolean)$item['service'],
                            "latitude" => (string)$item['latitude'],
                            "longitude" => (string)$item['longitude'],
                            "phone" => (string)$item['phone'],
                            "location" => (string)$item['location'],
                            "zipcode" => (string)$item['zipcode'],
                            "capacity" => (string)$item['capacity'],
                            "dimension" => (string)$item['dimension'],
                            "vehicle_type" => (string)$item['vehicle_type']['name'],
                            "note" => (string)$item['note'],
                            "equipments" => (array)$equipments,
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

        //dd($drivers);

        return $drivers;
    }

    public function images(Driver $driver)
    {
        return view('drivers.images', compact('driver'));
    }

    public function getDriverImages(Driver $driver)
    {
        $data = Image::query()->where('driver_id', $driver->id)->get();
        return response()->json(['status' => 'success', 'data' => $data]);
    }

}
