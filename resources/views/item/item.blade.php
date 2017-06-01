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

    <style>
        /* styles unrelated to zoom */

        p.cl { position:absolute; top:3px; right:28px; color:#555; font:bold 13px/1 sans-serif;}

        /* these styles are for the demo, but are not required for the plugin */
        .zoom_img {
            display:inline-block;
            position: relative;
        }

        /* magnifying glass icon */
        .zoom_img:after {
            content:'';
            display:block;
            width:33px;
            height:33px;
            position:absolute;
            top:0;
            right:0;
            background:url(icon.png);
        }

        .zoom_img img {
            display: block;
        }

        .zoom_img img::selection { background-color: transparent; }

        #ex2 img:hover { cursor: url(grab.cur), default; }
        #ex2 img:active { cursor: url(grabbed.cur), default; }
    </style>

<h2 style="color:#3399FF">{{ $item->name }}</h2>
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
             style="width:120px;
float:right;
margin-top:2px;
border: 1px #CCCCCC solid;
 -moz-border-radius: 7px;
 -webkit-border-radius: 7px;
 -khtml-border-radius:7px;
 border-radius: 7px;
background-color:#FF9650;
padding:2px 5px;
text-align:center;
">
            <span style="font-family:sans-serif;font-size:12px;color:#FFFFFF;text-decoration:none;"><< назад</span>
        </div>
        в предыдущий раздел
    </div>
</div>

@if($item->image)
<div class="zoom_img" id='ex1'>
    <img src="{{ url('/upload/'.$item->image) }}" title="" style="width:200px; height: 150px" />
</div>
@endif

@if($discount)<div class="discount">-{{ $discount }}</div>@endif
{!! $item->text !!}

<div style="clear:both"></div>
<p><strong>Параметры</strong></p>
<table class="settings" cellpadding="1" cellspacing="1">
    <TR>
        <TD>Высота матраса:</TD><TD>{{ $item->height->name }} см.</TD>
    </TR>

    <TR>
        <TD>Пружинный блок:</TD><TD>{{ $item->spring->name }}</TD>
    </TR>
    <TR>
        <TD>Степень жесткости:</TD><TD>
            @foreach($item->hard as $hard)
                {{ $hard->name }}
            @endforeach
        </TD>
    </TR>
    <TR>
        <TD>Высота матраса:</TD><TD>{{ $item->height->name }} см.</TD>
    </TR>
    <TR>
        <TD>Макс. вес на спальное место:</TD><TD>{{ $item->weight->name }} кг.</TD>
    </TR>

</table>
<br>

<p><strong>Прайс {{ $item->brand->name or '' }} грн.
        @if($discount)
        с учетом <span style="color:red">акции - {{ $discount }}%</span>';
        @endif

    <table class="price" cellspacing="1" cellpadding="1">
        <tr>
            <td width="96">Размеры</td>
            <td colspan="{{ count($arr_x) }}">Ширина (мм)</td>
        </tr>
        <tr>
            <td>Длина (мм)</td>
            @foreach($arr_x as $x)
                <td>{{ $x }}</td>
            @endforeach
        </tr>
        @foreach($arr_y as $y)
            <tr>
                <td>{{ $y }}</td>
                @foreach($arr_x as $x)
                    <td>
                        @if($discount)
                            <span style="text-decoration:line-through; color:#8E8E8E">
                                {{ $arr_price[$x][$y]['price'] or '-'}}
                            </span><br>
                            <span style="color: red">
                                {{ $arr_price[$x][$y]['price2'] or ''}}
                            </span>
                        @else
                        {{ $arr_price[$x][$y]['price'] or '-'}}
                        @endif
                     </td>
                @endforeach
            </tr>
        @endforeach
        @if(isset($item->custom_price))
            <tr>
                <td colspan="{{ count($arr_x) + 1 }}">
                    Нестандартный размер (стоимость за 1 кв. м.) - {{ $item->custom_price->price }}
                </td>
            </tr>
        @endif
    </table>
@endsection