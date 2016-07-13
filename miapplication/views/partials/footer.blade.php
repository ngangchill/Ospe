    <footer id="footer" class="midnight-blue">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    &copy; 2016 {{ $siteName or 'Forhad' }} . All Rights Reserved.
                </div>
                <div class="col-sm-6">
                    <ul class="pull-right">
                        <li><a href="{{ base_url(Route::named('home')) }}">Home</a></li>
                        <li><a href="{{ base_url(Route::named('aboutUs')) }}">About Us</a></li>
                        <li><a href="{{ base_url(Route::named('faq')) }}">Faq</a></li>
                        <li><a href="{{ base_url(Route::named('contactUs')) }}">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer><!--/#footer-->

    <script src="{{ base_url() }}assets/default/js/jquery.js"></script>
    <script src="{{ base_url() }}assets/default/js/bootstrap.min.js"></script>
    <script src="{{ base_url() }}assets/default/js/jquery.prettyPhoto.js"></script>
    <script src="{{ base_url() }}assets/default/js/jquery.isotope.min.js"></script>
    <script src="{{ base_url() }}assets/default/js/main.js"></script>
    <script src="{{ base_url() }}assets/default/js/wow.min.js"></script>
    @section('footer')
    @show
</body>
</html>