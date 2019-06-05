@extends('templates.default')

@section('js_link')
  <script src="/js/simplegallery.min.js"></script>
@endsection

@section('css_link')
  <link rel="stylesheet" href="/css/themify/themify-icons.css" />
@endsection

@section('flash')
  @if ( session('status'))
    <div class="form-group-sm alert alert-success">
      <strong>Success!</strong> {{ session('status')}} .
    </div>
  @elseif (session('error'))
    <div class="form-group-sm alert alert-warning">
      <strong>Warning!</strong> {{session('error')}}.
    </div>
  @endif
@endsection

@if (!empty($car))
  @section('content')
    
    <div id="details_container py-5" class="d-flex flex-wrap justify-content-center w-100 border-top py-5">
      <section class="image-section col-12 col-md-8">

        <div id="gallery" class="simplegallery">

          <div class="gallery-images bg-dark" >
            @if ($images)
              @php $has_display = false; @endphp
              @foreach ($images as $key => $image)

                @if (strpos($image, 'main') !== false)
                  <img id="image_{{ $key }}" class="img-fluid" src="{{ Storage::url($image) }}" alt="...">
                  @php $has_display = true @endphp
                @else
                  <img id="image_{{ $key }}" class="img-fluid" src="{{ Storage::url($image) }}" style="display: none;" alt="...">
                @endif

              @endforeach
                @if (!$has_display)
                  <img class="img-fluid" src="{{ Storage::url('uploads/vehicles/no-image-available.png') }}" alt="...">
                @endif
            @else
              <img class="img-fluid" src="{{ Storage::url('uploads/vehicles/no-image-available.png') }}" alt="...">
            @endif
          </div><br />

          <div class="thumbnail d-flex flex-wrap p-2 border">
            @if ($images)
              @foreach ($images as $key => $image)
                <div class="thumb d-flex align-items-center col-4 col-sm-3 col-md-2 p-0">
                  <span id="{{ url('/'. str_replace(" ", "-", Auth::user()->name)). "|". $car->id ."|". $image}}" class="settings-thumb" data-toggle='modal' data-target='image-settings-modal'>
                    <i class="ti-settings"></i>
                  </span>

                  <a class="thumb-link" href="#" rel="{{ $key }}">
                    <img class="img-fluid" id="thumb_{{ $key }}" src="{{ Storage::url($image) }}">
                  </a>
                </div>

              @endforeach
            @else
              <div class="thumb-no-image">
                  <img class="img-fluid" src="{{ Storage::url('uploads/vehicles/no-image-available.png') }}">
              </div>
            @endif
          </div>

          <!-- dELETE iMAGE MODAL -->
          <div id="delete-image-modal" class="modal fade delete-image-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="gridSystemModalLabel">Warning!!</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <h5>Are you sure?</h5>
                </div>
                <div class="modal-footer p-2 d-flex justify-content-between">
                  <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Nevermind</button>
                  <button id='delete-image' type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Delete</button>                
                </div>
              </div>
            </div>
          </div>

          <!-- Settings iMAGE MODAL -->
          <div id="image-settings-modal" class="modal fade image-settings-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="gridSystemModalLabel">Image Settings!!</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <!--<div class="modal-body">
                  <h5>Delete image?</h5>
                </div>-->
                <div class="modal-footer p-2 d-flex justify-content-between">
                  <div class="left-side">
                    <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button>
                  </div>
                  <button id='set-display' type="button" class="btn btn-default btn-lg" data-dismiss="modal">Set as display</button>
                  
                  <div class="right-side">
                    <button id='delete-image' type="button" class="btn btn-danger  btn-lg remove-image" >Delete</button>
                  </div>
                </div>
              </div>
            </div>
          </div>


          <form id="image-upload-form" action="{{ url('/'. str_replace(" ", "-", Auth::user()->name). "/".'update-images/'.$car->id) }}"
                method="post" class="flex-column" enctype="multipart/form-data">
                <div class="thumbnail thumb-uploads d-flex">

                </div>
                <div class="add-upload-container d-flex">
                  <div class="file-add form-control btn-primary text-center" >
                    <input type="file" class="file-input" name="images[]" accept=".jpg, .jpeg, .png" multiple>
                    Add Images <i class="ti-plus"></i>
                  </div>
                  <button type="submit" class="form-control btn-primary text-center file-upload">
                    Upload <i class="ti-upload"></i>
                  </button>
                </div>
                {{ csrf_field() }}
          </form>
        </div>
      </section>

      <section class="description-section flex-column col-12 col-md-8">
        <h3 class="text-primary" style="margin:0;">{{$car->make. ' '. $car->model}}</h3>
        <h4 class="price">
          <strong>
            ${{number_format((float)$car->price, 0, '.', ',') }}
          </strong>
        </h4>

        <div id="details_info_container" class="border d-flex flex-wrap p-3 justify-content-center">
            <ul id="details_info" class="d-flex justify-content-center col-12 col-sm-6">
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

            <ul id="details_info" class="d-flex justify-content-center col-12 col-sm-6">
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

