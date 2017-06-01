@extends('layouts.app')

@section('content')

    <h2>Акции</h2>

    @if(count($promotions) > 0)
        @foreach($promotions as $promotion)
            <p>
                <strong>C <span style="color:red;font-weight:normal">
                        {{ $promotion->date_from }}
                    </span> по <span style="color:red;font-weight:normal">
                        {{ $promotion->date_to }}</span> действует акция
                {{ $promotion->title }}
                </strong>
            </p>'
    {{ $promotion->test or '' }}

        @endforeach

    @else
    <p><strong>В настоящее время акции не действуют.</strong></p>
    @endif
@endsection