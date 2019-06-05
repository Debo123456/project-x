<?php

namespace App\Http\Controllers;

use App\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CarUpdateController extends Controller
{
    //Display car update form
    public function index($user, $id) {
      if ($user == str_replace(" ", "-", Auth::user()->name)) {
        $cars = new Car;
        $car = $cars->find($id);

        return view('update-car')->with('car', $car);
      }
    }

    //Process update car form
    public function updateCar($user, $id, Request $request) {

      if ($user == str_replace(" ", "-", Auth::user()->name)) {

        $make = 'make';
        $model = 'model';
        $default_make ='Any';
        $default_model = "Select model";

        if($request->input('alt-make-checkbox') == "on") {
          $make = 'alt-make';
          $default_make ='Enter Manufacturer';

        }

        if($request->input('alt-model-checkbox') == "on") {
          $model = 'alt-model';
          $default_model ='Enter model';
        }

        $default = [
          $make => "Any",
          $model => "Select model",
          "year" => "Any",
          "condition" => "Any",
          "price" => "",
          "town-city" => "",
          "parish" => "Select Parish",
          "phone" => "",
          "transmission" => "Any",
          "body_type" => "Any",
          "description" => ""
        ];

        $new = [];

        foreach ($default as $key => $value) {
          if ($request->input($key) != $default[$key]) {
            if($key == 'alt-make') {
              $new['make'] = $request->input($key);
            }
            elseif($key == 'alt-model') {
              $new['model'] = $request->input($key);
            }
            else {
              $new[$key] = $request->input($key);
            }
          }
        }


        if(empty($new)) {
          return redirect()->back()->with('info', 'There was nothing to update.');
        }
        else {
          DB::table('cars')
                ->where('id', $id)
                ->update($new);
          return redirect()->back()->with('status', 'Vehicle has been updated.');
        }

      }
    }

    //Delete car image
    public function deleteImage($user, $id, Request $request) {
      if ($user == str_replace(" ", "-", Auth::user()->name)) {
        $img = $request->input('img');
        $cars = new Car;
        $car = $cars->find($id);

        $file = $_SERVER['DOCUMENT_ROOT'].Storage::url($img);

        if(File::exists($file)) {
          unlink($file);
          return 1;
        }
        else {
          return 0;
        }

        return "You do not have permission to delete this image!";
      }
    }

    //Set display image for car
    public function setDisplayImage($user, $id, Request $request) {
      if ($user == str_replace(" ", "-", Auth::user()->name)) {

        $supported_image = array(
            'gif',
            'jpg',
            'jpeg',
            'png'
        );

        $display_url_array = explode('/', $request->input('img'));
        $img = end($display_url_array);

        $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
        if (!in_array($ext, $supported_image)) {
          return 0; //Return zero for errors
        }



        $cars = new Car;
        $car = $cars->find($id);
        $folder = $_SERVER['DOCUMENT_ROOT'].Storage::url("public/uploads/vehicles/".$car->img);//folder for display image
        $display_folder = $folder. "/main";
        $source = $folder ."/".$img;//Path to image that should be moved to main folder
        $destination = $folder ."/main/".$img; //Path for image image in main folder nb. image name included


        if(file_exists($display_folder)) {
          if(count(glob($display_folder ."/*")) !== 0) {   //Check if main folder exists for display image

            $current_display_url_array = explode('/', Storage::allFiles("public/uploads/vehicles/". $car->img ."/main")[0]);
            $current_display = end($current_display_url_array);

            //$current_display = explode('/', Storage::allFiles("uploads/vehicles/". $car->img ."/main")[0])[4];  //get filename of the current display image

            //move current display image to parent folder with other image-section
            //Then dellete all files from display folder
            if(rename($folder. "/main/" . $current_display, $folder. '/'.$current_display)) {
              $files = glob($folder ."/main"); //get all file names
              foreach($files as $file){
                  if(is_file($file))
                  unlink($file); //delete file
                }
              } else {
                return 0; //Return zero for errors
              }

              if(rename($source, $destination)) {
                  return 1;
              } else {
                return 0; //Return zero for errors
              }
          }
          else {
            if(rename($source, $destination)) {
              return 1.1;
            } else {
              return 0; //Return zero for errors
            }
          }
        }
        else {
          if(mkdir($folder. "/main", 0755)) {
            if(rename($source, $destination)) {
                return 1.2;
            } else {
              return 0; //Return zero for errors
            }

          } else {
            return 0; //Return zero for errors
          }
        }
      }
    }

    //Upload car images
    public function updateImages($user, $id, Request $request) {
      if(count($request->images) == 0) {
        return redirect()->back()->with('error', 'Select an image before uploading.');
      }
      $cars = new Car;
      $car = $cars->find($id);
      //Check if images were uploaded
      if($request->hasFile('images')) {

        $images = $request->images; //Get an array of all uploaded images.

        $folder = $car->img; //Folder which images will be stored in.

        $path = 'public/uploads/vehicles/'.$folder; //Storage path for images

        //Loop through and store each image to storage directory.
        for ($i=0; $i < count($images) ; $i++) {

          //$images[$i]->store($path (($start_index) + $i) . '.jpg');
          $images[$i]->store($path);

        }

        return redirect()->back()->with('status', 'Image has been uploaded.');
      }

    }

}
