@extends('templates.default')

<!-- Main Content -->
@section('content')
    <div class="form_container form-contact flex-column">

        <div class=" col-10 col-sm-8 col-md-5">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form class="form p-3" role="form" method="POST" action="{{ url('/password/email') }}">

                <div class="heading">
                    <h3>Reset Password</h3>
                </div>

                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">E-Mail Address</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required />

                    @if ($errors->has('email'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('email') }}</strong>
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
    </div>
@endsection
