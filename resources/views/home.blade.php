@extends('templates.default')

@section('banner')
  <div class="banner">
    <div class="banner-title">
      <h1> AutoSalesJa.com </h1>
      <p>Find the best <span class="primary-color">deals</span> on cars for sale in <span class="primary-color">Jamaica</span.</p>
    </div>
  </div>
@endsection

@section('flash')
  @if (session('error'))
    <div class="text-center form-group-sm alert alert-warning">
      <strong>Warning!</strong> {{session('error')}}.
    </div>
  @endif
@endsection

@section('filter_bar')

    <div  class="filter-bar col-lg-2 p-0 pt-md-5">

      <form class="filter p-1" action="/filter-search" method="get">

				<div class="icon-container close-filter d-block d-lg-none">
        	<span class="ti-close"></span>
      	</div>

        <h2 class="text-center primary-color">Filter</h2>

        <div class="filter-item">
          <li>
            <strong>Make</strong><br>
            <select name="make" id="make" class="form-control form-control-sm" data-toggle="tooltip" data-placement="bottom" title="Filter vehicles by manufacturer">
              <option>Any</option>
              <option>Acura</option>
              <option>Audi</option>
              <option>BMW</option>
              <option>Cadillac</option>
              <option>Chevrolet</option>
              <option>Chrysler</option>
              <option>Daewoo</option>
              <option>Daihatsu</option>
              <option>Ford</option>
              <option>Honda</option>
              <option>Hyundai</option>
              <option>Infiniti</option>
              <option>Jaguar</option>
              <option>Jeep</option>
              <option>Kia Motors</option>
              <option>Land Rover</option>
              <option>Lexus</option>
              <option>Mazda</option>
              <option>Mercedes</option>
              <option>Mitsubishi</option>
              <option>Nissan</option>
              <option>Subaru</option>
              <option>Suzuki</option>
              <option>Toyota</option>
              <option>Volkswagen</option>
              <option>Volvo</option>
              <option>Yamaha</option>
            </select>
          </li>
          <li>
            <strong>Model</strong><br>
            <select name="model" id="model" class="form-control form-control-sm" data-toggle="tooltip" data-placement="bottom" title="Filter vehicles by model.....Choose a make first.">
              <option>Any</option>
            </select>
          </li>
        </div>

        <div class="filter-item">
          <li>
            <strong>Price:</strong>
						<div class="form-check">
						  <input class="price-filters" type="radio" name="price-radio" id="exampleRadios1" value="Any" checked>
						  <label class="form-check-label" for="exampleRadios1">
						    Any
						  </label>
						</div>
						<div class="form-check">
						  <input class="price-filters" type="radio" name="price-radio" id="exampleRadios2" value="500000">
						  <label class="form-check-label" for="exampleRadios2">
								$500k and below
						  </label>
						</div>
						<div class="form-check">
						  <input class="price-filters" type="radio" name="price-radio" id="exampleRadios3" value="1000000">
						  <label class="form-check-label" for="exampleRadios3">
								$500k - $1m
						  </label>
						</div>
						<div class="form-check">
						  <input class="price-filters" type="radio" name="price-radio" id="exampleRadios4" value="5000000">
						  <label class="form-check-label" for="exampleRadios4">
								$1m - $5m
						  </label>
						</div>
						<div class="form-check">
						  <input class="price-filters" type="radio" name="price-radio" id="exampleRadios5" value="5000000+">
						  <label class="form-check-label" for="exampleRadios5">
								$5m and above
						  </label>
						</div>
          </li>
        </div>

        <div class="filter-item">
          <li>
            <strong>Min-Year</strong><br>
            <select name="min_year" id="min_year" class="form-control form-control-sm" data-toggle="tooltip" data-placement="bottom" title="Minimum vehicle year">
              <option>Any</option>
              <option>1970</option>
              <option>1980</option>
              <option>1990</option>
              <option>1995</option>
              <option>2000</option>
              <option>2005</option>
              <option>2010</option>
              <option>2015</option>
            </select>
          </li>
          <li>
            <strong>Max-Year</strong><br>
            <select name="max_year" id="max_year" class="form-control form-control-sm" data-toggle="tooltip" data-placement="bottom" title="Maximum vehicle year">
              <option>Any</option>
              <option>1980</option>
              <option>1990</option>
              <option>1995</option>
              <option>2000</option>
              <option>2005</option>
              <option>2010</option>
              <option>2015</option>
              <option>2020</option>
            </select>
          </li>
        </div>

        <div class="hidden-filters hide">

          <div class="filter-item ">
            <li>
              <strong>Transmission</strong>
							<div class="form-check">
							  <input class="transmission-filters" type="radio" name="transmission" id="auto" value="auto">
							  <label class="form-check-label" for="auto">
									Automatic
							  </label>
							</div>
							<div class="form-check">
							  <input class="transmission-filters" type="radio" name="transmission" id="manual" value="manual">
							  <label class="form-check-label" for="manual">
									Manual
							  </label>
							</div>
							<div class="form-check">
							  <input class="transmission-filters" type="radio" name="transmission" id="tip" value="tip-tronic">
							  <label class="form-check-label" for="tip">
									Tip-tronic
							  </label>
							</div>
            </li>
          </div>

          <div class="filter-item">
            <li>
              <strong>Body type</strong>
              <select name="body_type" id="body_type" data-toggle="tooltip" data-placement="bottom" title="Filter vehicles by body type">
                <option>Any</option>
                <option>Sedan</option>
                <option>Coupe</option>
                <option>Hatch</option>
                <option>SUV</option>
                <option>Pickup</option>
                <option>Truck</option>

              </select>
            </li>
          </div>

          <div class="filter-item ">
            <li>
							<strong>Condition</strong>
							<div class="radio">
                <label>
                  <input class="condition-filters" type="radio" name="condition" value="Any" checked>
                  Any
                </label>
              </div>
              <div class="radio">
                <label>
                  <input class="condition-filters" type="radio" name="condition" value="new">
                  New
                </label>
              </div>
              <div class="radio">
                <label>
                  <input class="condition-filters" type="radio" name="condition" value="used">
                  Used
                </label>
              </div>
              <div class="radio">
                <label>
                  <input class="condition-filters" type="radio" name="condition" value="damaged">
                  Damaged
                </label>
              </div>
            </li>
          </div>

        </div>

        <input type="text" name="filtered" value="1" hidden>

        <button type="submit" id="" class="btn btn-primary btn-sm filtered_search">
          Search &nbsp <span class="ti-search" aria-hidden="true"></span>
        </button>
        <br>
        <button type="button" id="" class="btn btn-default btn-sm show-filters-btn hidden">
          Show More &nbsp<span class="ti-angle-down" aria-hidden="true"></span>
        </button>

        {{ csrf_field() }}
      </form>

      <div class="filter-btn-container d-block d-lg-none">
        <button type="button" id="" class="btn btn-default btn-sm filter-btn">
          <span class="ti-angle-right" aria-hidden="true"></span>
        </button>
      </div>

    </div>





