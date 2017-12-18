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

    @if (!empty($cars))
      <div id="products" class="container">

          @foreach ($cars as $key => $car)
            <a href="{{ url('/'. str_replace(" ", "-", Auth::user()->name). "/".'view-car/'.$car->id) }}">
              <div class="home1-item  col-xs-6 col-sm-4 col-md-3 col-lg-2">
                <div class="home1-thumbnail">
                  @if (!empty(Storage::files('uploads/vehicles/'. $car->img .'/main')))
                    <div class="img-container" style="background-image:url('{{ Storage::url(Storage::files('uploads/vehicles/'. $car->img .'/main')[0]) }}');" alt="">
                    </div>
                  @else
                    <div class="img-container" style="background-image:url('{{ Storage::url('uploads/vehicles/no-image-available.png') }}');" alt="">
                    </div>
                  @endif

                    <ul class="item-info text-center">
                      <li>
                        <h5 class="item-name list-group-item-heading">{{ $car->make. ' ' . $car->model }}</h5>
                      </li>
                      <li>{{$car->year}} / {{$car->transmission}}</li>
                      <li>{{$car->location}}</li>
                      <li class="item-price">
                        <h4 class="price">
                          <strong>
                            ${{number_format((float)$car->price, 0, '.', ',') }}
                          </strong>
                        </h4>
                      </li>
                      <li class="flex-row" style="justify-content:center;">
                        <a class="btn btn-primary btn-sm"  style='margin-right: 10px;' href='{{ url('/'. str_replace(" ", "-", Auth::user()->name). "/".'update-car/'.$car->id) }}'>Update</a>
                        <button class="btn btn-danger btn-sm" data-toggle='modal' data-target='.delete-car-modal-{{$key}}'>Delete</button>
                      </li>
                    </ul>
                </div>
              </div>
            </a>

            <div class="modal fade delete-car-modal-{{$key}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
              <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">Warning!!</h4>
                  </div>
                  <div class="modal-body text-center">
                    <h3>Delete car?</h3>
                  </div>
                  <div class="modal-footer">
                    <div class="left-side">
                        <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Never mind</button>
                    </div>
                    <div class="divider"></div>
                    <div class="right-side">
                        <a href='{{ url('/'. str_replace(" ", "-", Auth::user()->name). "/".'delete-car/'.$car->id) }}' type="button" class="btn btn-danger btn-simple">Delete</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endforeach

          <div class="col-xs-12 flex flex-center">
            <?php echo $cars->render(); ?>
          </div>


    @endif
@endsection
