<?php
/**
 * Created by PhpStorm.
 * User: kuzma
 * Date: 27.05.17
 * Time: 19:44
 */
?>
@extends('layouts.app')

@section('content')
<div class="content_page">
<div class="floating"></div>
<div style="width:410px;float:right">
    <div id="backpage" class="button_item_box" onClick="history.back();return false;">
        <div class="button_item">
            <span style="font-family:sans-serif;font-size:12px;color:#FFFFFF;text-decoration:none;"><< назад</span>
        </div>
        <div style="clear: both"></div>
        в предыдущий раздел
    </div>
</div>
    <div style="clear:both;"></div>
    <h2 style="color:#3399FF; margin-top: -20px">{{ $item->name }}</h2>
    <div class="line" style="background-color:#CCCCCC"></div>

    @include('modules.video')

@if($item->image)
<div class="zoom_img" id='ex1'>
    <img src="{{ url('/upload/'.$item->image) }}" title="" style="width: 300px; height: 200px;" />
</div>
@endif

@if($discount)<div class="discount">-{{ $discount }}</div>@endif
<div style="margin-top: 10px">
    {!! $item->text !!}
</div>

<div style="clear:both"></div>
@if(isset($item->height_m) && $item->height_m != 0 && isset($item->spring->name) && isset($item->hard) && isset($item->weight_m) && $item->weight_m != 0)
<p><strong>Параметры</strong></p>
<table class="settings" cellpadding="1" cellspacing="1">
    @if(isset($item->height_m) && $item->height_m != 0)
    <TR>
        <TD>Высота матраса:</TD><TD>{{ $item->height_m }} см.</TD>
    </TR>
    @endif
    @if(isset($item->spring->name))
    <TR>
        <TD>Пружинный блок:</TD><TD>{{ $item->spring->name }}</TD>
    </TR>
        @endif
        @if(isset($item->hard) && count($item->hard) > 0)
    <TR>
        <TD>Степень жесткости:</TD><TD>
            @foreach($item->hard as $hard)
                {{ $hard->name }}
            @endforeach
        </TD>
    </TR>
        @endif
        @if(isset($item->weight_m) && $item->weight_m != 0)
    <TR>
        <TD>Макс. вес на спальное место:</TD><TD>{{ $item->weight_m }} кг.</TD>
    </TR>
            @endif

</table>
@endif
<br>

<p>Прайс {{ $item->brand->name or '' }} грн.
        @if($discount)
        с учетом <span style="color:red">акции - {{ $discount }}%</span>';
        @endif
    </p>
    @if($item->type_item_id == 2)
    @include('item.table2')
    @else
    @include('item.table1')
    @endif

</div>
@endsection