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

<?php //$content=$body->item($_GET['item']);
//if($content['img_zoom_big']!='' && $content['img_zoom']!=''){
?>

@if($item->image)
<div class="zoom_img">
    <a href="{{ url('/upload/'.$item->image) }}" id="zoom1" class="cloud-zoom" rel="position: 'inside' , showTitle: false, adjustX:0, adjustY:0" style=""><img src="{{ url('/upload/'.$item->image.'_150x100.jpg') }}" alt="Active Flex" title="Active Flex" style="width:300px;" /> </a>
    <div style="font-family:sans-serif;
font-size:8px;
color:#646464;
float:right;margin-right:5px;"><img src="/images/zoom.png" style="float:left"> zoom image</div>
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
                {{ $hard->hard->name }}
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
            <td colspan="{{ count($item->price) }}">Ширина (мм)</td>
        </tr>
        <tr>
            <td>Длина (мм)</td>
            @foreach($item->price as $size_x)
                <th>{{ $size_x->size->x }}</th>
            @endforeach
        </tr>
        @foreach($item->price as $size_y)
            <tr>
                <td>{{ $size_x->size->x }}</td>
                @foreach($item->price as $size_x)
                    <td>
                        @if($discount)
                            <span style="text-decoration:line-through; color:#8E8E8E">
                                {{ $arr_price[$size_x->size->x][$size_y->size->y]['price'] or '-'}}
                            </span><br>
                            <span style="color: red">
                                {{ $arr_price[$size_x->size->x][$size_y->size->y]['price2'] or ''}}
                            </span>
                        @else
                        {{ $arr_price[$size_x->size->x][$size_y->size->y]['price'] or '-'}}
                        @endif
                     </td>
                @endforeach
            </tr>
        @endforeach
    </table>
@endsection