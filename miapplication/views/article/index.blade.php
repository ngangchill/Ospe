@extends('layouts.default')

@section('content')

<h2>{!! anchor('articles/add', 'Add New Post') !!}

	@if(isset($posts))

	@foreach($posts as $row)
	<div class="blog-item">
		<div class="row">
			<div class="col-sm-2 text-center">
				<div class="entry-meta"> 
					<span id="publish_date">{{ Carbon\Carbon::parse($row->created_at)->format('d M Y') }}</span>
					<span><i class="fa fa-user"></i> <a href="#">{{ ucfirst($row->user->username) }}</a></span>
					<span><i class="fa fa-comment"></i> <a href="blog-item.html#comments">2 Comments</a></span>
					<span><i class="fa fa-heart"></i><a href="#">56 Likes</a></span>
				</div>
			</div>
			<div class="col-sm-10 blog-content">
				<a href="{!! url($row->created_at,$row->slug) !!}"><img class="img-responsive img-blog" src="{!! base_url() !!}assets/default/images/blog/blog2.jpg" width="100%" alt="" /></a>

				<h2><a href="{!! url($row->created_at,$row->slug) !!}">{{ ucfirst($row->postTitle) }}</a></h2>

				<h3>{{ $row->postExcerpt }}</h3>
				
				
				<a class="btn btn-primary readmore" href="{!! url($row->created_at,$row->slug) !!}">Read More <i class="fa fa-angle-right"></i></a>

				
			</div>
		</div>    
	</div><!--/.blog-item-->


	@endforeach
	{!! $links !!}
	@endif
	
	@endsection

