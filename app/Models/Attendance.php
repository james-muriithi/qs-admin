<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    public $table = 'attendances';

    protected $dates = [
        'date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'bsid_id',
        'employeeid_id',
        'date',
        'time_in',
        'time_out',
        'comment',
        'location',
        'area_info',
        'hours_in',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function bsid()
    {
        return $this->belongsTo(BusinessAccount::class, 'bsid_id');
    }

    public function employeeid()
    {
        return $this->belongsTo(Employee::class, 'employeeid_id');
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
