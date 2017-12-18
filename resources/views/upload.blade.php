@extends('templates.default')

@section('css_link')
  <link rel="stylesheet" href="/css/themify/themify-icons.css" />
@endsection

@section('content')
  <div class="form_container">

    <form action="" class="form col-xs-12 col-sm-8 col-md-5" method="post" enctype="multipart/form-data">

      <div class="heading">
        <h2>Upload your vehicle</h2>
      </div>

      @if ( session('status'))
        <div class="form-group-sm alert alert-success">
          <strong>Success!</strong> {{ session('status')}} .
        </div>
      @elseif (session('error'))
        <div class="form-group-sm alert alert-danger">
          <strong>Ooops!</strong>{{ session('error') }}, try again later or contact website administrator.
        </div>
      @endif

      <!-- Make input -->
      <div id="make-container" class="{{ $errors->has('make') ? ' has-error' : '' }}" data-toggle="tooltip" data-placement="left" title="Select the vehicles manufacturer">
        <label for="make">Make*</label>
        <select name="make" id="make" class="form-control" value="{{ old('make') }}" required>
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

        @if ($errors->has('make'))
            <span class="help-block">
                <strong>{{ $errors->first('make') }}</strong>
            </span>
        @endif
      </div>

      <div id="alt-make-container" class="" style="display: none;" data-toggle="tooltip" data-placement="left" title="Enter the name of the vehicles manufacturer">
        <label for="alt-make">Make(Alternative)*</label>
        <input type="text" id="alt-make" class="form-control" name="alt-make" value="" placeholder="Enter Manufacturer">
      </div>

      <div class="checkbox" data-toggle="tooltip" data-placement="left" title="Click here to manually enter manufacturer">
        <label>
          <input id="alt-make-checkbox" name="alt-make-checkbox" type="checkbox">
          <span class="text-warning"><strong>Cant find my vehicles manufacturer!!</strong></span>
        </label>
      </div><br>

      <!-- Model input -->
      <div id="model-container" class="{{ $errors->has('model') ? ' has-error' : '' }}" data-toggle="tooltip" data-placement="left" title="Select the vehicles model">
        <label for="model">Model*</label>
        <select name="model" id="model" class="form-control" value="{{ old('model') }}" required>
          <option>Select make</option>
        </select>

        @if ($errors->has('model'))
            <span class="help-block">
                <strong>{{ $errors->first('model') }}</strong>
            </span>
        @endif
      </div>

      <div id="alt-model-container" class="" style="display: none;" data-toggle="tooltip" data-placement="left" title="Enter the vehicles model">
        <label for="alt-model">Model(Alternative)*</label>
        <input type="text" id="alt-model" class="form-control" name="alt-model" value="" placeholder="Enter model">
      </div>

      <div class="checkbox" data-toggle="tooltip" data-placement="left" title="Click here to manually enter a model">
        <label>
          <input id="alt-model-checkbox" type="checkbox" name="alt-model-checkbox">
          <span class="text-warning"><strong>Cant find my vehicles model!!</strong></span>
        </label>
      </div><br>

      <!-- Year -->
      <div class="{{ $errors->has('year') ? ' has-error' : '' }}" data-toggle="tooltip" data-placement="left" title="Select the vehicles year">
        <label for="up-year">Year</label>
        <select name="year" id="min_year" class="form-control" value="{{ old('year') }}" required>
          <option>Any</option>
          <?php
          for($i=2017; $i>1970; $i--)
          {
            echo '<option>'.$i.'</option>';
          }
          ?>
        </select>

        @if ($errors->has('year'))
            <span class="help-block">
                <strong>{{ $errors->first('year') }}</strong>
            </span>
        @endif
      </div><br><br>

      <!-- Condition input -->
      <div class="{{ $errors->has('condition') ? ' has-error' : '' }}" data-toggle="tooltip" data-placement="left" title="Select a condition for your vehicle">
        <label for="condition">Condition*</label>
        <select name="condition" id="condition" class="form-control" value="{{ old('condition') }}" required>
          <option>Any</option>
          <option>New</option>
          <option>Used</option>
          <option>Damaged</option>
        </select>

        @if ($errors->has('condition'))
            <span class="help-block">
                <strong>{{ $errors->first('condition') }}</strong>
            </span>
        @endif
      </div><br><br>

      <!-- Price input -->
      <div class=" {{ $errors->has('price') ? ' has-error' : '' }}">
        <label for="price">Price* </label><br />
        <div class="flex price-input" data-toggle="tooltip" data-placement="left" title="Set your vehicles selling price">
          <span class="currency">$</span>
          <input  id="price" class="form-control" type="text" name="price" maxlength="15" required>
          <span class="cents">.00</span>
        </div>

        @if ($errors->has('price'))
            <span class="help-block">
                <strong>{{ $errors->first('price') }}</strong>
            </span>
        @endif
      </div><br><br>

      <!-- Image input -->
      <div class="" data-toggle="tooltip" data-placement="left" title="Choose display images for your vehicle. Maximum of 8 images">
        <label for="images">Images* </label><br />
        <input id="images" class="form-control" type="file" name="images[]" value="{{ old('images[]') }}" accept="image/*" multiple required/><br />

        <div id="preview-image"></div>
      </div><br><br>

      <!-- Location input -->
      <div class="{{ $errors->has('location') ? ' has-error' : '' }}" style="clear: both;">
        <label for="location">Location*</label>
        <div class="inline-elements">
          <input id="town-city" class="form-control" type="text" name="town-city" value="{{ old('town-city') }}" placeholder="City/Town" data-toggle="tooltip" data-placement="left" title="Enter the city or town your vehicle is located in"/>
          <br/>
          <select name="parish" id="parish" class="form-control" value="{{ old('parish') }}" data-toggle="tooltip" data-placement="left" title="Select the parish the vehicle is located in." required>
            <option>Select Parish</option>
            <option>Clarendon</option>
            <option>kingston</option>
            <option>Hanover</option>
            <option>Manchester</option>
            <option>St. Andrew</option>
            <option>St. Ann</option>
            <option>St. Catherine</option>
            <option>St. Elizabeth</option>
            <option>St. James</option>
            <option>St. Mary</option>
            <option>St. Thomas</option>
            <option>Portland</option>
            <option>Trelawny</option>
            <option>Westmoreland</option>
          </select>
        </div>

        @if ($errors->has('parish'))
            <span class="help-block">
                <strong>{{ $errors->first('parish') }}</strong>
            </span>
        @endif
      </div><br><br>

      <!-- Phone number input -->
      <div id="phone-input" class=" has-feedback" data-toggle="tooltip" data-placement="left" title="Enter your phone number in the format: (876)-123-4567">
        <label for="Phone">Phone*</label>
        <input id="phone" class="form-control" name="phone" type="text" value="" aria-describedby="inputSuccess2Status" placeholder="Enter phone number." data-mask="(000) 000-0000" required/>
        <span class="ti-check form-control-feedback" style="font-weight: bold; display: none;" aria-hidden="true"></span>
        <span id="inputSuccess2Status" class="sr-only">(success)</span>

        <span id="helpBlock" class="help-block">*Format should be (876) 123-4567.</span>

        @if ($errors->has('phone'))
            <span class="help-block">
                <strong>{{ $errors->first('phone') }}</strong>
            </span>
        @endif
      </div><br>

      <!-- Transmission input -->
      <div class="{{ $errors->has('transmission') ? ' has-error' : '' }}" data-toggle="tooltip" data-placement="left" title="Select the vehicles transmission">
        <label for="transmission">Transmission*</label>
        <select name="transmission" id="transmission" class="form-control" value="{{ old('transmission') }}" required >
          <option>Any</option>
          <option>Automatic</option>
          <option>Manual</option>
          <option>Tip-tronic</option>
        </select>

        @if ($errors->has('transmission'))
            <span class="help-block">
                <strong>{{ $errors->first('transmission') }}</strong>
            </span>
        @endif
      </div><br><br>

      <!-- Body type -->
      <div class="{{ $errors->has('body_type') ? ' has-error' : '' }}" data-toggle="tooltip" data-placement="left" title="Select the vehicles body type">
        <label for="body_type">Body Type*</label>
        <select name="body_type" id="body_type" class="form-control" value="{{ old('body_type') }}" required>
          <option>Any</option>
          <option>Sedan</option>
          <option>Coupe</option>
          <option>Hatch</option>
          <option>Van</option>
          <option>Bus</option>
          <option>Truck</option>
          <option>SUV</option>
        </select>

        @if ($errors->has('body_type'))
            <span class="help-block">
                <strong>{{ $errors->first('body_type') }}</strong>
            </span>
        @endif
      </div><br><br>

      <!-- Description input -->
      <div class="{{ $errors->has('description') ? ' has-error' : '' }}" data-toggle="tooltip" data-placement="left" title="Enter a detailed description of your vehicle">
        <label for="description">Description*</label>
        <textarea class="form-control" name="description" rows="5" value="{{ old('description') }}" required></textarea>

        <span id="helpBlock" class="help-block">*Give a detailed description of your vehicle.</span>

        @if ($errors->has('description'))
            <span class="help-block">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
        @endif
      </div><br><br>

      <input type="submit" class="submit-btn form-control btn-primary" value="Upload" />

      {{ csrf_field() }}

    </form>
  </div>
