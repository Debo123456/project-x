<?php

namespace App\Http\Controllers;

use App\View;
use App\User;
use App\Car;
use App\Viewers;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    //
    public function incrementView(Request $request){
        
        $cid= $request->input('car');
        $uid= $request->input('user');
        $cookie= $request->input('cookie');
        $isLoggedIn= $request->input('is_logged_in');
        $ip_address = $this->get_client_ip_env();

        if ($isLoggedIn) {
            $viewers = new Viewers;
            $viewer_by_id = $viewers->where('car_id', '=', $cid)
                    ->where('user_id', '=', $uid)
                    ->first();
            $viewer_cookie = $viewers->where('car_id', '=', $cid)
                    ->where('cookie', '=', $cookie)
                    ->first();

            if(!$viewer_by_id && !$viewer_cookie){
                echo "viewer not found";
                $this->updateView($cid);
                $this->addViewer($cid, $uid, $ip_address, $cookie, $isLoggedIn);
            }
            
        }
        else{
            $viewers = new Viewers;
            $viewer = $viewers->where('car_id', '=', $cid)
                                ->where('cookie', '=', $cookie)
                                ->first();
            if(!$viewer){
                echo "cookie not found";
                $this->updateView($cid);
                $this->addViewer($cid, $uid, $ip_address, $cookie, $isLoggedIn);
            }
        }

        return;

    }

    private function updateView($cid){
        $views = new View;
        $view = $views->findOrFail($cid);
        $updated_views = $view->views + 1;
        echo $updated_views;
        $view->views = $updated_views;
        $view->save();
        echo 'view added';
    }

    private function addViewer($car_id, $user_id = "", $ip_address, $cookie, $isLoggedIn){
        $viewer = new Viewers;
        if ($isLoggedIn) {
            # code...
            $viewer->user_id = $user_id;
        }
        $viewer->car_id = $car_id;
        $viewer->user_id = $user_id;
        $viewer->cookie = $cookie;
        $viewer->ip_address = $ip_address;
        $viewer->save();
        echo 'viewer added';
    }

    private function get_client_ip_env(){
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        
        return $ipaddress;
    }
}
