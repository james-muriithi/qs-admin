<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    public $table = 'attendance';

    protected $dates = [
        'date',
    ];

    protected $fillable = [
        'BS_ID',
        'employee_id',
        'date',
        'time_in',
        'time_out',
        'comment',
        'location',
        'area_info',
        'hours_in',
        'status',
    ];

    public function bsid()
    {
        return $this->belongsTo(BusinessAccount::class, 'BS_ID', 'BS_ID');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'emp_id');
    }

    public function getDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
