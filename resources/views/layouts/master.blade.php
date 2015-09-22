<html>
    <head>
        <link rel="stylesheet" href="{!! URL::to('/'); !!}/css/bootstrap.min.css">
        <link rel="stylesheet" href="{!! URL::to('/'); !!}/css/custom.css">
    </head>

    <body>
        <nav class="navbar navbar-default">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="{!! URL::to('/'); !!}">Laravel</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li class="active"><a href="#">One</a></li>
                <li><a href="#">Two</a></li>
                <li><a href="#">Three</a></li>
              </ul>
              @if (Session::has('_user'))
              <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Hello, {!! Session::get('_user'); !!}!</a></li>
                <li><a href="{!! URL::to('/auth/logout'); !!}">Signout</a></li>
              </ul>
              @endif
            </div><!--/.nav-collapse -->
          </div>
        </nav>
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

    <footer class="footer">
      <div class="container">
        <p class="text-muted">&copy; Copyright 2015</p>
      </div>
    </footer>
    <script type="text/javascript" charset="utf-8" async="" src="{!! URL::to('/'); !!}/js/bootstrap.min.js"></script>

    @yield('scripts')
</html>

