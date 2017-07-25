<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $fillable = ['item_id', 'size_id', 'price'];

    public function size(){
        return $this->belongsTo(Size::class);
    }

    public function size_pillow(){
        return $this->hasOne(SizePillow::class);
    }

}
