<div class="blog-item">
	<div class="row">
		<div class="col-xs-12 col-sm-2 text-center">
			<div class="entry-meta">
				<span id="publish_date">{{ $row->published_at }}</span>
				<span><i class="fa fa-user"></i> <a href="#">John Doe {{ $row->user_id }}</a></span>
				<span><i class="fa fa-comment"></i> <a href="blog-item.html#comments">2 Comments</a></span>
				<span><i class="fa fa-heart"></i><a href="#">56 Likes</a></span>
			</div>
		</div>
			
		<div class="col-xs-12 col-sm-10 blog-content">
			<a href="#"><img class="img-responsive img-blog" src="{{ base_url() }}assets/default/images/station-5.png" width="100%" alt="" /></a>
			<h2><a href="blog-item.html">{{ $row->postTitle }}</a></h2>
			<div class="post-tags">
                <strong>Tag:</strong> <a href="#">Cool</a> / <a href="#">Creative</a> / <a href="#">Dubttstep</a> | Category: {{ $row->category_id}}
            </div>
			<h3>{{ $row->postContent }}</h3>
			<a class="btn btn-primary readmore" href="blog-item.html">Read More <i class="fa fa-angle-right"></i></a>
		</div>
	</div>    
</div><!--/.blog-item-->