<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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

    protected $appends = [
        'departments'
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
        'Employees',
        'Access_Code',
    ];

    public function businessLocations()
    {
        return $this->hasMany(BusinessLocation::class, 'bs_id', 'BS_ID');
    }

    public function businessAttendance()
    {
        return $this->hasMany(Attendance::class, 'BS_ID', 'BS_ID');
    }

    public function employees()
    {
        return $this->hasMany(Employee::class, 'BS_ID', 'BS_ID');
    }

    public function users()
    {
        return $this->hasMany(OrgUser::class, 'bs_id', 'BS_ID');
    }

    public function getDateCreatedAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function getLogoFullPathAttribute()
    {
        $folder  = env('APP_ENV') == 'local' ? Storage::disk('public')->path('uploads').'/' :
            '/home/u675959526/domains/quickscan.brancetech.com/assets/img/logos/';

        if ($this->BS_Logo){
            return $folder.$this->BS_Logo;
        }
        return null;
    }

    public function getLogoUrlAttribute()
    {
        return env('APP_ENV') == 'local' ? asset('storage/uploads/'.$this->BS_Logo)
            : 'https://quickscan.brancetech.com/assets/img/logos/'.$this->BS_Logo;
    }

    public function getTotalHoursSpentAttribute()
    {
        if ($this->businessAttendance->count() > 0){
            return (int) $this->businessAttendance()->sum(DB::raw('TIME_TO_SEC(TIMEDIFF(time_out, time_in))/3600'));
        }
        return 0;
    }

    public function getDepartmentsAttribute()
    {
        return $this->employees()->select(['department', DB::raw('count(department) as total')])
            ->groupBy('department')->get();
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
