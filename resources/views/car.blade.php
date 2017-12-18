@extends('templates.default')

@section('css_link')
  <link rel="stylesheet" href="/css/themify/themify-icons.css" />
@endsection

@section('js_link')
  <script src="/js/simplegallery.min.js"></script>
@endsection

@section('search_bar')
  <div id="search-container">
    <form action="/search" name="search" method="get" id="main_search">
      <input type="search" name="q" id="search_bar">
      <button type="submit" value="Search" id="search_button"><span class="ti-search"></span></button>
    </form>
  </div>
@endsection

@if (!empty($car))
  @section('content')
    <div id="details_container">
      <section class="image-section">
        <div id="gallery" class="simplegallery">

          <div class="gallery-images" >
            @if ($images)
              @foreach ($images as $key => $image)

                @if (strpos($image, 'main') !== false)
                  <img id="image_{{ $key }}" class="img-responsive" src="{{ Storage::url($image) }}" alt="...">
                @else
                  <img id="image_{{ $key }}" class="img-responsive" src="{{ Storage::url($image) }}" style="display: none;" alt="...">
                @endif

              @endforeach
            @else
              <img class="img-responsive" src="{{ Storage::url('uploads/vehicles/no-image-available.png') }}" alt="...">
            @endif
          </div><br />

          <div class="thumbnail flex-row">
            @if ($images)
              @foreach ($images as $key => $image)
                <div class="thumb">
                  <a href="#" rel="{{ $key }}">
                    <img id="thumb_{{ $key }}" src="{{ Storage::url($image) }}">
                  </a>
                </div>
              @endforeach
            @else
              <div class="thumb-no-image">
                  <img src="{{ Storage::url('uploads/vehicles/no-image-available.png') }}">
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

        <div id="details_info_container">
            <ul id="details_info">
              <ul id="details_info_titles">
                <li><b>Make:</b>
                <li><b>Model:</b>
                <li><b>Year:</b>
                <li><b>Transmission:</b>
                <li class="visible-xs"><b>Seller:</b> </li>
                <li class="visible-xs"><b>Contact:</b> </li>
                <li class="visible-xs"><b>Location:</b> </li>
                <li class="visible-xs"><b>Body type:</b> </li>
              </ul>
              <ul id="details_info_description">
                <li>{{ $car->make }}</li>
                <li>{{ $car->model }}</li>
                <li>{{ $car->year }}</li>
                <li>{{ $car->transmission }}</li>
                <li class="visible-xs">{{ $car->seller }}</li>
                <li class="visible-xs">{{ $car->contact }}</li>
                <li class="visible-xs">{{ $car->location }}</li>
                <li class="visible-xs">{{ $car->body_type }}</li>
              </ul>
            </ul>

            <ul id="details_info" class="hidden-xs">
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
        }
      );
    });

            </script>
  @endsection
