<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();
use Mail;

class MailController extends Controller
{
    public function sendmail()
    {
        $to_name = "CauAm";
        $to_email = "thanh07345@gmail.com"; ;//send to this email
        $data = array("name" => "Nooi dung ten", "body" => "noi dung body"); //body of <mail class="blade php">

        Mail::send('pages.send_mail', $data, function($message) use ($to_name, $to_email){
            $message->to($to_email) -> subject('test mailddddd'); //send mail with subject
            $message->from($to_email, $to_name); //send from this mail
        });
        // Alert::success('Email Send Successfully', 'Success');
        return redirect('/')->with('message', '');
        
        
    }
}
