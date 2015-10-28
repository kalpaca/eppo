<!-- Stored in resources/views/layouts/master.blade.php -->
<html>
    <head>
        <title>ePPO - @yield('title')</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        {!! Html::style('css/bootstrap.paper.min.css') !!}
        {!! Html::script('bower_components/bootstrap.paper.min.css') !!}
        <!-- ES5, Html5 shim and Respond.js IE8 support of Html5 elements and media queries -->
        {!! Html::script('bower_components/es5-shim/es5-shim.min.js')!!}
        {!! Html::script('bower_components/es5-shim/es5-sham.min.js') !!}
        {!! Html::script('bower_components/console-polyfill/index.js') !!}
        {!! Html::script('bower_components/html5shiv/dist/html5shiv.js') !!}
        {!! Html::script('bower_components/respond/dest/respond.min.js') !!}

        <!-- Jquery and bootstrap -->
        {!! Html::script('bower_components/jquery/dist/jquery.min.js') !!}
        {!! Html::script('bower_components/bootstrap/dist/js/bootstrap.min.js')!!}
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