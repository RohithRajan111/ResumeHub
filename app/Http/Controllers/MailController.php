<?php

namespace App\Http\Controllers;

use App\Mail\ActionResultMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
class MailController extends Controller
{
    //

    public function sendemail()
    {
        Mail::to("rohithrajan111@gmail.com")->send(new ActionResultMail());
        return 'email send successfully';
    }
}