@endsection

@section('content')
  @if ($cars)
    <div id="products" class="col-12 col-lg-10 d-flex flex-wrap justify-content-center py-md-5">
      @foreach ($cars as $car)
        <a href="/view-car/{{ $car->id }}" class=" my-2 px-2">
					<div class="home1-item">
            <div class="home1-thumbnail">

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
									<li class="item-price">
                    <h6 class="price" >
                      <strong>
                        ${{number_format((float)$car->price, 0, '.', ',') }}
                      </strong>
                    </h6>
                  </li>
									<li class="text-info text-uppercase d-flex justify-content-between text-muted px-2">
										{{$car->condition}}
										<span class="ti-eye" aria-hidden="true">&nbsp{{$car->views}}</span>
									</li>
              </ul>

            </div>
          </div>
        </a>
      @endforeach

			<div class="w-100"></div>
      <div class="col-12 flex flex-center">
        {{ $cars->appends(request()->except('_token'))->links() }}
      </div>


      @extends('templates.loading')

    </div>


  @endif
@endsection

@section('scripts')
  <script>

  $(document).ready(function() {
    var title = document.title;


    //Filter bar scripts///////
    //Coding to adjust filter settings when an option is clicked
      var cars =
  	[
  		Any = [
  			"Any",
  			"Any",
  		],
  		Acura = [
  			"Acura",
  			"Any",
  			"CL",
  			"TL"
  		],
  		Audi =[
  			"Audi",
  			"Any",
  			"A1",
  			"A3",
  			"A6",
  			"Q3",
  			"Q7",
  			"TT"
  		],
  		BMW =[
  			"BMW",
  			"Any",
  			"116i",
  			"318i",
  			"320i",
  			"1 Series",
  			"325i",
  			"328i",
  			"335i",
  			"3 Series",
  			"520d",
  			"520i",
  			"523i",
  			"525i",
  			"528i",
  			"530i",
  			"5 Series",
  			"535i",
  			"645ci",
  			"6 Series",
  			"M5",
  			"X1",
  			"X5",
  			"X6"
  		],
  		Cadillac = [
  			"Cadillac",
  			"Any",
  			"Deville",
  			"Escalade"
  		],
  		Chevrolet = [
  			"Chevrolet",
  			"Any",
  			"Avalanche",
  			"Avalanche LT",
  			"Malibu",
  			"S-10"
  		],
  		Chrysler = [
  			"Chrysler",
  			"Any",
  			"300",
  			"Cruiser"
  		],
  		Daewoo = [
  			"Daewoo",
  			"Any",
  			"Musso"
  		],
  		Daihatsu = [
  			"Daihatsu",
  			"Any",
  			"Boon",
  			"Charade",
  			"Mira"
  		],
  		Ford = [
  			"Ford",
  			"Any",
  			"Aeromax",
  			"Escape",
  			"Explorer",
  			"F-150",
  			"F-350",
  			"Focus",
  			"Transit"
  		],
  		Honda = [
  			"Honda",
  			"Any",
  			"Accord",
  			"City",
  			"Civic",
  			"CR-V",
  			"Fit",
  			"Inspire",
  			"Integra",
  			"Odyssey",
  			"Orthia",
  			"Partner",
  			"Prelude",
  			"RR",
  			"Step wagon",
  			"Stream",
  			"Torneo"

  		],
  		Hyundai  = [
  			"Hyundai",
  			"Any",
  			"Accent",
  			"Atos",
  			"Genesis",
  			"HD72",
  			"Sonata",
  			"Trajet",
  			"Tucson"
  		],
  		Infiniti = [
  			"Infiniti",
  			"Any",
  			"FX35"
  		],
  		Jaguar = [
  			"Jaguar",
  			"Any",
  			"FX",
  			"XF",
  			"XJ"
  		],
  		Jeep = [
  			"Jeep",
  			"Any",
  			"Wrangler"
  		],
  		Kia_Motors = [
  			"Kia_Motors",
  			"Any",
  			"Sportage",
  			"Vangara"
  		],
  		Land_Rover = [
  			"Land_Rover",
  			"Any",
  			"416SL",
  			"Freelander",
  			"Range Rover"
  		],
  		Lexus = [
  			"Lexus",
  			"Any",
  			"CT",
  			"CT200H",
  			"GS300",
  			"GS450H",
  			"HS250",
  			"IS",
  			"IS250",
  			"LX",
  			"MR2",
  			"RX300",
  			"Wixdom",
  			"ES300"
  		],
  		Mazda = [
  			"Mazda",
  			"Any",
  			"3 TS",
  			"323",
  			"626",
  			"Atenza",
  			"Axela",
  			"Bongo",
  			"Demio",
  			"Familia",
  			"6",
  			"MPV",
  			"Premacy",
  			"RX-7",
  			"RX-8"
  		],
  		Mercedes = [
  			"Mercedes",
  			"Any",
  			"300E",
  			"A180",
  			"C200 Kompressor",
  			"C180",
  			"C200",
  			"C250",
  			"C300",
  			"CLA250",
  			"CLS550",
  			"E",
  			"E350",
  			"E200",
  			"Kompressor",
  			"S-Class",
  			"Sprinter"
  		],
  		Mitsubishi = [
  			"Mitsubishi",
  			"Any",
  			"Airtrek",
  			"ASX",
  			"Cdia",
  			"Chariot",
  			"Colt",
  			"Evolution",
  			"Galant",
  			"Grandis",
  			"L200",
  			"Lancer",
  			"Mirage",
  			"Outlander",
  			"Montero",
  			"Pajero",
  			"RVR",
  			"Space Wagon",
  			"Starion"
  		],
  		Nissan = [
  			"Nissan",
  			"Any",
  			"350Z",
  			"AD Expert",
  			"AD Van",
  			"AD Wagon",
  			"Bluebird",
  			"Caravan",
  			"Cefiro",
  			"Cube",
  			"Sylphy",
  			"Dualis",
  			"Expert",
  			"Frontier",
  			"Juke",
  			"Lafesta",
  			"Lucino",
  			"March",
  			"Micra",
  			"Murano",
  			"Navara",
  			"Note",
  			"Pathfinder",
  			"Pick-up",
  			"Praire",
  			"Pulsar",
  			"Sentra",
  			"Serena",
  			"Sienta",
  			"Skyline",
  			"Sunny",
  			"Tiana",
  			"Tiida",
  			"Titan",
  			"Vanette",
  			"Versa",
  			"Wingroad",
  			"X-Trail"
  		],
  		Subaru = [
  			"Subaru",
  			"Any",
  			"Exiga",
  			"Forester",
  			"Impreza",
  			"WRX",
  			"Legaxy",
  			"S-GT"
  		],
  		Suzuki = [
  			"Suzuki",
  			"Any",
  			"Alto",
  			"Baleno",
  			"Celeria",
  			"Forenza",
  			"Geo-Metro",
  			"Grand Vitara",
  			"Liana",
  			"Swift",
  			"SX4",
  			"Vitara"
  		],
  		Toyota = [
  			"Toyota",
  			"Any",
  			"Corolla Vorso",
  			"Premio",
  			"Allion",
  			"Alphard",
  			"Altezza",
  			"Aqua",
  			"Auris",
  			"110",
  			"Axio",
  			"Belta",
  			"Blade",
  			"Caldina",
  			"Camry",
  			"Ceres",
  			"Coaster Bus",
  			"Corolla",
  			"Fielder",
  			"Flatty",
  			"Kingfish",
  			"Levin",
  			"Police Shape",
  			"Corolla S",
  			"Sprinter",
  			"Touring",
  			"Corolla Wagon",
  			"Corona",
  			"Crown",
  			"Estima",
  			"Fortuna",
  			"Hiace",
  			"Hilux",
  			"Hino",
  			"Ipsum",
  			"Isis",
  			"Land Cruiser",
  			"Prado",
  			"Mark 2",
  			"Mark X",
  			"Nadia",
  			"Noah",
  			"Passo",
  			"Picnic",
  			"Premio",
  			"Probox",
  			"Ractis",
  			"Rav 4",
  			"Runx",
  			"Starlet",
  			"Succeed",
  			"Surf",
  			"Tacoma",
  			"Tercel",
  			"Terios",
  			"Tawnace",
  			"Liteace",
  			"Tundra",
  			"Vanguard",
  			"Vios",
  			"Vista",
  			"Vitz",
  			"Voxy",
  			"Wagon",
  			"Wish",
  			"Yaris"
  		],
  		Volkswagen = [
  			"Volkswagen",
  			"Any",
  			"Amarok",
  			"Golf GTI",
  			"Jetta",
  			"Passat",
  			"Polo",
  			"Tiguan",
  			"Touareg"
  		],
  		Volvo = [
  			"Volvo",
  			"Any",
  			"S60"
  		],
  		Yamaha = [
  			"Yamaha",
  			"Any",
  			"600CC"
  		]
  	];

  	/******************************************************************
  	Display correct models when a make is selected
  	*****************************************************************/
  	var setModel = function(el) {
  		for (i = 0; i < cars.length; i++)
  		{
  			var $selection = el.text();
  			var $model = $("#model");
  			if(/\s/.test($selection))
  			{
  				$selection = $selection.replace(/\s/, "_");
  			}
  			if( $selection == cars[i][0] )
  			{
  				$model.empty();
  				for (j = 1; j<cars[i].length; j++)
  				{
  					var a = "<option>";
  					var b = "</option>";
  					var c = a.concat(cars[i][j], b);
  					$model.add(c).appendTo($model);
  				}
  			}
  		}
  	}

  	setModel($("#make"));

  	$("#make").on("change", function(){
  		setModel($( "#make option:selected" ));
  	});


  	/************************************************************
  	Display only higher prices when a min price has been selected
  	*************************************************************/
  	$("#min_price").on("change", function(){
  		var $min_price = $( "#min_price option:selected" ).text();
  		if($min_price.charAt(0) == "$")
  		{
  			$min_price = $( "#min_price option:selected" ).text().slice(1);
  		}
  		var $max_price = [
  			500000,
  			1000000,
  			2000000
  		]

  		$("#max_price").empty();
  		if($min_price == "Any")
  		{
  			$("#max_price").add("<option>Any</option>").appendTo("#max_price");
  			for(i=0; i< $max_price.length; i++)
  			{
  					var a = "<option>$";
  					var b = "</option>";
  					var c = a.concat($max_price[i].toString(), b);
  					$("#max_price").add(c).appendTo("#max_price");
  			}
  		}
  		else
  		{
  			for(i=0; i< $max_price.length; i++)
  			{

  				if($min_price < $max_price[i])
  				{
  					var a = "<option>$";
  					var b = "</option>";
  					var c = a.concat($max_price[i].toString(), b);
  					$("#max_price").add(c).appendTo("#max_price");
  				}
  			}
  		}
  	});

  	/******************************************************************
  	Display only higher years when min year has been selected
  	*****************************************************************/

  	$("#min_year").on("change", function(){
  		var $min_year = $( "#min_year option:selected" ).text();
  		var $max_year = [
  			1980,
  			1990,
  			1995,
  			2000,
  			2005,
  			2010,
  			2015,
  			2020
  		];

  		$("#max_year").empty();
  		$("#max_year").add("<option>Any</option>").appendTo("#max_year");

  		if($min_year == "Any")
  		{
  			for(i=0; i< $max_year.length; i++)
  			{
  					var a = "<option>";
  					var b = "</option>";
  					var c = a.concat($max_year[i].toString(), b);
  					$("#max_year").add(c).appendTo("#max_year");
  			}
  		}
  		else
  		{
  			for(i=0; i< $max_year.length; i++)
  			{
  				if($min_year < $max_year[i])
  				{
  					var a = "<option>";
  					var b = "</option>";
  					var c = a.concat($max_year[i].toString(), b);
  					$("#max_year").add(c).appendTo("#max_year");
  				}
  			}
  		}
  	});


    //show and hide filter based on screen size
    var $filter_btn = $(".filter-btn");
    var $filter_bar = $(".filter-bar");
    var $close_filter = $(".close-filter");
    var $filter_show_btn = $('.filter-btn span');
    $filter_btn.click(function(){
      $filter_bar.toggleClass('show-filters').promise().done(function() {
        if($filter_bar.hasClass('show-filters')) {
          /*$filter_show_btn.removeClass().addClass('ti-angle-left');*/
          $filter_bar.css('overflow', 'scroll');
        }
      });
    });

    $close_filter.click(function(){
      $filter_bar.removeClass('show-filters').promise().done(function() {
        $filter_bar.css('overflow', 'inherit');
      });
    });

    /*Show loader when a search value has been entered*/
    $("#search_button").on('click', function(evt){
      $("#loading").modal("show");
      $(this).submit();
    });

    /*Show loader when a search value has been entered*/
    $(".filtered_search").on('click', function(evt){
      $filter_bar.toggleClass('show-filters').promise().done(function() {
        if($filter_bar.hasClass('show-filters')) {
          $filter_show_btn.removeClass().addClass('ti-angle-right');
        }
      });
      $("#loading").modal("show");
      $(this).submit();
    })
});


  </script>
@endsection
