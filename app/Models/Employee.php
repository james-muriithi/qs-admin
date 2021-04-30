<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory;

    public const GENDER_SELECT = [
        'Male'   => 'Male',
        'Female' => 'Female',
    ];

    public $hidden = [
        'password'
    ];

    public $table = 'employees';

    protected $dates = [
        'timestamp',
    ];
    public $timestamps = false;

    protected $fillable = [
        'emp_id',
        'BS_ID',
        'name',
        'department',
        'designation',
        'potraits',
        'contact',
        'email',
        'password',
        'timestamp',
        'gender',
        'GenId'
    ];

    public function organisation()
    {
        return $this->belongsTo(BusinessAccount::class, 'BS_ID', 'BS_ID');
    }

    public function getTimestampAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setTimestampAttribute($value)
    {
        $this->attributes['timestamp'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getPotraitsAttribute($value)
    {
        return $value ? explode('...', $value) : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
