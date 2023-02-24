<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDriverRequest;
use App\Http\Requests\UpdateDriverRequest;
use App\Models\Driver;
use App\Models\Equipment;
use App\Models\Image;
use App\Models\Owner;
use App\Models\VehicleType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::query()
            ->with(['vehicle_type', 'owner'])
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($drivers as $driver)
        {
            echo $driver->future_datetime;
            if ($driver->service == false && $driver->future_datetime != null && $driver->future_datetime < now()) {

                $driver->update([
                    'service' => true,

                    //перегоняем фьючеры в карренты
                    'zipcode' => $driver->future_zipcode,
                    'location' => $driver->future_location,
                    'latitude' => $driver->future_latitude,
                    'longitude' => $driver->future_longitude,

                    //очищаем фьючеры
                    'future_zipcode' => null,
                    'future_location' => null,
                    'future_latitude' => null,
                    'future_longitude' => null,
                    'future_datetime' => null,
                ]);

            }
        }


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
        if($request->service == 1) {
            $data = [
                'service' => $request->service,

                //future data = null when available is on
                'future_zipcode' => null,
                'future_location' => null,
                'future_latitude' => null,
                'future_longitude' => null,
                'future_datetime' => null,
            ];
        } else {
            $data = [
                'service' => $request->service,
            ];
        }


        Driver::query()
            ->where('id', $request->id)
            ->update($data);

        return response(['msg' => 'success', 'service' => $request->service], 200);

    }

    public function availability(Request $request, Driver $driver)
    {

        $data = [
            'service' => $driver->service = false,
            'future_zipcode' => (int)$request->future_zipcode,
            'future_location' => (string)$request->future_location,
            'future_latitude' => (string)$request->future_latitude,
            'future_longitude' => (string)$request->future_longitude,
            'future_datetime' => (string)$request->future_datetime,
            'note' => (string)$request->note,
        ];

        try {
            $driver->update($data);

            return response(['msg' => 'success', 'data' => $data], 200);
        } catch (\Exception $e)
        {
            return response(['msg' => $e], 400);
        }


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
        $data = Driver::with(['vehicle_type', 'equipment'])
            ->where('status', true)
            ->get()
            ->toArray();

        //dd($data);

        $res = array();

        foreach ($data as $item)
        {
            //dd($item['equipment']);

            $equipments = [];

            foreach ($item['equipment'] as $equ)
            {
                array_push($equipments, $equ['name']);
            }

            //dd($equipments);

            array_push($res, [
                "type" => "FeatureCollection",
                "features" => [
                    [
                        "type" => "Feature",
                        "properties" => [
                            "id" => (int)$item['id'],
                            "fullname" => (string)$item['fullname'],
                            "service" => (boolean)$item['service'],
                            "citizenship" => (string)$item['citizenship'],
                            "dnu" => (boolean)$item['dnu'],
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

                            "future_location" => (string)$item['future_location'],
                            "future_zipcode" => (string)$item['future_zipcode'],
                            "future_latitude" => (string)$item['future_latitude'],
                            "future_longitude" => (string)$item['future_longitude'],
                            "future_datetime" => (string)$item['future_datetime'],
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
