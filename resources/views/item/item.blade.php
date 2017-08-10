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
    <div id="backpage" style="width:132px;
height:35px;
padding:1px;
margin-right:5px;
float:right;
text-align:center;
border: 1px #CCCCCC solid;
 -moz-border-radius: 7px;
 -webkit-border-radius: 7px;
 -khtml-border-radius:7px;
 border-radius: 7px;
font-family:sans-serif;
font-size:8px;
color:#7B7B7B; cursor: pointer;" onClick="history.back();return false;">
        <div class="menu_item"
             style="width:128px;
float:right;
margin-top:-10px;
border: 1px #CCCCCC solid;
 -moz-border-radius: 7px;
 -webkit-border-radius: 7px;
 -khtml-border-radius:7px;
 border-radius: 7px;
background-color:#FF9650;
padding:2px 5px;
text-align:center;">
            <span style="font-family:sans-serif;font-size:12px;color:#FFFFFF;text-decoration:none;"><< назад</span>
        </div>
        <div style="clear: both"></div>
        в предыдущий раздел
    </div>
</div>
    <div style="clear:both;"></div>
    <h2 style="color:#3399FF; margin-top: -20px">{{ $item->name }}</h2>
    <div class="line" style="background-color:#CCCCCC"></div>

@if($item->image)
<div class="zoom_img" id='ex1'>
    <img src="{{ url('/upload/'.$item->image) }}" title="" style="width: 300px; height: 200px;" />
</div>
@endif

@if($discount)<div class="discount">-{{ $discount }}</div>@endif
{!! $item->text !!}

<div style="clear:both"></div>
@if(isset($item->height->name) || isset($item->spring->name) || isset($item->hard) || isset($item->height->name) || isset($item->weight->name))
<p><strong>Параметры</strong></p>
<table class="settings" cellpadding="1" cellspacing="1">
    @if(isset($item->height->name))
    <TR>
        <TD>Высота матраса:</TD><TD>{{ $item->height->name }} см.</TD>
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
        @if(isset($item->weight->name))
    <TR>
        <TD>Макс. вес на спальное место:</TD><TD>{{ $item->weight->name }} кг.</TD>
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