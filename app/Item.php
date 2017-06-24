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

    public function class_item(){
        return $this->belongsTo(ClassItem::class);
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

    public function price_pillow(){
        return $this->hasOne(PricePillow::class);
    }

  //  public function price_mattress_cover(){
  //      return $this->hasMany(PriceMattressCover::class);
 //   }

  //  public function price_slatted(){
  //      return $this->hasMany(PriceSlatted::class);
 //   }

   // public function price_bed(){
  //      return $this->hasMany(PriceBed::class);
  //  }

    public function custom_price(){
        return $this->hasOne(CustomPrice::class);
    }

    public function hard(){
        return $this->belongsToMany(Hard::class);
    }

    public function discount(){
        return $this->hasOne(Discount::class);
    }

    //public function set_mattress(){
    //    return $this->hasOne(SetMattress::class);
   // }

}
