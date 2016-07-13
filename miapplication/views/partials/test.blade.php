@extends('layouts.partials.bootstrap')

@section('title','Add Content')

@section('header')
<link href="{{ base_url() }}assets/trevor/sir-trevor.css" rel="stylesheet">
<link href="{{ base_url() }}assets/trevor/sir-trevor-bootstrap.css" rel="stylesheet">
<link href="{{ base_url() }}assets/trevor/sir-trevor-icons.css" rel="stylesheet">
<link href="{{ base_url() }}assets/datepicker/jquery.datetimepicker.css" rel="stylesheet"> 
@endsection
@section('content')

<div class="row">
	<div class="col-md-12">
		{!! form_open('articles/add', ['id'=>'contentForm', 'role'=>'form', 'class'=>'form-horizontal']) !!}
		<h2>Content:<small> Click on "+" and start writting </small></h2>
		<div class="control-group">
			{!! form_textarea('content', set_value('content'), ['name' => 'content',
			'id' => 'content', 'class' => 'js-st-instance form-control']); !!}
		</div>
		<!-- Button trigger modal -->
		<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
			Next
		</button>

		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">Modal title</h4>
					</div>
					<div class="modal-body">

						<div class="form-group">
							<label for="postTitle">Post Title</label>
							{!! form_input('postTitle', set_value('postTitle'), ['id'=>'postTitle','class'=>'form-control', 'placeholder'=> 'Post Title']) !!}
						</div>

						<div class="form-group">
							<label for="postExcerpt">Post Excerpt</label>
							{!! form_textarea('postExcerpt', set_value('postExcerpt'), ['name' => 'postExcerpt','id' => 'postExcerpt', 'class' => 'form-control']); !!}
						</div>

						<div class="form-group">
							<label for="uri">uri</label>
							{!! form_input('uri', set_value('uri'), ['id'=>'uri','class'=>'form-control', 'placeholder'=> 'uri']) !!}
						</div>

						<div class="form-group">
							<label for="postImage">postImage</label>
							{!! form_input('postImage', set_value('postImage'), ['id'=>'postImage','class'=>'form-control', 'placeholder'=> 'postImage']) !!}
						</div>
						<div class="form-group">
							<label for="postStatus">postStatus</label>
							{!! form_input('postStatus', set_value('postStatus'), ['id'=>'postStatus','class'=>'form-control', 'placeholder'=> 'postStatus']) !!}
						</div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<a class="btn btn-primary" onClick="formSubmit()">Post</a>
					</div>
				</div>
			</div>
			<!-- Model ends -->

			{!! form_close() !!}
		</div>
	</div>

	@endsection

	@section('footer')
	<script src="{{ base_url() }}assets/datepicker/jquery.datetimepicker.js"></script>
	<script src="{{ base_url() }}assets/trevor/underscore.js"></script>
	<script src="{{ base_url() }}assets/trevor/eventable.js"></script>
	<script src="{{ base_url() }}assets/trevor/sortable.min.js"></script>
	<script src="{{ base_url() }}assets/trevor/sir-trevor.js"></script>
	<script src="{{ base_url() }}assets/trevor/sir-trevor-bootstrap.js"></script>
	<script src="{{ base_url() }}assets/js/markdown.js"></script>

	<script type="text/javascript">
		new SirTrevor.Editor({ el: $('.js-st-instance'),
			blockTypes: ["Columns", "Heading", "Text", "ImageExtended", "Quote", "Accordion", "Button", "Video", "List", "Iframe","Markdown"]
		});
	</script>
	<script type="text/javascript">
		function formSubmit(){
			SirTrevor.onBeforeSubmit();
			document.getElementById("contentForm").submit();
		}
	</script>

	@endsection
