<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fb_id',
        'vk_id',
        'avatar',
        'name',
        'email',
        'phone',
        'password',
        'confirm_token',
        'type',
        'active',
        'send_mail'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function smsLogin()
    {
        return $this->hasMany('App\Models\SmsLogin')->orderBy('id','desc');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }
}
