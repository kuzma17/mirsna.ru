<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PricePillow extends Model
{
    protected $table = 'prices';
    //protected $fillable = ['item_id', 'size_id', 'price'];

    public function size_pillow(){
        return $this->belongsTo(SizePillow::class);
    }
}
