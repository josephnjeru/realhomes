<?php

namespace App;

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
        'name', 'email', 'password', 'role', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function checkouts(){
        return $this->hasMany('App\CheckoutRequest', 'user');
    }

    public function isAdmin(){
        if($this->role = 'admin'){
            return true;
        }else{
            return false;
        }   
    }

    public function isLandlord(){
        if($this->role = 'landlord'){
            return true;
        }else{
            return false;
        }   
    }

    public function isCustomer(){
        if($this->role = 'customer'){
            return true;
        }else{
            return false;
        }   
    }
}
