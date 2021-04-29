<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessAccount extends Model
{
    use HasFactory;

    public $table = 'business_accounts';

    protected $hidden = [
        'access_code',
    ];

    protected $dates = [
        'date_created',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'bsid',
        'bs_name',
        'bs_location',
        'bs_contact',
        'bs_email',
        'bs_logo',
        'bs_industry',
        'employees',
        'access_code',
        'date_created',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function bsidBusinessLocations()
    {
        return $this->hasMany(BusinessLocation::class, 'bsid_id', 'id');
    }

    public function getDateCreatedAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setDateCreatedAttribute($value)
    {
        $this->attributes['date_created'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
