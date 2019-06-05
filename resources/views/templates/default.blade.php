<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @yield('og_tags')

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <link rel="icon" href="favicon.ico" type="image/x-icon">

  <!-- Styles -->
  <link href="/css/app.css" type="text/css" rel="stylesheet"/>
  <link rel="stylesheet" href="/css/themify/themify-icons.css" />
  @yield('css_link')

  <!-- Scripts -->
  <script src="/js/app.js"></script>
  @yield('js_link')

</head>

<body data-spy="scroll" data-target=".navbar" data-offset="50">

  @yield('fb_script')

  <div class="d-flex flex-column justify-content-between position-relative wrapper">

        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-1 px-4">
          <a class="navbar-brand text-light" href="{{ url('/') }}">
            <!--{{ config('app.name', 'AutoSalesJa') }}-->
            <img src="http://autosalesja.test/img/logo/autosalesja_logo_white.png"  width="120px" height="50px" />
          </a>


          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form class="form-inline mr-auto ml-auto py-2 py-md-0 my-0 col-8 col-md-4" action="/search" method="get">
              <input class="form-control form-control-sm rounded-0 border-0 col-8" type="search" name="q" placeholder="Search" aria-label="Search">
              <button class="btn btn-sm btn-light ti-search rounded-0 border-0" type="submit"></button>
            </form>
            
            <ul class="navbar-nav text-light">
              <li class="nav-item">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/upload') }}">Advertise</a>
              </li>
              <li class="nav-item">
              <fb:login-button 
                scope="public_profile,email"
                onlogin="checkLoginState();">
              </fb:login-button>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/contact') }}">Contact</a>
              </li>
              @if (Auth::guest())
                <li class="nav-item">
                  <a class="nav-link" href="{{ url('/login') }}">Login</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ url('/register') }}">Register</a>
                </li>
              @else
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ url('/'. str_replace(" ", "-", Auth::user()->name) .'/my-cars') }}">Dashboard</a>
                  <a class="dropdown-item" href="{{ url('/upload') }}">Upload</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="{{ url('/logout') }}" 
                      onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                              Logout
                  </a>
                  <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                  </form>
                </div>
              </li>
              @endif
            </ul>
          </div>
        </nav>

        <nav class="navbar navbar-expand-lg navbar-light bg-light p-0">
          <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'AutoSalesJa') }}
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/upload') }}">Advertise</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/contact') }}">Contact</a>
              </li>
              @if (Auth::guest())
                <li class="nav-item">
                  <a class="nav-link" href="{{ url('/login') }}">Login</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ url('/register') }}">Register</a>
                </li>
              @else
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ url('/'. str_replace(" ", "-", Auth::user()->name) .'/my-cars') }}">My Cars</a>
                  <a class="dropdown-item" href="{{ url('/upload') }}">Upload</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="{{ url('/logout') }}" 
                      onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                              Logout
                  </a>
                  <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                  </form>
                </div>
              </li>
              @endif
            </ul>
            <form class="form-inline my-2 my-lg-0">
              <input class="form-control mr-sm-2" type="search" placeholder="Search" name="q" aria-label="Search">
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
          </div>
        </nav>

      @yield('banner')

      @yield('search_bar')
      @yield('flash')

      <div id="main" class="main d-flex"  style="background: url('http://autosalesja.test/img/inspiration-geometry.png');">
        @yield('filter_bar')
        @yield('content')
      </div>
      @extends('templates.toast')
    

    <footer class="w-100 text-white py-2">
      <p>AutoJa Inc 2016</p>
      <p><a href="#">Terms and Agreements</a> &#8226; <a href="#">Privacy Policy</a></p>
      <p>Copyright &copy; 2016 AutoJa. Inc.</p>
      <div class="fb-login-button" data-max-rows="1" data-size="medium" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false">test FB</div>
    </footer>

  </div>
</body>
<script>
$(".nav-wrapper").height(90);

var toast = {
  toastr: function(cls, message) {
    // Get the toast DIV
    var x = document.getElementById("toast");

    //Add message to toast
    x.innerHTML = message;

    // Add the "show" class to DIV
    x.className = "show " + cls;

    // After 3 seconds, remove the show class and message text from DIV
    setTimeout(function(){
      x.className = x.className.replace("show " + cls, "");
      x.innerHtml = '';
    }, 3000);
  },
  success: function(msg) { this.toastr('alert-success', msg); },
  warning: function(msg) { this.toastr('alert-warning', msg); },
  error: function(msg) { this.toastr('alert-danger', msg); },
  info: function(msg) { this.toastr('alert-info', msg); }
};
</script>

@yield('scripts')

</html>
