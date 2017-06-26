@extends('layouts.app')

@section('content')
    <div class="content_page">
        <h2 style="color:#3399FF">{{ $page->title }}</h2>
        <div class="line" style="background-color:#CCCCCC"></div>
        {!! $page->text !!}
    </div>
@endsection