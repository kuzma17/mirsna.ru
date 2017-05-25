<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemHard extends Model
{
    protected $table = 'item_hard';

    protected $fillable = ['item_id', 'hard_id'];
}
