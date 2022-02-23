<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;

use App\Mail\ReportCliques;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MailController extends Controller
{
    public function sendEmail()
    {
        $email = 'rafael.figueiredo.valim@gmail.com';

        $mailData = [
            'title' => 'Demo Email',
            'url' => 'https://www.positronx.io'
        ];

        Mail::to($email)->send(new ReportCliques($mailData));
        return response()->json([
            'message' => 'Email has been sent.'
        ], Response::HTTP_OK);
    }
}
