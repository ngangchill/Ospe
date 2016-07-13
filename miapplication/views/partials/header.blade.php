<!DOCTYPE html>
<html lang="en">
<head>
    {!! Meta::renderTags() !!}
    <title>OSPE :: @yield('title') </title>
    <!-- core CSS -->
    <link href="{{ base_url() }}assets/default/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ base_url() }}assets/default/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ base_url() }}assets/default/css/prettyPhoto.css" rel="stylesheet">
    <link href="{{ base_url() }}assets/default/css/animate.min.css" rel="stylesheet">
    <link href="{{ base_url() }}assets/default/css/main.css" rel="stylesheet">
    <link href="{{ base_url() }}assets/default/css/responsive.css" rel="stylesheet">
    
    <!--[if lt IE 9]>
    <script src="{{ base_url() }}assets/default/js/html5shiv.js"></script>
    <script src="{{ base_url() }}assets/default/js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{ base_url() }}assets/default/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ base_url() }}assets/default/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ base_url() }}assets/default/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ base_url() }}assets/default/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="{{ base_url() }}assets/default/images/ico/apple-touch-icon-57-precomposed.png">

    @section('header')
    @show
</head>
