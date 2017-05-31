<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemHard extends Model
{
    protected $table = 'hard_item';

    protected $fillable = ['item_id', 'hard_id'];

    //public function hard(){
    //    return $this->belongsTo(Hard::class);
   // }
}
