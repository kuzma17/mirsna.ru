<?php

namespace App\Http\Controllers;

use App\Item;
use App\Price;
use App\Size;
use DB;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function listItem(){
        $items = Item::where('status', 1)->get();
        return view('item.list', ['items' => $items]);
    }

    public function listItemSort($order){
        $items = Item::with(['price' => function($query)
        {
            $query->max('price');

        }])->get();

        //$items = DB::table('items')
       //     ->join('prices', 'items.id', '=', 'prices.item_id')
       //     ->select('items.*', 'prices.price')
        //    ->get();
        return view('item.list', ['items' => $items]);
    }

    public function item($id){
        $item = Item::find($id);

        $arr_price = array();
        foreach(Price::where('item_id', $item->id)->get() as $price){
            $arr_price[$price->size->x][$price->size->y] = $price->price;
        }

        return view('item.item', ['item' => $item, 'arr_price' => $arr_price]);
    }
}
