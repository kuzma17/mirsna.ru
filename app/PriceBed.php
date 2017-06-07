<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PriceBed extends Model
{
    protected $table = 'price_beds';

    protected $fillable = ['item_id', 'size_id', 'price'];

    public function size(){
        return $this->belongsTo(Size::class);
    }
}