@endsection

@section('scripts')
  <script src="/js/jquery.mask.min.js"></script>

  <script>

  $('#phone').mask("(000) 000-0000", {placeholder: "(___) ___-___"});
  $('#price').mask('#,##0,000', {reverse: true});



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



  $("#images").on('change', function () {

    var countFiles = $(this)[0].files.length;
    if(countFiles > 8) {
      alert("Maximum of 8 files");
      $(this).val("");
    }
    else {
      var imgPath = $(this)[0].value;
      var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
      var image_holder = $("#preview-image");
      image_holder.empty();

      if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
        if (typeof (FileReader) != "undefined") {

          for (var i = 0; i < countFiles; i++) {

            var reader = new FileReader();
            reader.onload = function (e) {
              $("<img />", {
                "src": e.target.result,
                "class": "thumbimage"
              }).appendTo(image_holder);
            }

            image_holder.show();
            reader.readAsDataURL($(this)[0].files[i]);
          }

        } else {
          alert("File type not supported");
          $(this).val("");
        }
      } else {
        alert("Select Only images");
        $(this).val("");
      }
    }

  });

  $('#alt-make-checkbox').change(function() {
    if(this.checked == true) {
      $('#make-container').fadeOut('slow', function() {
        $('#alt-make-container').fadeIn();
      });
    }
    else {
      $('#alt-make-container').fadeOut('slow', function() {
        $('#make-container').fadeIn();
      });
    }
  });

  $('#alt-model-checkbox').change(function() {
    if(this.checked == true) {
      $('#model-container').fadeOut('slow', function() {
        $('#alt-model-container').fadeIn();
      });
    }
    else {
      $('#alt-model-container').fadeOut('slow', function() {
        $('#model-container').fadeIn();
      });
    }
  });


  $('#phone').on('keyup',function() {
    if(this.value.length !== 0) {

      $('.form-control-feedback').show();

      if(/((\(\d{3}\) ?))\d{3}-\d{4}/.test(this.value)) {
        $('#phone-input').toggleClass('has-success', true);
        $('#phone-input').toggleClass('has-error', false);
        $('.form-control-feedback').toggleClass('ti-check', true);
        $('.form-control-feedback').toggleClass('ti-close', false);
      }
      else {
        $('#phone-input').toggleClass('has-success', false);
        $('#phone-input').toggleClass('has-error', true);
        $('.form-control-feedback').toggleClass('ti-close', true);
        $('.form-control-feedback').toggleClass('ti-check', false);
      }
    }
    else {
      $('#phone-input').toggleClass('has-success', false);
      $('#phone-input').toggleClass('has-error', false);
      $('.form-control-feedback').hide();
    }

  });

  $('.submit-btn').on('click', function(event) {
    event.preventDefault();
    $("#loading").modal("show");
    $('.form').submit();
  });



  </script>
  @endsection
