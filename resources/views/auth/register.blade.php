@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <form method="POST" action="{!! URL::to('/auth/register'); !!}" class="form-signin">
            {!! csrf_field() !!}
            <h2 class="form-signin-heading">Register</h2>
            <label for="inputEmail" class="sr-only">Email address</label>
                <input type="text" name="username" id="inputEmail" value="{!! old('username'); !!}" class="form-control" placeholder="Email address" autofocus>
            <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password">
            <div class="checkbox pull-right">
                Already have an account? Click <a href="{!! URL::to('/'); !!}">here</a>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
        </form>
    </div>

</div> <!-- /container -->
@endsection