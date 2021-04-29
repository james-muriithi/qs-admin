<?php

namespace App\Http\Requests;

use App\Models\BusinessLocation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBusinessLocationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('business_location_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'coordinates' => [
                'string',
                'nullable',
            ],
            'qr' => [
                'required',
            ],
        ];
    }
}
