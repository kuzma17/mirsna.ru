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

        if($request->input('height_m')){
            $height_set = Height::find($request->input('height_m'));
            $height_min = $height_set->min;
            $height_max = $height_set->max;
            if($height_min == 0){
                $query_where .= ' AND items.height_m <= '.$height_max;
            }elseif ($height_max == 0){
                $query_where .= ' AND items.height_m >= '.$height_min;
            }else{
                $query_where .= ' AND items.height_m <= '.$height_max.' AND items.height_m >= '.$height_min;
            }
        }

        if($request->input('spring')){
            $query_where .= ' AND items.spring_id = '.$request->input('spring');
            $user_request['spring'] = Spring::find($request->input('spring'))->name;
        }

        if($request->input('hard')){
            $query_where .= ' AND hard_item.hard_id = '.$request->input('hard');
            $user_request['hard'] = Hard::find($request->input('hard'))->name;
        }

        if($request->input('weight_m')){
            $query_where .= ' AND items.weight_m >= '.$request->input('weight_m');
            $user_request['weight_m'] = $request->input('weight_m');
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
            ->join('springs', 'items.spring_id', '=', 'springs.id')
            ->leftJoin('promotions', function ($join) {
                $join->where('promotions.status', '=', 1)
                    ->where('promotions.date_from', '<=', date("Y-m-d"))
                    ->where('promotions.date_to', '>=', date("Y-m-d"));
            })
            ->leftJoin('discounts', function ($join){
                $join->on('items.id', '=', 'discounts.item_id')
                    ->where('promotions.status', '=', 1);
            });

        if($request->hard) {
            $items->join('hard_item', 'items.id', '=', 'hard_item.item_id')
                ->join('hards', 'hard_item.hard_id', '=', 'hards.id');
        }

        $items = $items->select(
            'items.id',
            'items.name',
            'prices.price',
            'discounts.discount',
            'brands.name AS brand',
            'sizes.x',
            'sizes.y',
            'height_m',
            'springs.name AS spring',
            'weight_m'
        )->whereRaw($query_where)
            ->orderBy('prices.price', $request->input('sort'))
            ->paginate(30);
            //->get();


        return view('item.select_item', ['user_request'=>$user_request, 'items' => $items]);
    }

    public static function hard($id){
        $str_hard = '';
        foreach(Item::find($id)->hard as $hard){
            $str_hard .= $hard->name.' ';
        }

        return $str_hard;
    }
}
