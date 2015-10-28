<!-- Stored in resources/views/layouts/master.blade.php -->
<html>
    <head>
        <title>ePPO - @yield('title')</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link href="{{ asset('css/bootstrap.paper.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/eppo.css') }}" rel="stylesheet" type="text/css" />
        <!-- ES5, Html5 shim and Respond.js IE8 support of Html5 elements and media queries -->
        <script src="{{ asset('bower_components/es5-shim/es5-shim.min.js') }}"></script>
        <script src="{{ asset('bower_components/es5-shim/es5-sham.min.js') }}"></script>
        <script src="{{ asset('bower_components/console-polyfill/index.js') }}"></script>
        <script src="{{ asset('bower_components/html5shiv/dist/html5shiv.js') }}"></script>
        <script src="{{ asset('bower_components/respond/dest/respond.min.js') }}"></script>
        <!-- Jquery and bootstrap -->
        <script src="{{ asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
        <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    </head>
    <body>
        @include('partials.navbar')
        <div class="container">
            @include('partials.errors')
            @if (Session::has('success-message'))
            <div class="alert alert-success">
                <p>{{ Session::get('success-message') }}</p>
            </div>
            @endif
            @if (Session::has('warning-message'))
            <div class="alert alert-warning">
                <p>{{ Session::get('warning-message') }}</p>
            </div>
            @endif
            @yield('content')
        </div>
    </body>
</html>