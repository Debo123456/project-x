@extends('templates.default')

@section('flash')
  @if ( session('success'))
    <div class="form-group-sm alert alert-success">
      <strong>Success!</strong> {{ session('success')}} .
    </div>
  @elseif (session('error'))
    <div class="form-group-sm alert alert-warning">
      <strong>Ooops!</strong> {{ session('error')}} .
    </div>
  @endif
@endsection

@section('content')
<div class="d-flex flex-column">
  <div class="container d-flex justify-content-between p-3">
    <div class="d-flex flex-column align-items-center justify-content-center">
      <h1><span class="ti-user border rounded-circle p-3"></span></h1>
    </div>
    
    <div class="d-flex flex-column align-items-center justify-content-center">
      <h3><span class="font-weight-bold">{{Auth::user()->name}}</span></h3>
      <span>{{Auth::user()->email}}</span>
    </div>
  </div>
  <!-- Secondary Navigation -->
  <ul class="nav justify-content-center border p-1 bg-light">
    <div class="btn-group btn-group-toggle" data-toggle="buttons">
      <label class="btn btn-info active">
        <a class="text-white">
          <input type="radio" name="options" id="option1" autocomplete="off"><span class="ti-car"></span> <small class="">My Vehicles</small> 
        </a>
      </label>
      <label class="btn btn-info">
        <a class="text-white" href="">
          <input type="radio" name="options" id="option2" autocomplete="off"><span class="ti-comment"></span> <small>Messages</small>  
        </a>
      </label>
      <label class="btn btn-info">
        <a class="text-white" href="#" data-toggle="modal" data-target="#contactModal">
          <input type="radio" name="options" id="option3" autocomplete="off"><span class="ti-bell"></span> <small>Notifications</small> 
        </a>
      </label>
    </div>
  </ul>
  @if ($cars)
    <div id="products" class="container col-10 d-flex flex-wrap justify-content-center">
      @foreach ($cars as $key => $car)
      
			  <div class="home1-item p-2">
          <div class="home1-thumbnail">
          <a href='{{ url('/'. str_replace(" ", "-", Auth::user()->name). "/".'view-car/'.$car->id) }}'>
            @if (!empty(Storage::files('public/uploads/vehicles/'. $car->img .'/main')))
              <div class="img-container" style="background-image:url('{{ Storage::url(Storage::files('public/uploads/vehicles/'. $car->img .'/main')[0]) }}');">
                <!--<img class="group list-group-image" src="" alt="" />-->
              </div>
            @else
              <div class="img-container" style="background-image:url('{{ Storage::url('public/uploads/vehicles/no-image-available.png') }}');">
                <!--<img class="group list-group-image" src="" alt="" />-->
              </div>
            @endif
            <ul class="item-info text-center">
              <li>
                <h6 class="item-name list-group-item-heading">      {{ $car->make. ' ' . $car->model }}     </h6>
              </li>
              <li>{{$car->year}} / {{$car->transmission}}</li>
			  			<li>{{$car->location }}</li>
			  		  <li class="text-info text-uppercase"><strong>{{$car->condition}}</strong></li>
              <li class="item-price ">
                <h6 class="price" >
                  <strong>
                    ${{number_format((float)$car->price, 0, '.', ',') }}
                  </strong>
                </h6>
              </li>
            </ul>
            </a>
            <div class="d-flex justify-content-between pb-2 px-3">
              <a class="btn btn-primary btn-sm update-btn" href='{{ url('/'. str_replace(" ", "-", Auth::user()->name). "/".'update-car/'.$car->id) }}'>Update</a>
              <button class="btn btn-danger btn-sm" data-toggle='modal' data-target='.delete-car-modal-{{$key}}'>Delete</button>
            </div>
          </div>
        </div>
      
      
        <div class="modal fade delete-car-modal-{{$key}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
          <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title text-warning" id="gridSystemModalLabel">Warning!!</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body text-center">
                <h3>Delete car?</h3>
              </div>
              <div class="modal-footer d-flex justify-content-between p-2">
                <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Never mind</button>
                <a href='{{ url('/'. str_replace(" ", "-", Auth::user()->name). "/".'delete-car/'.$car->id) }}' type="button" class="btn btn-danger btn-lg">Delete</a>         
              </div>
            </div>
          </div>
        </div>
      @endforeach
      <div class="col-xs-12 flex flex-center">
        <?php echo $cars->render(); ?>
      </div>
    </div>
  @endif
</div>
@endsection


