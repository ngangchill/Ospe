@include('partials.header')
<body>
@include('partials.nav')
	<div class="container">
        <div class="row" style="padding-top: 10px;">
            {!! set_breadcrumb() !!}
        </div>
    </div>
    <section id="blog" class="container">
        <div class="blog">
			@yield('content')
        </div>
    </section>
@include('partials.bottom')
@include('partials.footer')