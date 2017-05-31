<?php

namespace App\Http\Controllers;

use App\Discount;
use App\Item;
use App\Price;
use DB;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    //public function listItem(){
    //    $items = Item::where('status', 1)->get();
    //    return view('item.list', ['items' => $items]);
   // }

    public function listItem($order = 'asc'){

        $items = DB::table('items')
            ->join('prices', 'items.id', '=', 'prices.item_id')
            ->leftJoin('promotions', function ($join) {
                $join->where('promotions.status', '=', 1)
                    ->where('promotions.date_from', '<=', date("Y-m-d"))
                    ->where('promotions.date_to', '>=', date("Y-m-d"));
            })
            ->leftJoin('discounts', function ($join){
                $join->on('items.id', '=', 'discounts.item_id')
                    ->where('promotions.status', '=', 1);
            })
            ->select(
                'items.id',
                'items.name',
                'items.text',
                'items.image',
                \DB::raw("MIN(prices.price) AS min_price"),
                \DB::raw("MAX(prices.price) AS max_price"),
                'discounts.discount'
                )
            ->where('items.status', '=', 1)
            ->groupBy('items.id', 'items.name', 'items.text', 'items.image','discounts.discount')
            ->orderBy('max_price', $order)
            ->get();
        return view('item.list', ['items' => $items]);
    }

    public function item($id){
        $item = Item::find($id);

        $discount = $this->discount($id);

        $arr_price = array();
        foreach(Price::where('item_id', $item->id)->get() as $price){
            $arr_price[$price->size->x][$price->size->y]['price'] = $price->price;
            if($discount){
                $arr_price[$price->size->x][$price->size->y]['price2'] = $price->price - (($price->price / 100) * $discount);
            }
        }

        return view('item.item', ['item' => $item, 'arr_price' => $arr_price, 'discount'=>$discount]);
    }

    public function discount($id){
        $discount = Item::find($id)->discount;
        if($discount) {
            $promotion = $discount->promotion;
            if ($promotion->status == 1 && strtotime($promotion->date_from) <= strtotime(date("Y-m-d")) && strtotime(date("Y-m-d")) <= strtotime($promotion->date_to)) {
                return $discount->discount;
            }
        }
        return false;
    }
}
