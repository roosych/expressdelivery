<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEquipmentRequest;
use App\Http\Requests\UpdateEquipmentRequest;
use App\Models\Equipment;

class EquipmentController extends Controller
{
    public function index()
    {
        $equipments = Equipment::query()->get();

        return view('equipments.index', compact('equipments'));
    }

    public function add()
    {
        return view('equipments.add');
    }

    public function edit(Equipment $equipment)
    {
        return view('equipments.edit', compact('equipment'));
    }

    public function store(StoreEquipmentRequest $request)
    {
        $data = $request->validated();

        Equipment::query()->create($data);

        return redirect()->route('equipment.index')->with('success', 'Successfully added!');
    }

    public function update(UpdateEquipmentRequest $request, Equipment $equipment)
    {
        $data = $request->validated();

        Equipment::query()->where('id', $equipment->id)->update($data);

        return redirect()->back()->with('success', 'Successfully edited!');
    }
}
