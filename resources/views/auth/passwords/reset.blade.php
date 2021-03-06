@extends('templates.default')

@section('content')
    <div class-"form_container form_auth">
        <form class="form col-10 col-sm-8 col-md-5 py-3" method="POST" action="{{ route('password.request') }}">
            <div class="heading">
              <h3>Reset Password</h3>
            </div>
            {{ csrf_field() }}
            <input type="hidden" name="token" value="{{ $token }}"/>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email">E-Mail Address</lab
                
                <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus/>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
                
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password">Password</label>
                
                <input id="password" type="password" class="form-control" name="password" required />
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
                
            </div>
            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <label for="password-confirm">Confirm Password</label>
                
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required />
                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
                
            </div>
            <div class="form-group">
                
                <button type="submit" class="btn btn-primary">
                    Reset Password
                </button>
               
            </div>
        </form>
    </div>            
@endsection
