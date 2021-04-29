<?php

namespace App\Http\Requests;

use App\Models\Attendance;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAttendanceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('attendance_create');
    }

    public function rules()
    {
        return [
            'date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'time_in' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
            'time_out' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
            'location' => [
                'string',
                'nullable',
            ],
            'area_info' => [
                'string',
                'nullable',
            ],
            'hours_in' => [
                'string',
                'nullable',
            ],
            'status' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
