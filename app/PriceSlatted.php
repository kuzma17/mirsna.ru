<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PriceSlatted extends Model
{
    protected $table = 'price_slatteds';

    protected $fillable = ['item_id', 'size_id', 'price'];

    public function size(){
        return $this->belongsTo(Size::class);
    }
}
