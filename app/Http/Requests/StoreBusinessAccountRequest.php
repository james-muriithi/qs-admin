<?php

namespace App\Http\Requests;

use App\Models\BusinessAccount;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBusinessAccountRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('business_account_create');
    }

    public function rules()
    {
        return [
            'BS_ID' => [
                'string',
                'required',
                'unique:Business_Accounts',
            ],
            'BS_Name' => [
                'string',
                'required',
            ],
            'BS_Location' => [
                'string',
                'required',
            ],
            'BS_Contact' => [
                'string',
                'required',
            ],
            'BS_Email' => [
                'required',
                'string',
            ],
            'BS_Logo' => [
                'string',
                'nullable',
            ],
            'BS_Industry' => [
                'string',
                'nullable',
            ],
            'Employees' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
