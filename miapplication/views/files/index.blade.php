@extends('layouts.default')
@section('header')
<link href="{{ base_url() }}assets/tree/default.css" rel="stylesheet">
@endsection
@section('content')
<h2> All Files:</h2>
{!! $treeView !!}

@endsection

@section('footer')
<script type="text/javascript" src="{{ base_url() }}assets/tree/php_file_tree_jquery.js"></script>
@endsection
