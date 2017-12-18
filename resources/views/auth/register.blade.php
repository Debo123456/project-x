@extends('templates.default')

@section('content')
<div class="form_container">
                    <form class="form col-xs-12 col-sm-8 col-md-5" method="POST" action="{{ url('/register') }}">


                        <div class="heading">
                          <h3>Register</h3>
                        </div>

                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" >Name</label>

                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email">E-Mail Address</label>

                                <input id="email" type="email" class="form-control input-sm" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password">Password</label>

                                <input id="password" type="password" class="form-control input-sm" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group">
                            <label for="password-confirm">Confirm Password</label>

                                <input id="password-confirm" type="password" class="form-control input-sm" name="password_confirmation" required>

                        </div>

                        <div class="form-group">
                                <button type="submit" class="form-control btn-primary">
                                    Register
                                </button>
                        </div>
                    </form>
</div>
@endsection
