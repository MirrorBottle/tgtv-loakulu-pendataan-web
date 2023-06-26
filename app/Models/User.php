<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, HasRoles;
    use \Staudenmeir\EloquentJsonRelations\HasJsonRelationships;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'phone_number',
        'profile_image',
        'device_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    // MUTATORS
    public function setPasswordAttribute($value) {
        $this->attributes['password'] = Hash::make($value);
    }

    public function getProfileImageFormatAttribute() {
        return $this->profile_image ?? '/images/avatar.jpg';
    }

    public function getIsRoleAdminAttribute() {
        return $this->roles->first()->id === 1;
    }
    public function getIsRoleUserAttribute() {
        return $this->roles->first()->id === 2;
    }
    

    // RELATIONSHIP
    public function notifications() {
        return $this->hasMany(Notification::class, 'user_id', 'id');
    }

    public function neighborhoods() {
        return $this->hasManyThrough(Neighborhood::class, UserNeighborhood::class, 'user_id', 'id', 'id', 'neighborhood_id');
    }

}
