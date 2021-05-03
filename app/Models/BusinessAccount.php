<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessAccount extends Model
{
    use HasFactory;

    public $table = 'Business_Accounts';

    protected $hidden = [
        'access_code',
    ];

    protected $dates = [
        'date_created',
    ];

    public $timestamps = false;

    protected $fillable = [
        'BS_ID',
        'BS_Name',
        'BS_Location',
        'BS_Contact',
        'BS_Email',
        'BS_Logo',
        'BS_Industry',
        'BS_Employees',
        'Access_Code',
    ];

    public function businessLocations()
    {
        return $this->hasMany(BusinessLocation::class, 'bs_id', 'BS_ID');
    }

    public function getDateCreatedAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
