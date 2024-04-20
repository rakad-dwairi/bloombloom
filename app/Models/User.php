<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function frames()
    {
        return $this->hasMany(Frame::class);
    }

    public function lenses()
    {
        return $this->hasMany(Lens::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function getRoleIDs() {
        $roleIDs = DB::table('roles')->where('user_id',$this->id)->pluck('ref_id');
        return $roleIDs;
    }
    
    public function getUserPrivilege() {
        $privilege = DB::table('roles')->where('user_id', $this->id)->value('privilege');
        return collect([$privilege]);
    }    

    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    } 
}
