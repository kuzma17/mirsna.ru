<?php
/**
 * Created by PhpStorm.
 * User: kuzma
 * Date: 17.08.17
 * Time: 10:56
 */
$video = \App\Video::where('url_site', Request::url())->where('status', 1)->first();
?>

@if(count($video) > 0)
    <div style="margin-bottom:20px;margin-top: 30px">
        <div class="video_box">
            <div class="video_panel">
                <A id="video_a" href="#" style="color:#FFFFFF">скрыть видео</A></div>
            <div id="fr"><iframe id="video" src="{{ $video->url_video }}&showinfo=0&wmode=opaque&wmode=transparent" frameborder="0" allowfullscreen></iframe></div>
        </div>
    </div>
@endif
