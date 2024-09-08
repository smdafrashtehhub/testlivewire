<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendMail(Request $request)
    {
        $data=[
            'subject'=>'test email',
            'body'=>'hello world'
        ];
        Mail::to($request->email)->send(new SendEmail($data));
    }
}
