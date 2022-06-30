<?php

namespace App\Http\Actions;

use App\Models\Site;
use App\Models\Subscriber;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Newsletter
{
    /**
     * send email
     */
   public function send() 
   {
        // get all sites andsend the latest post to each subscriber
        $sites =  Site::all();

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