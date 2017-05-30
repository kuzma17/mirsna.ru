<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    public function discount(){
        return $this->hasMany(Discount::class);
    }
}
