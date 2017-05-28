<?php
/**
 * Created by PhpStorm.
 * User: kuzma
 * Date: 24.05.17
 * Time: 12:13
 */
?>

<ul class="parent0">
    @foreach(\App\Category::where('status', 1)->where('parent_id', 1)->get() as $menu)
        <li class="lin0">
            @if($menu->url)
                <a href="{{ $menu->url }}">{{ $menu->title }}</a>
            @else
                <span>{{ $menu->title }}</span>
            @endif
        @if(\App\Category::where('status', 1)->where('parent_id', $menu->id)->get())
            <ul class="parent1">
                @foreach(\App\Category::where('status', 1)->where('parent_id', $menu->id)->get() as $menu1)
                    <li class="lin1"><a href="{{ $menu1->url }}">{{ $menu1->title }}</a>
                        @if(\App\Category::where('status', 1)->where('parent_id', $menu1->id)->get())
                            <ul class="parent2">
                                @foreach(\App\Category::where('status', 1)->where('parent_id', $menu->id)->get() as $menu2)
                                    <li class="lin2"><a href="{{ $menu2->url }}">{{ $menu2->title }}</a></li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif
        </li>
    @endforeach
</ul>
