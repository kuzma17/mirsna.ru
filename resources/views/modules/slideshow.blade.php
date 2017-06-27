<?php
$images = \App\Slideshow::where('status', 1)->orderBy('num')->get();
?>
<div class="slideshow">
    <div id="wowslider-container1">
        <div class="ws_images"><ul>
                @foreach($images as $image)
                    <li><img src="/upload/{{ $image->image }}" alt="{{ $image->title }}" title="{{ $image->title }}" /></li>
                @endforeach
            </ul>
        </div>
        <div class="ws_bullets">
            <div>
                @foreach($images as $image)
                <a href="#" title="{{ $image->title }}">{{ $image->num }}</a>
                @endforeach
            </div>
        </div>
    </div>
</div>