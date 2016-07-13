@extends('layouts.default')

	@section('content')
		@if(isset($content))
			{!! $content !!}
			
		@else

		<p>nothing</p>
		@endif
	@endsection

