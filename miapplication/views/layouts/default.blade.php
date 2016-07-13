<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {!! SEO::generate() !!}
    <!-- core CSS -->
    <link href="{{ base_url() }}assets/default/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ base_url() }}assets/default/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ base_url() }}assets/default/css/prettyPhoto.css" rel="stylesheet">
    <link href="{{ base_url() }}assets/default/css/animate.min.css" rel="stylesheet">
    <link href="{{ base_url() }}assets/default/css/main.css" rel="stylesheet">
    <link href="{{ base_url() }}assets/default/css/responsive.css" rel="stylesheet">
    <!-- Jquery-->
    <script src="{{ base_url() }}assets/default/js/jquery.js"></script>
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="{{ base_url() }}assets/default/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ base_url() }}assets/default/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ base_url() }}assets/default/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ base_url() }}assets/default/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="{{ base_url() }}assets/default/images/ico/apple-touch-icon-57-precomposed.png">

    @section('header')

    @show
</head><!--/head-->

<body>

    <header id="header">
        <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-xs-4">
                        <div class="top-number"><p><i class="fa fa-home"></i>  +Send your question</p></div>
                    </div>
                    <div class="col-sm-6 col-xs-8">
                       <div class="social">
                            <ul class="social-share">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-skype"></i></a></li>
                            </ul>
                            <div class="search">
                                <form role="form" action="{{ base_url('search') }}">
                                    <input type="text" class="search-form" autocomplete="off" placeholder="Search">
                                    <i class="fa fa-search"></i>
                                </form>
                           </div>
                       </div>
                    </div>
                </div>
            </div><!--/.container-->
        </div><!--/.top-bar-->

        <nav class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html"><img src="{{ base_url() }}assets/default/images/logo.png" alt="logo"></a>
                </div>

                <div class="collapse navbar-collapse navbar-right">
                    {!! get_menu($nav)!!}
                </div>
            </div><!--/.container-->
        </nav><!--/nav-->

    </header><!--/header-->
    <div class="container">
        <div class="row" style="padding-top: 10px;">
            {!! set_breadcrumb() !!}
        </div>
    </div>
    <section id="blog" class="container">

        <div class="blog">
            <div class="row">
                 <div class="col-md-8">
                    @yield('content')
                </div><!--/.col-md-8-->

                <aside class="col-md-4">
                    <div class="widget search">
                        <form role="form">
                                <input type="text" class="form-control search_box" autocomplete="off" placeholder="Search Here">
                        </form>
                    </div><!--/.search-->
    				@section('sidebar')
                        {{-- expr --}}
                    @show
    				<div class="widget categories">
                        <h3>Recent Comments</h3>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="single_comments">
                                    <img src="{{ base_url() }}assets/default/images/blog/avatar3.png" alt=""  />
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do </p>
                                    <div class="entry-meta small muted">
                                        <span>By <a href="#">Alex</a></span <span>On <a href="#">Creative</a></span>
                                    </div>
                                </div>
                                <div class="single_comments">
                                    <img src="{{ base_url() }}assets/default/images/blog/avatar3.png" alt=""  />
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do </p>
                                    <div class="entry-meta small muted">
                                        <span>By <a href="#">Alex</a></span <span>On <a href="#">Creative</a></span>
                                    </div>
                                </div>
                                <div class="single_comments">
                                    <img src="{{ base_url() }}assets/default/images/blog/avatar3.png" alt=""  />
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do </p>
                                    <div class="entry-meta small muted">
                                        <span>By <a href="#">Alex</a></span <span>On <a href="#">Creative</a></span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div><!--/.recent comments-->
                    <!--.categories-->
                    {!! category() !!}
                    <!--/.categories-->

                    <!--.archieve-->
                    {!! archieve() !!}
                    <!--/.archieve-->

                    <!--.tags-->
                    {!! tagCloud() !!}
                    <!--/.tags-->



    				<div class="widget blog_gallery">
                        <h3>Our Gallery</h3>
                        <ul class="sidebar-gallery">
                            <li><a href="#"><img src="{{ base_url() }}assets/default/images/blog/gallery1.png" alt="" /></a></li>
                            <li><a href="#"><img src="{{ base_url() }}assets/default/images/blog/gallery2.png" alt="" /></a></li>
                            <li><a href="#"><img src="{{ base_url() }}assets/default/images/blog/gallery3.png" alt="" /></a></li>
                            <li><a href="#"><img src="{{ base_url() }}assets/default/images/blog/gallery4.png" alt="" /></a></li>
                            <li><a href="#"><img src="{{ base_url() }}assets/default/images/blog/gallery5.png" alt="" /></a></li>
                            <li><a href="#"><img src="{{ base_url() }}assets/default/images/blog/gallery6.png" alt="" /></a></li>
                        </ul>
                    </div><!--/.blog_gallery-->
    			</aside>
            </div><!--/.row-->
        </div>
    </section><!--/#blog-->

    <section id="bottom">
        <div class="container wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <h3>Company</h3>
                        <ul>
                            <li><a href="#">About us</a></li>
                            <li><a href="#">We are hiring</a></li>
                            <li><a href="#">Meet the team</a></li>
                            <li><a href="#">Copyright</a></li>
                            <li><a href="#">Terms of use</a></li>
                            <li><a href="#">Privacy policy</a></li>
                            <li><a href="#">Contact us</a></li>
                        </ul>
                    </div>
                </div><!--/.col-md-3-->

                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <h3>Support</h3>
                        <ul>
                            <li><a href="#">Faq</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Forum</a></li>
                            <li><a href="#">Documentation</a></li>
                            <li><a href="#">Refund policy</a></li>
                            <li><a href="#">Ticket system</a></li>
                            <li><a href="#">Billing system</a></li>
                        </ul>
                    </div>
                </div><!--/.col-md-3-->

                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <h3>Developers</h3>
                        <ul>
                            <li><a href="#">Web Development</a></li>
                            <li><a href="#">SEO Marketing</a></li>
                            <li><a href="#">Theme</a></li>
                            <li><a href="#">Development</a></li>
                            <li><a href="#">Email Marketing</a></li>
                            <li><a href="#">Plugin Development</a></li>
                            <li><a href="#">Article Writing</a></li>
                        </ul>
                    </div>
                </div><!--/.col-md-3-->

                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <h3>Our Partners</h3>
                        <ul>
                            <li><a href="#">Adipisicing Elit</a></li>
                            <li><a href="#">Eiusmod</a></li>
                            <li><a href="#">Tempor</a></li>
                            <li><a href="#">Veniam</a></li>
                            <li><a href="#">Exercitation</a></li>
                            <li><a href="#">Ullamco</a></li>
                            <li><a href="#">Laboris</a></li>
                        </ul>
                    </div>
                </div><!--/.col-md-3-->
            </div>
        </div>
    </section><!--/#bottom-->

    <footer id="footer" class="midnight-blue">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    &copy; 2013 <a target="_blank" href="http://shapebootstrap.net/" title="Free Twitter Bootstrap WordPress Themes and HTML templates">ShapeBootstrap</a>. All Rights Reserved.<br>
                    Codeigniter {{ CI_VERSION }} | Elapsed Time: {{ $elapsed_time }}
                </div>
                <div class="col-sm-6">
                    <ul class="pull-right">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Faq</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer><!--/#footer-->

    <script src="{{ base_url() }}assets/default/js/bootstrap.min.js"></script>
    <script src="{{ base_url() }}assets/default/js/jquery.prettyPhoto.js"></script>
    <script src="{{ base_url() }}assets/default/js/jquery.isotope.min.js"></script>
    <script src="{{ base_url() }}assets/default/js/main.js"></script>
    <script src="{{ base_url() }}assets/default/js/wow.min.js"></script>
    @section('footer')

    @show
</body>
</html>