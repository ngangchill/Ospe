<!-- Bootstrap nav -->
<header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="{{ base_url() }}" class="navbar-brand">{{ $website->title }}</a>
        </div>
        <?php $auri = collect(ci()->uri->segment_array())->first();?>
        <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
            <ul class="nav navbar-nav">
                <li>
                    <a href="/blog">Blog</a>
                </li>
                <li{!! is_current('css') !!}>
                    <a href="index.html">CSS</a>
                </li>
                <li{!! is_current('learn') !!}>
                    <a href="/learn">Study</a>
                </li>
                <li>
                    <a href="../javascript/index.html">JavaScript</a>
                </li>
                <li>
                    <a href="../customize/index.html">Customize</a>
                </li>
                <li><a href="{{ site_url('admin/logger') }}">Logger</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="http://www.bootply.com" target="_ext"><i class="fa fa-1x fa-adn"></i>dsfd</a>
                </li>

                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="caret"></span> <i class="glyphicon glyphicon-user"></i> 
                        @if(ci()->ion_auth->logged_in())
                        {{ ci()->ion_auth->user()->row()->username }}
                        @else
                        Guest
                        @endif
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><span class="badge pull-right">40</span>Link</a></li>                    
                        <li><a href="#"><span class="badge pull-right">2</span>Link</a></li>
                        <li><a href="#"><span class="badge pull-right">0</span>Link</a></li>
                        <li><a href="#"><span class="label label-info pull-right">1</span>Link</a></li>
                        <li><a href="#"><span class="badge pull-right">13</span>Link</a></li>
                        <hr>
                        @if(!ci()->ion_auth->logged_in())
                        <li><a href="{{ site_url('logout') }}" role="button" data-toggle="modal"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                        @else    
                        <li><a href="{{ site_url('logout') }}" role="button"> <span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                        @endif
                    </ul>

                </li>

            </ul>
            <form class="navbar-form navbar-right" method="post" action="/search">
                <input type="text" name="query" class="form-control" placeholder="Search...">
            </form>
        </nav>
    </div>
</header>