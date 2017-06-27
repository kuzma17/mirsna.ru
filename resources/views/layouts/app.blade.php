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
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/slideshow.css" rel="stylesheet">
    <link href="/css/cloud-zoom.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <style>
        div {
            border: 0px solid green;
        }
    </style>
</head>
<body>
<div class="container" >
    <div class="row">
        <div id="page" class="col-lg-12 col-md-12">
            <div class="col-lg-3 col-md-3">
                <div style="width:100%">
                    <div class="logo"><img src="/images/logo.gif"></div>
                </div>
            </div>

            <div class="col-lg-9 col-md-9">
                <div class="menu1">
                    @include('layouts.menu')
                </div>
            </div>

            <div id="clear"></div>
            <div class="line"></div>
            <div id="clear"></div>


            <div class="col-lg-3 col-md-3">
                <div class="row">
                    <div class="left_bl">
                        <div class="select">
                            @include('modules.form_select_item')
                        </div>
                        <div class="block">
                            <h3>Акционные предложения</h3>
                            <div class="line2"></div>
                            <a href="{{ route('promotion') }}"><img src="/images/banner01.jpg" border="0"/></a>
                        </div>

                        <div class='left_bl_image'></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-9">
                <div class="center_bl" style="border-color: red">
                    <div class="brends">
                        @foreach(\App\BrandMenu::where('status', 1)->get() as $brand_menu)
                            <a title="{{ $brand_menu->title }}" class=""
                               href="{{ url('/page/'.$brand_menu->url) }}"><img src="/upload/{{ $brand_menu->logo }}"/></a>
                        @endforeach
                        <div id="clear"></div>
                    </div>
                    <div class="menu_border">
                        <div class="menu">
                            @include('layouts.menuCategory')
                            <div id="clear" ></div>
                        </div>
                    </div>
                        <div>
                            @yield('content')
                        </div>
                    <div id="clear"></div>
                    <br>
                </div>
            </div>



        <div id="clear"></div>
        <div class="line3"></div>
        <div id="clear"></div>

            <div class="row">
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

</div>


<!-- Scripts -->
<script src="/js/app.js"></script>

<script src="/js/wowslider.js"></script>
<script src="/js/jquery.zoom.min.js"></script>

<script src="/js/script.js"></script>
<script src="/js/script-site.js"></script>

<script>
    $(document).ready(function () {
        $('#ex1').zoom();
    });
</script>
</body>
</html>
