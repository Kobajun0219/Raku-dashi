<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class TestMailController extends Controller
{
    public function send(){
        return Mail::to('ryoma@gmail.com')->send(new SendMail());
    }

}
