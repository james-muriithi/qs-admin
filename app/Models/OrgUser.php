<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class OrgUser extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'org_users';

    protected $fillable = [
        'username',
        'bs_id',
        'name',
        'password',
        'verification_token',
        'email',
        'approved',
        'verified',
        'verified_at',
        'role_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'is_admin'
    ];
}
