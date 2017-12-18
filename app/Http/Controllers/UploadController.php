<?php

namespace App\Http\Controllers;

use App\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;


class UploadController extends Controller
{
    //
    public function showUploadForm() {
      return view('upload');
    }

    public function upload(Request $request) {

      $car = new Car();

      $make = 'make';
      $model = 'model';

      if($request->input('alt-make-checkbox') == "on") {
        $make = 'alt-make';
      }

      if($request->input('alt-model-checkbox') == "on") {
        $model = 'alt-model';
      }


      $price = str_replace(',', '', $request->input('price'));

      $request->merge(['price' => $price]);


      $this->validate($request, [
        $make => 'Required|not_default',
        $model => 'Required|not_default',
        'year' => 'Required|not_default',
        'condition' => 'Required|not_default',
        'images' => 'Required|max:8',
        'price' => 'Required|Numeric',
        'phone' => 'Required|phone',
        'parish' => 'Required|not_default',
        'transmission' => 'Required|not_default',
        'body_type' => 'Required|not_default',
        'description' => 'Required'
      ]);

      foreach ($request->images as $image)
      {
        $this->validate($request,[
          'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8192'
        ]);
      }



      $car->make = $request->input($make);
      $car->model = $request->input($model);
      $car->year = $request->input('year');
      $car->price = $price;
      $car->seller = Auth::user()->name;
      $car->contact = $request->input('phone');
      $car->location = $request->input('parish');
      $car->transmission = $request->input('transmission');
      $car->condition = $request->input('condition');
      $car->body_type = $request->input('body_type');
      $car->description = $request->input('description');
      $car->seller_id = md5($car->seller . 'hello');


      //Check if images were uploaded
      if($request->hasFile('images')) {

        $images = $request->images; //Get an array of all uploaded images.

        $path = 'uploads/vehicles/';  //store only works with relative path from the storage folder no absolute document root

        $folder = date('Y/m/'). mt_rand(); //Folder which images will be stored in.

        $path .= $folder; //Storage path for images

        if(mkdir($_SERVER['DOCUMENT_ROOT'].Storage::url($path)."/main", 0700, true)) {
          //Loop through and store each image to storage durectory.
          for ($i=0; $i < count($images) ; $i++) {
            if($i == 0) {
              if(file_exists($_SERVER['DOCUMENT_ROOT'].Storage::url($path)."/main")) {
                $images[$i]->store($path."/main");
              }
            }
            else {
              $images[$i]->store($path);
            }

          }
        }
        else {
          return redirect()->back()->with('error', 'Unable to store files');
        }

        $car->img = $folder; //Set path to img field in database.
      }

      if(!empty(storage::files($path.'/main')) && $car->save()) {
        return redirect('upload')->with('status', 'Vehicle has been uploaded.');
      }
      else {
        return redirect()->back()->with('error', 'There was an error while uploading your files ');
      }




    }
}
