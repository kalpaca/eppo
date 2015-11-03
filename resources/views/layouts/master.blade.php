<!DOCTYPE html>
<html>
    <head>
        <title>ePPO - @yield('title')</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/eppo.css') }}" rel="stylesheet" type="text/css" />
        <script src="{{ asset('js/modernizr.mq.min.js') }}"></script>
        <script>
        /* ES5, Html5 shim and Respond.js IE8 support of Html5 elements and media queries */
            yepnope({
                test: Modernizr.mq('only all'),
                nope: [
                    "{{ asset('bower_components/es5-shim/es5-shim.min.js') }}",
                    "{{ asset('bower_components/es5-shim/es5-sham.min.js') }}",
                    "{{ asset('bower_components/console-polyfill/index.js') }}",
                    "{{ asset('bower_components/html5shiv/dist/html5shiv.js') }}",
                    "{{ asset('bower_components/respond/dest/respond.min.js') }}",
                    "{{ asset('js/selectivizr.min.js') }}"
                    ],
                both: ["{{ asset('bower_components/jquery/dist/jquery.min.js')}}",
                    "{{ asset('js/bootstrap.min.js') }}",
                    "{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}",
                    "{{ asset('js/jquery.shuffle.modernizr.min.js') }}",
                    "{{ asset('js/ppoExplorer.js') }}",
                    "{{ asset('js/ppoHelper.js') }}"
                    ]
            });
        </script>
    </head>
    <body>
        @include('partials.navbar')
        <div class="container">
            @include('partials.errors')
            @include('partials.session_message')
            @yield('content')
        </div>
    </body>
</html>