<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Estate;
class Landlord extends Model
{
    public function estates(){
        return $this->hasMany('App\Estate', '');
    }
}
