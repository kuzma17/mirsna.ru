<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function listItem(){
        $items = Item::where('published', 1)->get();
        return view('item.list', ['items' => $items]);
    }

    public function item($id){
        $item = Item::find($id);
        return view('item.item', ['item' => $item]);
    }
}
