<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MpesaResponse extends Model
{
    public function checkout_request(){
        return $this->belongsTo('App\CheckoutRequest', 'checkoutId');
    }
}
