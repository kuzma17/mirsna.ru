<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns='http://www.w3.org/1999/xhtml' xml:lang="ru">
<head>
    <meta http-equiv='content-type' content='text/html; charset=utf-8' />
    <meta http-equiv='content-style-type' content='text/css' />
    <meta http-equiv='content-language' content='ru' />
    <title><?php echo $site_title; ?></title>
    <link rel='stylesheet' href='/css/style.css' type='text/css' />
    <script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
    @include('modules.header')
    <script type="text/javascript" src="js/script-site.js"></script>
</head>
<body>
<div id="page">
    <div id="head">
        <div style="width:100%">
            <div class="logo"><img src="images/logo.gif"></div>
        </div>
        <div class="menu1">
            <?php
            $num_menu=1; // select menu
            //include 'modules/menu.php';
            ?>
                @include('modules.menu')
        </div>
        <div id="clear"></div>
        <div class="line"></div>
        <div id="clear"></div>
    </div>
    <div style="height:15px"></div>

    <table id="container" width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td class="left_bl" valign="top">
                <div class="select" >
                    @include('modules.form_select_item')

                </div>
                <div class="block">
                    <h3>Акционные предложения</h3>
                    <div class="line2"></div>
                    <a href="index.php?id=actions"><img src="images/banner01.jpg" border="0" /></a>
                </div>
                <div style="width:250px; height:100px"></div>
            </td>
            <td class="center_bl" valign="top">
                <div class="brends">
                    <a class="" href="index.php?id=doctor_health"><img src="images/doctor_health.jpg" onmouseover="javascript:this.src='images/doctor_health_h.jpg'" onmouseout="javascript:this.src='images/doctor_health.jpg'" /></a>
                    <a class="" href="index.php?id=evolution"><img src="images/evolution.jpg" onmouseover="javascript:this.src='images/evolution_h.jpg'" onmouseout="javascript:this.src='images/evolution.jpg'" /></a>
                    <a class="" href="index.php?id=herbalis_kids"><img src="images/herbalis_kids.jpg" onmouseover="javascript:this.src='images/herbalis_kids_h.jpg'" onmouseout="javascript:this.src='images/herbalis_kids.jpg'" /></a>
                    <a class="" href="index.php?id=take_go"><img src="images/take_go.jpg" onmouseover="javascript:this.src='images/take_go_h.jpg'" onmouseout="javascript:this.src='images/take_go.jpg'" /></a>
                    <a class="" href="index.php?id=viva"><img src="images/viva.jpg" onmouseover="javascript:this.src='images/viva_h.jpg'" onmouseout="javascript:this.src='images/viva.jpg'" /></a>
                    <a class="" href="index.php?id=sleep_fly"><img src="images/sleep_fly.jpg" onmouseover="javascript:this.src='images/sleep_fly_h.jpg'" onmouseout="javascript:this.src='images/sleep_fly.jpg'" /></a>
                    <a class="" href="index.php?id=american_dream"><img src="images/american_dream.jpg" onmouseover="javascript:this.src='images/american_dream_h.jpg'" onmouseout="javascript:this.src='images/american_dream.jpg'" /></a>
                    <div id="clear"></div>
                </div>

                <div class="menu_border">
                    <div class="menu">

                        <?php
                        $num_menu=2;
                        //include 'modules/menu.php';
                        ?>
                            @include('modules.menu')
                        <div id="clear"></div>
                    </div>
                </div>
                <?php if(!$_GET['id'] || $_GET['id']=='home'){include 'modules/slideshow.php';} ?>
    @include('modules.slideshow')

    @include('layouts.content')

</div>
</td>
</tr>
</table>
<div class="line3"></div>
<div id="bottom">
    <div class="menu3">
        <ul>
            <?php
            $num_menu=1; // select menu
            //include 'modules/menu.php';
            ?>
                @include('modules.menu')
        </ul>
    </div>
    <div class='copyright'>
        Copyright 2013 © mirsna.od.ua &nbsp;&nbsp;Designed by <a href='mailto:v.kuzma@mail.ru' title='написать письмо вебмастеру'>Kuzma</a>
    </div>
</div>
</div>
</div>
</body>
</html>