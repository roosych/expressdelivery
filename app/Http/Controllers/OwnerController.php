<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOwnerRequest;
use App\Http\Requests\UpdateOwnerRequest;
use App\Models\Owner;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function index()
    {
        $owners = Owner::query()->get();
        return view('owners.index', compact('owners'));
    }

    public function add()
    {
        return view('owners.add');
    }

    public function edit(Owner $owner)
    {
        return view('owners.edit', compact('owner'));
    }

    public function store(StoreOwnerRequest $request)
    {
        $data = $request->validated();

        Owner::query()->create($data);

        return redirect()->route('owner.index')->with('success', 'Successfully added!');

    }

    public function update(UpdateOwnerRequest $request, Owner $owner)
    {
        $data = $request->validated();

        Owner::query()->where('id', $owner->id)->update($data);

        return redirect()->back()->with('success', 'Successfully edited!');
    }
}
