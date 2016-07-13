
@extends('layouts.default')

@section('content')

<div class="blog-item">
	<img class="img-responsive img-blog" src="{!! base_url() !!}assets/default/images/blog/blog1.jpg" width="100%" alt="" />
	<div class="row">  
		<div class="col-xs-12 col-sm-2 text-center">
			<div class="entry-meta">
				<span id="publish_date">{{ Carbon\Carbon::parse($post->created_at)->format('d M') }}</span>
				<span><i class="fa fa-user"></i> <a href="#">{{ ucfirst($post->user->username) }}</a></span>
				<span><i class="fa fa-comment"></i> <a href="blog-item.html#comments">2 Comments</a></span>
				<span><i class="fa fa-heart"></i><a href="#">56 Likes</a></span>
			</div>
		</div>
		<div class="col-xs-12 col-sm-10 blog-content">
			<h2>{{ ucfirst($post->postTitle) }}</h2>
			{!! App::make('trevor')->toHtml($post->postContent) !!}

			<div class="post-tags">
				<strong>Tag:</strong> 
				<?php $tags = $post->tags->toArray();?>
				@if(isset($tags))
					@foreach($tags as $tag)
						<a class="btn btn-xs btn-default" href="{{ base_url('articles/tag/'.$tag['slug']) }}">{{ ucfirst($tag['name']) }}</a>
					@endforeach
				@endif
			</div>

		</div>
	</div>
</div><!--/.blog-item-->

@endsection

