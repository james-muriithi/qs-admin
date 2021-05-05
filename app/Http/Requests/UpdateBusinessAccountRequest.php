<?php

namespace App\Http\Requests;

use App\Models\BusinessAccount;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBusinessAccountRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('business_account_edit');
    }

    public function rules()
    {
        return [
            'BS_ID' => [
                'string',
                'required',
                'unique:Business_Accounts,BS_ID,' . request()->route('business_account')->id,
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
                'string',
                'nullable',
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
                'min:0',
            ],
        ];
    }
}
