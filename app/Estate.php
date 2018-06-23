<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Landlord;

class Estate extends Model
{
    public function landlord(){
        return belongsTo('Landlord', 'landlord');
    }
}
