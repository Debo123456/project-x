@extends('templates.default')

@section('css_link')
  <link rel="stylesheet" href="/css/themify/themify-icons.css" />
@endsection

@section('js_link')
  <script src="/js/simplegallery.min.js"></script>
@endsection

@if (!empty($car))
  @section('content')
    <div id="details_container" class="container col-12 col-sm-10 col-md-8">
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
