<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOwnerRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|min:2|max:50',
            'phone' => 'required|string|min:10|max:20|unique:owners,phone,' .$this->owner->id,
            'status' => 'boolean'
        ];
    }
}
