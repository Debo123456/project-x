@extends('templates.default')

@section('content')
  <div class="form_container form-contact">
    <form class="form col-10 col-sm-8 col-md-5 py-3" method="post">

      <div class="heading">
        <h3>Contact Us!</h3>
      </div>

      @if ( session('status'))
        <div class="form-group-sm alert alert-success">
          <strong>Success!</strong> {{ session('status')}} .
        </div>
      @elseif (count($errors))
        <div class="form-group-sm alert alert-danger">
          <strong>Ooops!</strong> Seems like there was an error.
        </div>
      @else
        <p style="text-align:center;">We'd love to hear from you.</p>
      @endif

      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control input-sm" id="name" name="name" value="{{ old('name') }}" placeholder="Name" required="true" autofocus="true">

        @if ($errors->has('name'))
            <span class="help-block text-danger">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
      </div>

      <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control input-sm" id="email" name="email" value="{{ old('email') }}" placeholder="Email">

        @if ($errors->has('email'))
            <span class="help-block text-danger">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
      </div>

      <div class="form-group">
        <label for="message">Message</label>
        <textarea class="form-control input-sm" id="message" rows="3" name="message" value="{{ old('message') }}"></textarea>

        @if ($errors->has('message'))
            <span class="help-block text-danger">
                <strong>{{ $errors->first('message') }}</strong>
            </span>
        @endif
      </div>

      <div class="form-group">
        <input id="submit" class="form-control btn-primary" type="submit" value="Send">
      </div>
      {{ csrf_field() }}
    </form>
  </div>
@endsection
