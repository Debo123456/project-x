@extends('templates.default')

@section('content')
    <div class="form_container  form-auth">
        <form class="form col-10 col-sm-8 col-md-5 py-3" method="POST" action="{{ route('login') }}">
            <div class="heading">
              <h3>Login</h3>
            </div>
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email">E-Mail Address</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                @if ($errors->has('email'))
                    <span class="help-block text-danger">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password">Password</label>
                <input id="password" type="password" class="form-control" name="password" required>
                @if ($errors->has('password'))
                    <span class="help-block text-danger">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                    </label>
                </div>
            </div>
            <div class="form-group d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">
                    Login
                </button>
                <span>Not a user?, 
                    <a class="btn btn-link p-0" href="{{ url('/register') }}">
                        register here.
                    </a>
                </span>
            </div>
            <a class="btn btn-link" href="{{ route('password.request') }}">
                Forgot Your Password?
            </a>
        </form>
    </div>   
@endsection
