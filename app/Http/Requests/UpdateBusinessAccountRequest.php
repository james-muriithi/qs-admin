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
            'bsid' => [
                'string',
                'required',
                'unique:business_accounts,bsid,' . request()->route('business_account')->id,
            ],
            'bs_name' => [
                'string',
                'required',
            ],
            'bs_location' => [
                'string',
                'nullable',
            ],
            'bs_contact' => [
                'string',
                'required',
            ],
            'bs_email' => [
                'string',
                'nullable',
            ],
            'bs_logo' => [
                'string',
                'nullable',
            ],
            'bs_industry' => [
                'string',
                'nullable',
            ],
            'employees' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
