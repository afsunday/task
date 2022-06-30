<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailController extends Controller
{
    /**
     * send email
     */
    public function send(Request $request)
    {
        $sites =  Site::all()->get();

        foreach($sites as $site) {
            Subscriber::where('site_id', $site->id)->get()->each(function($subscriber) {
                $data = [
                    'email' => $subscriber->email,
                    'message' => $subscriber->message,
                ];
                \Mail::send('emails.contact', $data, function ($message) use ($subscriber) {
                    $message->from($subscriber->email);
                    $message->to('
                    ');
                    $message->subject($subscriber->subject);
                });
            });
        }
    }
}
