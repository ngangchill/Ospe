<!DOCTYPE html>
<html lang="en">
    <head>
        @include('layouts.admin.components.head')
    </head>
    <body>
        @include('layouts.admin.components.nav')

        <!-- Main -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3">
                    <!-- Left column -->
                    <!--  sidebar -->
                    @section('sidebar')
                        @include('layouts.admin.components.sidebar')
                    @show
                </div>
                <!-- /col-3 -->
                <div class="col-sm-9">
                    <!-- content -->
                    @yield('content')
                </div>
                <!--/col-span-9-->
            </div>
        </div>
        <!-- /Main -->
        @include('layouts.admin.components.footer')