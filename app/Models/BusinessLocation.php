<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class BusinessLocation extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'business_locations';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'bs_id',
        'coordinates',
        'qr',
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    public function business()
    {
        return $this->belongsTo(BusinessAccount::class, 'bs_id', 'BS_ID');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
