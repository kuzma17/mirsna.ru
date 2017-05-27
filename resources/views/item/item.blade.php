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

<?php
//if($discount=$body->discount($_GET['item'])){
  //  echo '<div class="discount">-'.$discount.'%</div>';
//}
?>
{!! $item->text !!}

<?php
//if($_GET['type']==1){
//module settings
?>
<div style="clear:both"></div>
<p><strong>Параметры</strong></p>
<table class="settings" cellpadding="1" cellspacing="1">
    <?php
    //if($_GET['brend']==5 || $_GET['series']==10){
    ?>
    <TR>
        <TD>Высота матраса:</TD><TD>{{ $item->height->name }} см.</TD>
    </TR>
    <?php
    //}else{
    // -- hard --
  //  $arr_hard_item=$body->hard($_GET['item']);
   // $hard_item='';
   // foreach($arr_hard_item as $hard_value){$hard_item.=$hard_value.', ';}
   // $hard_item=chop($hard_item, ', ');
    // -----
    ?>
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
<?php
//if($content['img_set']!=''){
?>
<div style="float:right">
    <img src="images/" /><br>
</div>
<?php
//}
?>

<?php
//}
// include module price
//if($_GET['brend']==5){
   // include 'modules/price_item2.php';
//}elseif($_GET['type']==2){
  //  include 'modules/price_item3.php';
//}else{
  //  include 'modules/price_item1.php';
//}

?>
<div id="clear"></div>
<br>
<?php
//if($content['img_bottom']!=''){
?><div class="content_bottom">
    <img src="images" /></div>
<?php
//}
?>

@endsection
