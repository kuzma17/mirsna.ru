<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function type_item(){
        return $this->belongsTo(TypeItem::class);
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function series(){
        return $this->belongsTo(Series::class);
    }

    public function spring(){
        return $this->belongsTo(Spring::class);
    }

    public function height(){
        return $this->belongsTo(Height::class);
    }

    public function weight(){
        return $this->belongsTo(Weight::class);
    }

    public function price(){
        return $this->hasMany(Price::class);
    }

    public function hard(){
        return $this->hasMany(ItemHard::class);
    }

}
