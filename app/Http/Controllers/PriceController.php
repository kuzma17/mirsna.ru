<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Hard;
use App\Height;
use App\Item;
use App\ItemHard;
use App\Size;
use App\Spring;
use App\Weight;
use DB;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function select(Request $request){

        $user_request = array();

        $price_from = trim($request->input('price_from'));
        $price_to = trim($request->input('price_to'));

        $query_where = 'items.status = 1';

        if($request->input('brand')){
            $query_where .= ' AND items.brand_id = '.$request->input('brand');
            $user_request['brand'] = Brand::find($request->input('brand'))->name;
        }

        if($request->input('size')){
            $query_where .= ' AND prices.size_id = '.$request->input('size');
            $size_el = Size::find($request->input('size'));
            $user_request['size'] = $size_el->x.' x '.$size_el->y;
        }

        if($request->input('height')){
            $query_where .= ' AND items.height_id = '.$request->input('height');
            $user_request['height'] = Height::find($request->input('height'))->name;
        }

        if($request->input('spring')){
            $query_where .= ' AND items.spring_id = '.$request->input('spring');
            $user_request['spring'] = Spring::find($request->input('spring'))->name;
        }

        if($request->input('hard')){
            $query_where .= ' AND item_hard.hard_id = '.$request->input('hard');
            $user_request['hard'] = Hard::find($request->input('hard'))->name;
        }

        if($request->input('weight')){
            $query_where .= ' AND items.weight_id = '.$request->input('weight');
            $user_request['weight'] = Weight::find($request->input('weight'))->name;
        }

        if($price_from){
            $query_where .= ' AND prices.price >= '.$price_from;
            $user_request['price_from'] = $price_from;
        }

        if($price_to){
            $query_where .= ' AND prices.price <= '.$price_to;
            $user_request['price_to'] = $price_to;
        }

        $items = DB::table('prices')
            ->join('items', 'prices.item_id', '=', 'items.id')
            ->join('brands', 'items.brand_id', '=', 'brands.id')
            ->join('sizes', 'prices.size_id', '=', 'sizes.id')
            ->join('heights', 'items.height_id', '=', 'heights.id')
            ->join('springs', 'items.spring_id', '=', 'springs.id')
            ->join('weights', 'items.weight_id', '=', 'weights.id');

        if($request->hard) {
            $items->join('item_hard', 'items.id', '=', 'item_hard.item_id')
                ->join('hards', 'item_hard.hard_id', '=', 'hards.id');
        }

        $items = $items->select(
            'items.id',
            'items.name',
            'prices.price',
            'brands.name AS brand',
            'sizes.x',
            'sizes.y',
            'heights.name AS height',
            'springs.name AS spring',
            'weights.name AS weight'
        )->whereRaw($query_where)
            //->where('items.brand_id', '=', 1)
            //->groupBy('items.id', 'items.name', 'items.text', 'items.image')
            ->orderBy('prices.price', $request->input('sort'))
            //->paginate(25);
            ->get();


        return view('item.select_item', ['user_request'=>$user_request, 'items' => $items]);
    }

    public static function hard($id){
        $str_hard = '';
        foreach(ItemHard::where('item_id', $id)->get() as $hard){
            $str_hard .= $hard->hard->name.' ';
        }

        return $str_hard;
    }
}
