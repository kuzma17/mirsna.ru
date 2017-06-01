<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <!-- <link href="/css/app.css" rel="stylesheet"> -->
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/slideshow.css" rel="stylesheet">
    <link href="/css/cloud-zoom.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<div id="page">
    <div id="head">
        <div style="width:100%">
            <div class="logo"><img src="/images/logo.gif"></div>
        </div>
        <div class="menu1">
            @include('layouts.menu')
        </div>
        <div id="clear"></div>
        <div class="line"></div>
        <div id="clear"></div>
    </div>
    <div style="height:15px"></div>

    <table id="container" width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td class="left_bl" valign="top">
                <div class="select">
                    @include('modules.form_select_item')


                </div>
                <div class="block">
                    <h3>Акционные предложения</h3>
                    <div class="line2"></div>
                    <a href="index.php?id=actions"><img src="/images/banner01.jpg" border="0"/></a>
                </div>
                <div style="width:250px; height:100px"></div>
            </td>
            <td class="center_bl" valign="top">
                <div class="brends">
                    <a class="" href="index.php?id=doctor_health"><img src="/images/doctor_health.jpg"
                                                                       onmouseover="javascript:this.src='/images/doctor_health_h.jpg'"
                                                                       onmouseout="javascript:this.src='/images/doctor_health.jpg'"/></a>
                    <a class="" href="index.php?id=evolution"><img src="/images/evolution.jpg"
                                                                   onmouseover="javascript:this.src='/images/evolution_h.jpg'"
                                                                   onmouseout="javascript:this.src='/images/evolution.jpg'"/></a>
                    <a class="" href="index.php?id=herbalis_kids"><img src="/images/herbalis_kids.jpg"
                                                                       onmouseover="javascript:this.src='/images/herbalis_kids_h.jpg'"
                                                                       onmouseout="javascript:this.src='/images/herbalis_kids.jpg'"/></a>
                    <a class="" href="index.php?id=take_go"><img src="/images/take_go.jpg"
                                                                 onmouseover="javascript:this.src='/images/take_go_h.jpg'"
                                                                 onmouseout="javascript:this.src='/images/take_go.jpg'"/></a>
                    <a class="" href="index.php?id=viva"><img src="/images/viva.jpg"
                                                              onmouseover="javascript:this.src='/images/viva_h.jpg'"
                                                              onmouseout="javascript:this.src='/images/viva.jpg'"/></a>
                    <a class="" href="index.php?id=sleep_fly"><img src="/images/sleep_fly.jpg"
                                                                   onmouseover="javascript:this.src='/images/sleep_fly_h.jpg'"
                                                                   onmouseout="javascript:this.src='/images/sleep_fly.jpg'"/></a>
                    <a class="" href="index.php?id=american_dream"><img src="/images/american_dream.jpg"
                                                                        onmouseover="javascript:this.src='/images/american_dream_h.jpg'"
                                                                        onmouseout="javascript:this.src='/images/american_dream.jpg'"/></a>
                    <div id="clear"></div>
                </div>

                <div class="menu_border">
                    <div class="menu">

                        @include('layouts.menuCategory')

                        <div id="clear"></div>
                    </div>
                </div>

                <div >
                    @yield('content')
                </div>

</td>
</tr>
</table>
<div class="line3"></div>
<div id="bottom">
    <div class="menu3">
        <ul>
            @include('layouts.menu')

        </ul>
    </div>
    <div class='copyright'>
        Copyright 2013 © mirsna.od.ua &nbsp;&nbsp;Designed by <a href='mailto:v.kuzma@mail.ru'
                                                                 title='написать письмо вебмастеру'>Kuzma</a>
    </div>
</div>
</div>
</div>

<!-- Scripts -->
<script src="/js/app.js"></script>

<script src="/js/wowslider.js"></script>
<script src="/js/cloud-zoom.js"></script>

<script src="/js/script.js"></script>
<script src="/js/script-site.js"></script>
</body>
</html>
