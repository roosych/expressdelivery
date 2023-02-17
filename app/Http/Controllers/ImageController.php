<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function store(Request $request, Driver $driver)
    {
        $request->validate([
            'images' => ['required', 'array', 'min:1'],
            'images.*' => ['required', 'image', 'mimes:jpeg,jpg,png', 'max:2048']
        ]);



        $files = $request->file('images');

        if($request->hasFile('images'))
        {
            foreach ($files as $file) {

                $imageName = time().'.'.$file->extension();

                //dd($imageName);

                Storage::disk('public')->put('images/cars/' .$driver->id, $file);

                $data = [
                    'driver_id' => $driver->id,
                    'filename' => $imageName
                ];

                Image::query()->create($data);
            }

            return redirect()->back()->with('success', 'Successfully added!');
        }

        return false;
    }
}
