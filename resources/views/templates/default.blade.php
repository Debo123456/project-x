<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Styles -->
  <link href="/css/app.css" type="text/css" rel="stylesheet"/>
  @yield('css_link')

  <!-- Scripts -->
  <script src="/js/app.js"></script>
  @yield('js_link')

</head>

<body data-spy="scroll" data-target=".navbar" data-offset="50">
  <div class="wrapper">


    <div class="content">

      <div class="nav-wrapper">
        <nav id="header" class="navbar navbar-default" data-spy="affix" data-offset-top="5">
            <div id="header-container" class="container-fluid">
                <div class="navbar-header">

                  <!-- Branding Image -->
                  <a id="brand" class="navbar-brand" href="{{ url('/') }}">
                      {{ config('app.name', 'AutoSalesJa') }}
                  </a>


                    <!-- Collapsed Hamburger -->
                    <button id="navtoggle" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul id="nav-link" class="nav navbar-nav navbar-right">
                      <li><a href="{{ url('/upload') }}">Advertise vehicle</a></li>
                      <li><a href="{{ url('/contact') }}">Contact</a></li>
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}"><span class="primary-color">Login</span></a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                  <li><a href="{{ url('/'. str_replace(" ", "-", Auth::user()->name) .'/my-cars') }}">My Cars</a></li>
                                  <li><a href="{{ url('/upload') }}">Upload</a></li>
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
      </div>

      @yield('banner')

      @yield('search_bar')
      @yield('flash')

      <div id="main">
        @yield('filter_bar')
        @yield('content')
      </div>
      @extends('templates.toast')
    </div>

    <footer>
      <p>AutoJa Inc 2016</p>
      <p><a href="#">Terms and Agreements</a> &#8226; <a href="#">Privacy Policy</a></p>
      <p>Copyright &copy; 2016 AutoJa. Inc.</p>
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
