@extends('layouts.app')

@section('content')

    @include('modules.slideshow')

    <div class="content_page">
        <h2 style="color:#3399FF">{{ $page->title }}</h2>
        <div class="line" style="background-color:#CCCCCC"></div>
        @include('modules.video')
        {!! $page->text !!}
    </div>
@endsection
