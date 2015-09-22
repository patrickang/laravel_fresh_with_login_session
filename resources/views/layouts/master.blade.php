<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    </head>

    <body>

        @if ($errors->all())
            <div class="container">
                <div class="row">
                    <div class="alert alert-danger" role="alert">
                        @foreach ($errors->all() as $error)
                            <p>{!! $error !!}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        @yield('content')
    </body>
    <script type="text/javascript" charset="utf-8" async="" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</html>

