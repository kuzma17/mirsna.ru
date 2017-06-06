<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PriceMattressCover extends Model
{
    protected $table = 'price_mattress_covers';
    protected $fillable = ['item_id', 'size_id', 'price'];

    public function size(){
        return $this->belongsTo(Size::class);
    }
}
