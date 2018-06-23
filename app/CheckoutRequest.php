<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckoutRequest extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function mpesa_response(){
        return $this->hasOne('App\MpesaResponse', 'checkout_fk');
    }
}
