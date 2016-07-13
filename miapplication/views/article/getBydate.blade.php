@extends('layouts.default')

@section('content')
	<div class="left">
            <h2>Archieve : {{ Carbon\Carbon::parse($year.'-'. $month)->format('F Y') }}</h2>
            <hr>
        </div>	
		@foreach($posts as $post)
			@include('partials.blog', ['row' => $post])
		@endforeach

	{!! $links !!}
@endsection