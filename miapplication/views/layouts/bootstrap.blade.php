<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Meta, title, CSS, favicons, etc. -->
        {!! Meta::renderTags() !!}
        <title>Toolkit :: @yield('title')</title>
        <!-- Bootstrap core CSS -->
        <link href="{{ base_url('assets/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ base_url('assets/css/jasny-bootstrap.min.css') }}" rel="stylesheet">

        <!-- Documentation extras -->
        <link href="{{ base_url('assets/css/docs.css') }}" rel="stylesheet">
        <link href="{{ base_url('assets/css/pygments-manni.css') }}" rel="stylesheet">
        @section('extra_head')       
        @show
        <!--[if lt IE 9]><script src="{{ base_url('assets/js/ie8-responsive-file-warning.js') }}"></script><![endif]-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <!-- Favicons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ base_url('assets/ico/apple-touch-icon-144-precomposed.png') }}">
        <link rel="shortcut icon" href="{{ base_url('assets/ico/favicon.png') }}">

        <script>
            (function(i, s, o, g, r, a, m){i['GoogleAnalyticsObject'] = r; i[r] = i[r] || function(){
            (i[r].q = i[r].q || []).push(arguments)}, i[r].l = 1 * new Date(); a = s.createElement(o),
                    m = s.getElementsByTagName(o)[0]; a.async = 1; a.src = g; m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
                    ga('create', 'UA-72495301-1', 'auto');
                    ga('send', 'pageview');        </script>

        <script type="text/javascript">
                    /* <![CDATA[ */
                            (function () {
                            var s = document.createElement('script'), t = document.getElementsByTagName('script')[0];
                                    s.type = 'text/javascript';
                                    s.async = true;
                                    s.src = '{{ base_url('assets / js / loader1276.js?mode = auto') }};
                                    t.parentNode.insertBefore(s, t);
                            })();
                            /* ]]> */
        </script>

    </head>
    <body class="">
        <script type="text/javascript">
            if (localStorage && localStorage.hide_twbs === 'no')
            document.body.setAttribute('class', 'bs-twbs-show')
        </script>

        <a class="sr-only" href="#content">Skip to main content</a>

        @include('layouts.partials.nev')
        @include('layouts.partials.notification')

        <!-- Docs page layout -->
        <div class="bs-header" id="content">
            <div class="container">
                @section('header')
                <h1>CSS</h1>
                <p>Global CSS settings, fundamental HTML elements styled and enhanced with extensible classes, and an advanced grid system.</p>
                <div id="aboutme-container">
                    <a href="##mailto:arnold@jasny.net" class="aboutme">
                        <img class="img-circle" src="#" alt="Arnold Daniels">
                        <div class="aboutme-text">
                            <span class="aboutme-title">Looking for a developer?</span>
                            I'm available for freelance work, I want to hear about your projects.
                            <span class="aboutme-name">- Arnold Daniels</span>
                        </div>
                    </a>
                </div>
                @show
            </div>
        </div>

        <div class="container bs-docs-container">

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <br>
                    {!! set_breadcrumb() !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" role="main">
                    @yield('content')
                </div>
                <!-- sidebar ---->
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    @section('sidebar')
                    <div class="bs-docs-section">
                        <div class="page-header">
                            <h1 id="overview">Overview</h1>
                        </div>

                        <h3 id="overview-container">Containers</h3>
                        <p>Added <code>.container-smooth</code> a container to use the same <code>max-width</code> for all viewport sizes. This means that the container size won't jump at media query breakpoints.</p>
                    </div>
                    @show
                </div>
                <!-- End Sidebar --> 
            </div>

        </div>

        <!-- Footer
        ================================================== -->
        <footer class="bs-footer" role="contentinfo">
            <div class="container">
                <div class="row">

                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <div class="bs-social">
                            <ul class="bs-social-buttons">
                                <li>
                                    <iframe class="github-btn" src="http://ghbtns.com/github-btn.html?user=jasny&amp;repo=bootstrap&amp;type=watch&amp;count=true" width="100" height="20" title="Star on GitHub"></iframe>
                                </li>
                                <li>
                                    <iframe class="github-btn" src="http://ghbtns.com/github-btn.html?user=jasny&amp;repo=bootstrap&amp;type=fork&amp;count=true" width="102" height="20" title="Fork on GitHub"></iframe>
                                </li>
                                <li class="follow-btn">
                                    <a href="https://twitter.com/ArnoldDaniels" class="twitter-follow-button" data-link-color="#0069D6" data-show-count="true">Follow @ArnoldDaniels</a>
                                </li>
                                <li class="tweet-btn">
                                    <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://jasny.github.io/bootstrap" data-count="horizontal" data-via="ArnoldDaniels">Tweet</a>
                                </li>
                                <li>
                                    <a class="FlattrButton" style="display:none;" rev="flattr;button:compact;" href="http://github.com/jasny/bootstrap">Flattr</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <p class="footer">Page rendered in <strong>{{ $elapsed_time }}</strong> seconds. <?php echo (ENVIRONMENT === 'development') ? 'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
                        <p>Jasny Bootstrap is a fork of <a href="http://getbootstrap.com/" target="_blank">vanilla Bootstrap</a>. This fork is developed and maintained by <a href="http://twitter.com/ArnoldDaniels" target="_blank">Arnold Daniels</a>.</p>
                        <p>Code licensed under <a href="http://www.apache.org/licenses/LICENSE-2.0" target="_blank">Apache License v2.0</a>, documentation under <a href="http://creativecommons.org/licenses/by/3.0/">CC BY 3.0</a>.</p>
                        @section('footer_links')  
                        <ul class="footer-links">
                            <li>Currently v3.1.3</li>
                            <li class="muted">&middot;</li>
                            <li><a href="../2.3.1/index.html">Bootstrap 2.3.1 docs</a></li>
                            <li class="muted">&middot;</li>
                            <li><a href="http://www.jasny.net/">Jasny.net</a></li>
                            <li class="muted">&middot;</li>
                            <li><a href="https://github.com/jasny/bootstrap/issues?state=open">Issues</a></li>
                            <li class="muted">&middot;</li>
                            <li><a href="https://github.com/jasny/bootstrap/releases">Releases</a></li>
                        </ul>
                    </div>

                </div>

                @show
            </div>
        </footer>

        <!-- JS and analytics only. -->
        <!-- Bootstrap core JavaScript
    ================================================== -->

        <script src="{{ base_url('assets/js/jquery-1.10.2.min.js') }}"></script>
        <script src="{{ base_url('assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ base_url('assets/js/jasny-bootstrap.min.js') }}"></script>
        <!-- <script src="{{ base_url('assets/js/holder.min.js') }}"></script> -->

        @section('footer_extra')        
        @show
    </body>
</html>