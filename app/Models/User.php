<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Http\Traits\PermissionTrait;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, PermissionTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Get the companyRelation that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function companyRelation()
    {
        return $this->hasOne(Companies::class, 'user_id');
    }
}
