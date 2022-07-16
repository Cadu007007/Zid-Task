<?php

namespace App\Models;

use PhpParser\Node\Attribute;
use App\Models\MerchantSetting;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    const MERCHANT = 'merchant';
    const CONSUMER = 'consumer';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
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
    ];

    public function setPasswordAttribute($value):mixed
    {
        $this->attributes['password']= bcrypt($value);
    }

    public function generateToken($app = null):string
    {
        return $this->createToken($app ?? config('app.name'))->plainTextToken;
    }

    public function merchantSetting() : HasOne
    {
        return $this->hasOne(MerchantSetting::class,'merchant_id','id');
    }
}
