<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrgRole extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'org_roles';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'bs_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

//    public function permissions()
//    {
//        return $this->belongsToMany(Permission::class, 'org_permission_org_role',
//            'role_id', 'permission_id');
//    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
