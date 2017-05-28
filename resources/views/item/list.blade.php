<?php
/**
 * Created by PhpStorm.
 * User: kuzma
 * Date: 27.05.17
 * Time: 18:03
 */
?>
@extends('layouts.app')

@section('content')
<div class="sort">
сортировать по цене: <a href="/item/list/sort/desc"> вниз</a> <A href="/item/list/sort/asc">вверх</A>
</div>





    <div id="clear"></div>

@foreach ($items as $item)

    <div class="list_item" urlpage="index.php" >
        <h3>{{ $item->name }}</h3>
        <div style="width:145px;float:left;margin-right:10px">
            @if($item->image)
                <img src="{{ url('/upload/'.$item->image.'_100x50.jpg') }}">
            @endif
        </div>
        {!! \Illuminate\Support\Str::words($item->text, 50) !!}
        <div class="sale_box">
            <div style="float:left;margin:5px;margin-left:10px;">
               цена {{ $item->price->min('price') }} - {{ $item->price->max('price') }} грн.
            </div>
            <div style="float:left;height:26px;width:14px;background:url(/images/sale3.png) no-repeat;"></div>
        </div>
        <a href="index.php">подробнее >></a>
    </div>
    <div id="clear"></div>

@endforeach
@endsection