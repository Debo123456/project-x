<?php

namespace App\Http\Controllers;

use Mail;
use App\Mail\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //

    public function displayForm() {
        return view('contact');
    }

    public function sendEmail(Request $request) {

      //Validate form input
      $this->validate($request, [
        'name' => 'Required',
        'email' => 'Required|email',
        'message' => 'Required'
      ]);

      //Build array of form data
      $mailData = array(
                   'name'     => $request->input('name'),
                   'email'    => $request->input('email'),
                   'message'  => $request->input('message')
                  );

      //Send form data to Mailable class (AutoJa\Mail\{mail class)
      Mail::send(new Contact($mailData));

      //Redirect to contact page
      return redirect('contact')->with('status', 'Message sent you will be hearing from us shortly.');
    }

}
