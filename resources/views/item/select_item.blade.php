<?php
/**
 * Created by PhpStorm.
 * User: kuzma
 * Date: 29.05.17
 * Time: 11:51
 */

?>
@extends('layouts.app')

@section('content')

<div class="sortseach">
    сортировать по цене: <A href="#" sort="desc"> вниз</A> <A href="#" sort="asc">вверх</A>
</div>
<div id="both"></div>
<!-- end module SORT -->
<div style="margin-top:10px;margin-left:10px"><strong style="color:#FF8000">По Вашему запрсу:</strong><br>
    @if(isset($user_request['brand'])) Бренд: {{ $user_request['brand'] }} <br> @endif
    @if(isset($user_request['size'])) Размер: {{ $user_request['size'] }} <br> @endif
    @if(isset($user_request['height'])) Высота: {{ $user_request['height'] }} <br> @endif
    @if(isset($user_request['spring'])) Пружинный блок: {{ $user_request['spring'] }} <br> @endif
    @if(isset($user_request['hard'])) Жосткость: {{ $user_request['hard'] }} <br> @endif
    @if(isset($user_request['weight'])) Макс.вес на место: {{ $user_request['weight'] }} <br> @endif
    @if(isset($user_request['price_from'])) Цена от: {{ $user_request['price_from'] }} <br> @endif
    @if(isset($user_request['price_to'])) Цена до: {{ $user_request['price_to'] }} <br> @endif
</div>
<br>
@if(count($items) > 0)

<table class="select_item" cellspacing="1" cellpadding="1" width="100%">
    <tbody>
    <tr class="head_table"><TD>бренд</TD><TD>модель</TD><TD>размер</TD><TD>высота</TD><TD>пружинный блок</TD><TD>жесткость</TD><TD>макс.вес<br>на место</TD><TD>цена</TD></tr>
    @foreach($items as $item)
        <tr onclick="location.href='{{ url('/item/'.$item->id) }}'" class="row_select">
            <td>{{ $item->brand }}</td>
            <TD>{{ $item->name }}</TD>
            <TD>{{ $item->x.' x '.$item->y }}</TD>
            <TD>{{ $item->height }}</TD>
            <TD>{{ $item->spring }}</TD>
            <TD>{{ \App\Http\Controllers\PriceController::hard($item->id) }}</TD>
            <TD>{{ $item->weight }}</TD>
            <TD>
                @if($item->discount)
                    <span style="color:red" title="акционная цена">
                    {{ $item->price - (($item->price / 100) * $item->discount)}}
                    </span>
                @else
                    {{ $item->price }}
                @endif
            </TD>
        </tr>

    @endforeach
    </tbody>
</table>
@else
    <p style="text-align:center">По Вашему запросу в базе нет матрасов. Попробуйте задать другие параметры.</p>
@endif

@endsection
