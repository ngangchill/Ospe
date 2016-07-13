@extends('layouts.default')

@section('content')
	<div class="left">
            <h2>Tag: {{ $tag }}</h2>
            <hr>
        </div>	
		@foreach($posts as $post)
			@include('partials.blog', ['row' => $post])
		@endforeach

	{!! $links !!}
@endsection