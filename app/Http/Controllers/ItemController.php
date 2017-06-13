<?php

namespace App\Http\Controllers;

use App\Discount;
use App\Item;
use App\Price;
use DB;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function listItemSeries($brand = '', $type = '', $series = '', $order = 'asc'){
        return $this->listItem($brand, $type, $series, $spring = '', $order);
    }

    public function listItemSpring($brand = '', $type = '', $spring = '', $order = 'asc'){
        return $this->listItem($brand, $type, $series = '', $spring, $order);
    }

    public function listItem($brand = '', $type = '', $series = '', $spring = '', $order = 'asc'){

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
            ->where('items.status', '=', 1);

        if($brand != ''){
            $items = $items->where('brand_id', $brand);
        }

        if($type != ''){
            $items = $items->where('type_item_id', $type);
        }

        if($series != ''){
            $items = $items->where('series_id', $series);
        }

        if($spring != ''){
            $items = $items->where('spring_id', $spring);
        }

        $items = $items
            ->groupBy('items.id', 'items.name', 'items.text', 'items.image','discounts.discount')
            ->orderBy('max_price', $order)
            ->get();
        return view('item.list', ['items' => $items]);
    }

    public function item($id){
        $item = Item::find($id);

        $discount = $this->discount($id);

        $arr_x = array();
        $arr_y = array();
        $arr_price = array();

        foreach(Price::where('item_id', $item->id)->get() as $price){

            if(!in_array($price->size->x, $arr_x)){
                $arr_x[] = $price->size->x;
            }

            if(!in_array($price->size->y, $arr_y)){
                $arr_y[] = $price->size->y;
            }

            $arr_price[$price->size->x][$price->size->y]['price'] = $price->price;
            if($discount){
                $arr_price[$price->size->x][$price->size->y]['price2'] = $price->price - (($price->price / 100) * $discount);
            }
        }

        return view('item.item', ['item' => $item, 'arr_x'=>$arr_x, 'arr_y'=>$arr_y, 'arr_price' => $arr_price, 'discount'=>$discount]);
    }

    public function item2($id){
        $item = Item::find($id);
        $discount = $this->discount($id);

        return view('item.item', ['item' => $item, 'discount'=>$discount]);
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
