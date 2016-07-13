@extends('layouts.default')
@push('header')
	<link href="{{ base_url() }}assets/css/sortable.css" rel="stylesheet">
    <script src="{{ base_url() }}assets/js/jquery-ui-1.9.1.custom.min.js"></script>
    <script src="{{ base_url() }}assets/js/jquery.mjs.nestedSortable.js"></script>
@endpush
@section('content')
	<section>
	<h2>Order pages</h2>
		<p class="alert alert-info">Drag to order pages and then click 'Save'</p>
		<div id="orderResult"></div>
		<input type="button" id="save" value="Save" class="btn btn-primary" />
	</section>

	<script>
	$(function() {
		
		$.post('<?php echo base_url('page/order_ajax'); ?>', {}, function(data){
			$('#orderResult').html(data);
		});

		$('#save').click(function(){
			oSortable = $('.sortable').nestedSortable('toArray');

			$('#orderResult').slideUp(function(){
				$.post('<?php echo base_url('page/order_ajax'); ?>', { sortable: oSortable }, function(data){
					$('#orderResult').html(data);
					$('#orderResult').slideDown();
				});
			});
			
		});
	});
	</script>

@endsection