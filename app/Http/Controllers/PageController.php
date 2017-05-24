<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function page($url)
    {
        $page = Page::where('url', $url)->first();
        return view('page', ['page' => $page]);
    }
}
