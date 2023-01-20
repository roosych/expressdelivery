<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDriverRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'fullname' => 'required|string|min:2|max:100',
            'phone' => 'required|string|min:10|max:20|unique:drivers,phone,' .$this->driver->id,
            'vehicle_type_id' => 'required|integer|exists:vehicle_types,id',
            'capacity' => 'nullable|string|min:2|max:100',
            'dimension' => 'nullable|string|min:2|max:100',
            'zipcode' => 'nullable|integer',
            'location' => 'nullable|string|max:150',
            'latitude' => 'nullable|between:-90,90',
            'longitude' => 'nullable|between:-180,180',
            'note' => 'nullable|string|max:500'
        ];
    }
}
