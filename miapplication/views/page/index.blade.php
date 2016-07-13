@extends('layouts.default')

@section('content')
	<section>
	<h2><span class="glyphicon glyphicon-fire"></span> Pages</h2>
	<p class="pull-right">
	{!! anchor('page/edit', '<i class="glyphicon glyphicon-plus"></i> Add a page') !!}  | 
	{!! anchor('page/order', '<i class="glyphicon glyphicon-refresh"></i> Change page order') !!} 
	</p>
	<table class="table table-striped">
		<thead>
			<tr class="success">
				<th>Title</th>
				<th>Parent</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>
<?php if(count($pages)): foreach($pages as $page): ?>	
		<tr>
			<td>{!! anchor('page/edit/' . $page['id'], ucfirst($page['title'])) !!}</td>
			<td>{!! $page['parent_slug'] !!}</td>
			<td>{!! btn_edit('page/edit/' . $page['id']) !!}</td>
			<td>{!! btn_delete('page/delete/' . $page['id']) !!}</td>
		</tr>
<?php endforeach; ?>
<?php else: ?>
		<tr>
			<td colspan="3">We could not find any pages.</td>
		</tr>
<?php endif;?>	
		</tbody>
	</table>
</section>
@endsection
