@extends('layouts.default')
@section('header')
<link href="{{ base_url() }}assets/trevor/sir-trevor.css" rel="stylesheet">
<link href="{{ base_url() }}assets/trevor/sir-trevor-bootstrap.css" rel="stylesheet">
<link href="{{ base_url() }}assets/trevor/sir-trevor-icons.css" rel="stylesheet">
<link href="{{ base_url() }}assets/datepicker/jquery.datetimepicker.css" rel="stylesheet"> 
@endsection
@section('content')
	<h3>{{ empty($page->id) ? 'Add a new page' : 'Edit page ' . $page->title }}</h3>
	{!! validation_errors() !!}
	{!! form_open() !!}
	<table class="table">
		<tr>
			<td>Parent</td>
			<td>{!! form_dropdown('parent_id', $pages_no_parents, ci()->input->post('parent_id') ? ci()->input->post('parent_id') : $page->parent_id, 'class="form-control"') !!}</td>
		</tr>
		<tr>
			<td>Title</td>
			<td>{!! form_input('title', set_value('title', $page->title), 'class="form-control"  placeholder="Page Title"') !!}</td>
		</tr>
		<tr>
			<td>Slug</td>
			<td>{!! form_input('slug', set_value('slug', $page->slug), 'class="form-control" placeholder="Page slug"') !!}</td>
		</tr>
		<tr>
			<td>Body</td>
			<td>
			{!! form_textarea('body', $page->body, ['name' => 'body',
      'id' => 'body', 'class' => 'js-st-instance form-control']); !!}
			</td>
		</tr>
		<tr>
			<td></td>
			<td>{!! form_submit('submit', 'Save', 'class="btn btn-primary"') !!}</td>
		</tr>
	</table>
	{!! form_close() !!}
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
