<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDriverRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'fullname' => 'required|string|min:2|max:100',
            'phone' => 'required|string|min:10|max:20|unique:drivers,phone,' .$this->driver->id,
            'vehicle_type_id' => 'required|integer|exists:vehicle_types,id',
            'owner_id' => 'nullable|integer|exists:owners,id',
            'capacity' => 'nullable|string|min:2|max:100',
            'citizenship' => 'required|string|min:2|max:100',
            'dimension' => 'nullable|string|min:2|max:100',
            'zipcode' => 'nullable|integer',
            'location' => 'nullable|string|max:150',
            'latitude' => 'nullable|between:-90,90',
            'longitude' => 'nullable|between:-180,180',

            'future_zipcode' => 'nullable|integer',
            'future_location' => 'nullable|string|max:150',
            'future_latitude' => 'nullable|between:-90,90',
            'future_longitude' => 'nullable|between:-180,180',

            'future_datetime' => 'nullable|date',

            'note' => 'nullable|string|max:500',

//            'equipment' => 'array',
//            'equipment.*' => 'required|integer',

            'service' => 'boolean',
            'status' => 'boolean',
            'dnu' => 'boolean',
        ];
    }
}
