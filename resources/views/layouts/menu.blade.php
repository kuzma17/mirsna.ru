<?php
/**
 * Created by PhpStorm.
 * User: kuzma
 * Date: 24.05.17
 * Time: 11:48
 */
?>

<ul class="parent0">
    @foreach(\App\Menu::where('status', 1)->orderBy('num', 'asc')->get() as $menu)
        <li class="lin0"><a href="{{ $menu->url }}">{{ $menu->title }}</a></li>
    @endforeach
</ul>
