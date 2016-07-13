@extends('layouts.default')

@section('header')
<link href="{{ base_url() }}assets/tree/default.css" rel="stylesheet">
@endsection

@section('sidebar')
<ul class="nav nav-list">
	<li class="nav-header"><h2><span class="glyphicon glyphicon-link"></span> Links</h2></li>
	<li><a href="/learn/docs">Laravel 5.1 Docs</a></li>
	<li><a href="/learn/yaml">Yaml</a></li>
	<li class="divider"></li>
	<li><a href="/learn/blog">Blog</a></li>
</ul>
@parent
@endsection

@section('content')
{!! $content !!}
<hr>
<ul class="pager">
	<li class="previous"> {!! anchor('learn/'.$blogPageLinks['pPage'], '&larr; Previous Page') !!}
	<li class="next"> {!! anchor('learn/'.$blogPageLinks['nPage'], 'Next Page &rarr;') !!}
</ul>
<div class="well well-sm">
	<div class="page-header">
	  <h2>You Browser Details</h2>
	</div>
	<p>Browser : {{ $ua['name'] }}</p>
	<p>Browser Version : {{ $ua['version'] }}</p>
	<p>Browser Type : {{ $ua['type'] }}</p>
	<p>OS : {{ $ua['platform'] }}</p>
</div>
<hr>
@foreach($blogs as $row)
<h3>{!! anchor($row['url'], $row['title']) !!}</h3>
<p><i class="author inverted icon"></i> {{ $row['author'] }} | <i class="date icon"></i> {{ $row['date'] }} </p>
<p>{!! $row['description'] !!}</p>
<hr>
@endforeach
@endsection
