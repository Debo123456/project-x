@extends('templates.default')

@section('og_tags')
<meta property="fb:app_id"             content="2200703713547941" />
<meta property="og:url"                content="{{ url()->full() }}" />
<meta property="og:type"               content="article" />
<meta property="og:title"              content="{{$car->make. ' '. $car->model}}" />
<meta property="og:description"        content="{{ $car->description }}" />
<meta property="og:image"              content="{{ Request::root().($images ? Storage::url($images[0]) : Storage::url('uploads/vehicles/no-image-available.png')) }}" />
@endsection

@section('css_link')
  <link rel="stylesheet" href="/css/themify/themify-icons.css" />
@endsection

@section('js_link')
  <script src="/js/simplegallery.min.js"></script>
@endsection

@section('fb_script')
  <!-- Load fb sdk for login and posting --!-->
  <div id="fb-root"></div>
  <script>
    window.fbAsyncInit = function() {
    FB.init({
      appId      : '2200703713547941',
      cookie     : true,
      xfbml      : true,
      version    : 'v3.1'
    });
      
    FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
    });   
      
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  function statusChangeCallback(response){
    if(response.status == 'connected'){
      console.log('Logged in and authenticated');
    } else {
      console.log('not authenticated');
    }
  }

  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }
  </script>
@endsection

@if (!empty($car))
  @section('content')
    <div id="details_container" class="container col-12 col-sm-10 col-md-8">
      <section class="image-section">
        <div id="gallery" class="simplegallery">

          <div class="gallery-images bg-dark" >
            @if ($images)
              @foreach ($images as $key => $image)

                @if (strpos($image, 'main') !== false)
                  <img id="image_{{ $key }}" class="img-fluid" src="{{ Storage::url($image) }}" alt="...">
                @else
                  <img id="image_{{ $key }}" class="img-fluid" src="{{ Storage::url($image) }}" style="display: none;" alt="...">
                @endif

              @endforeach
            @else
              <img class="img-responsive" src="{{ Storage::url('uploads/vehicles/no-image-available.png') }}" alt="...">
            @endif
          </div><br />

          <div class="thumbnail d-flex flex-wrap border">
            @if ($images)
              @foreach ($images as $key => $image)
                <div class="thumb bg-dark border d-flex align-items-center col-4 col-sm-3 col-md-2 p-1">
                  <a href="#" rel="{{ $key }}">
                    <img class="img-fluid" id="thumb_{{ $key }}" src="{{ Storage::url($image) }}">
                  </a>
                </div>
              @endforeach
            @else
              <div class="thumb-no-image bg-light border d-flex align-items-center col-4 col-sm-3 col-md-2 p-1">
                  <img class="img-fluid" src="{{ Storage::url('uploads/vehicles/no-image-available.png') }}">
              </div>
            @endif
          </div>
        </div>
      </section>

      <section class="description-section flex-column">
        <h3 class="text-primary" style="margin:0;">{{$car->make. ' '. $car->model}}</h3>
        <h4 class="price">
          <strong>
            ${{number_format((float)$car->price, 0, '.', ',') }}
          </strong>
        </h4>

        <div id="details_info_container" class="border d-flex flex-wrap p-3 justify-content-center">
            <ul id="details_info" class=" d-flex justify-content-center col-12 col-sm-6">
              <ul id="details_info_titles">
                <li><b>Make:</b>
                <li><b>Model:</b>
                <li><b>Year:</b>
                <li><b>Transmission:</b>
              </ul>
              <ul id="details_info_description">
                <li>{{ $car->make }}</li>
                <li>{{ $car->model }}</li>
                <li>{{ $car->year }}</li>
                <li>{{ $car->transmission }}</li>
              </ul>
            </ul>

            <ul id="details_info" class=" d-flex justify-content-center col-12 col-sm-6">
              <ul id="details_info_titles">
                <li><b>Seller:</b> </li>
                <li><b>Contact:</b> </li>
                <li><b>Location:</b> </li>
                <li><b>Body Type:</b> </li>
              </ul>
              <ul id="details_info_description">
                <li>{{ $car->seller }}</li>
                <li>{{ $car->contact }}</li>
                <li>{{ $car->location }}</li>
                <li>{{ $car->body_type }}</li>
              </ul>
            </ul>
          </div>

        <h3>Description</h3>
        <p>{{ $car->description }}</p>

      </section>
    </div>

    <div id="view-data" data-car-id="{{$car->id}}" data-user-id="{{(Auth::check() ? Auth::user()->id : '')}}" data-logged-in="{{Auth::check()}}"></div>
    @endsection
  @endif

  @section('scripts')
    <script>
      $(document).ready(function() {
        $('#gallery').simplegallery({
          galltime : 400, // transition delay
          gallcontent: '.gallery-images',
          gallthumbnail: '.thumbnail',
          gallthumb: '.thumb'
        });

        var guid = function(){
          function s4() {
            return Math.floor((1 + Math.random()) * 0x10000)
              .toString(16)
              .substring(1);
          }

          return s4() + s4() + '-' + s4() + '-' + s4() + '-' +
            s4() + '-' + s4() + s4() + s4();
        }

        var updateView = function(cid, uid, cookie, loggedIn){
          $.ajax({
            method: "GET",
            url: '/update-view',
            data: { car: cid, user: uid, cookie: cookie, is_logged_in: loggedIn }
          }).done(function(result){
            console.log(result);
          });
        }
        
        var car_id = $('#view-data').attr('data-car-id');
        var user_id = $('#view-data').attr('data-user-id');
        var loggedIn = $('#view-data').attr('data-logged-in');
        
        var setCookie = function(){
          //generate cookie expiration date
          var now = new Date();
          now.setTime(now.getTime() + 31536000000);

          //generate cookie value
          var cookie = guid();

          document.cookie = "asja_viewer_id =" + cookie + "; expires =" + now;

          return cookie;
        }

        var cookie = document.cookie.split('; ');
        var cookie = cookie.map(function(x){
          return x.split('=');
        }).filter(function(value, index){
          return value[0] == "asja_viewer_id";
        })[0];
        
        (cookie ? cookie = cookie[1] : cookie = setCookie());

        updateView(car_id, user_id, cookie, loggedIn);
    });

            </script>
  @endsection
