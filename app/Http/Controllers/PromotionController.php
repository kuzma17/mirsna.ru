<?php

namespace App\Http\Controllers;

use App\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function promotions(){
        $promotions = Promotion::where('status', 1)
            ->where('date_from', '<=', date("Y-m-d"))
            ->where('date_to', '>=', date("Y-m-d"))
            ->get();
        return view('promotion', ['promotions'=>$promotions]);
    }
}
