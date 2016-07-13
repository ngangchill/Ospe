@extends('layouts.default')

@section('content')
	<div class="left">
            <h2>Category: {{ ucfirst($cat->categoryTitle) }}</h2>
            <!-- <p class="lead">{{ $cat->categoryDescription }}</p> -->
            <hr>
        </div>
	
		@foreach($posts as $post)
			@include('partials.blog', ['row' => $post])
		@endforeach

	{!! $links !!}
@endsection