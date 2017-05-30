<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = ['promotion_id', 'item_id', 'discount'];

    public function promotion(){
        return $this->belongsTo(Promotion::class);
    }

}