@extends('templates.loading')


@section('scripts')
  <script>

  //Initialize image gallery(simplegallery)
  $('#gallery').simplegallery({
    galltime : 400, // transition delay
    gallcontent: '.gallery-images',
    gallthumbnail: '.thumbnail',
    gallthumb: '.thumb-link'
  }
);

//Image upload function
var uploadInput = function(fileInput) {
  var countFiles = fileInput[0].files.length;
  var mimeTypes = ['png', 'jpg', 'jpeg'];

  for (var i = 0; i < countFiles; i++) {
    var path = fileInput[0].files[i].name;
    var extn = path.substring(path.lastIndexOf('.') + 1).toLowerCase();

    if (!mimeTypes.includes(extn)) {
      toast.error('Only images should be selected');
      fileInput[0].value = "";
      break;
    }
    if(fileInput[0].files[i].size > 5242880){
      toast.error( fileInput[0].files[i].name + " is too large("+(fileInput[0].files[i].size/1048576).toFixed(2)+"Mb). Max size = 5Mb");
      fileInput[0].value = "";
      break;
    }
  }

  if(countFiles > (8 - $('.thumb').length)) {
    toast.warning("Warning!, Maximum of 8 images allowed");
    fileInput[0].value = "";
    return;
  }
  else if(fileInput[0].value !== ""){
    var image_holder = $(".thumb-uploads");
    var images =[ ];
    var imgPath = fileInput[0].value;
    var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();

    if (mimeTypes.includes(extn)) {
      if (typeof (FileReader) != "undefined") {

        for (var i = 0; i < countFiles; i++) {
          
          var reader = new FileReader();
          reader.onload = function(e) {
            image_holder.prepend(
              $("<div />", {"class": "thumb"}).append(
                $("<img />", {"src": e.target.result}),
                $("<span />", {"class": "remove-thumb"}).append(
                  $("<i />", {"class": "ti-close"})
                )
              )
            );
          }
          reader.readAsDataURL(fileInput[0].files[i]);
          }
        }
      } else {
        toast.error("File extension not supports");
      }
    } else {
      toast.error("Select Only images");
    }
  }
}

//File-type input button click event
$(".file-input").on('change', function () {

  uploadInput($(this));
  setTimeout(function() {
    $(".remove-thumb").on("click", function(e) {
      e.preventDefault();
      $(this).parent().remove();
    });
  }, 1000);
});


//File upload button click event
$(".file-upload").on('click', function (e) {
  e.preventDefault();
  if($(".file-input")[0].files.length == 0) {
    toast.warning('Warning!, No images selected.')
  } else {
    $('#loading').modal('show');
    $("#image-upload-form").submit();
  }
});

//Image object handle ajax calls for deleting image and changing display image
var image = {
  source: null,
  data: [],
  delete: function() {
    $('#loading').modal('show');
    $.ajax({
      method: "GET",
      url: this.data[0] + "/delete-image/" + this.data[1] + "?img=" + this.data[2]
    })
    .done(function( result ) {
      $('#loading').modal('hide');
      if(result == 1) {
        image.source.parent().remove();
        toast.success('Success!, Image deleted.');
      }
      else {
        toast.error("Error!, There was an error deleting the file, try again later.");
      }

    });
  },
  makeDisplay: function() {
    $('#loading').modal('show');
    $.ajax({
      method: "GET",
      url: this.data[0] + "/set-display-image/" + this.data[1] + "?img=" + this.data[2]
      //data: { name: "John", location: "Boston" }
    })
    .done(function( result ) {
      if(result == 0) {
        $('#loading').modal('hide');
        toast.error("Error!, There was an error setting display image.");
      }
      else {
        $('#loading').modal('hide');
        toast.success("Success!, Display image changed.");
      }

    });
  }
};

//Imagesettings button click event handler
$(".settings-thumb").on('click', function() {

  image.source = $(this);
  image.data = image.source.attr('id').split("|");
  $('#image-settings-modal').modal('show');

})

//remove image button click event handler
$('.remove-image').on('click', function() {
  $('#image-settings-modal').modal('hide');
  $('#delete-image-modal').modal('show');
});


//set display button event handler
$('#set-display').on('click', function() {
  image.makeDisplay();
});

//Delete image button event handler
$("#delete-image").on('click', function() {
  image.delete();
});



</script>
@endsection
