<?php

namespace App\Http\Actions;

use App\Mail\LetterMailable;
use App\Models\Post;
use App\Models\Site;
use App\Models\Subscriber;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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
            $subscribers = Subscriber::where('site_id', $site->id)->get();

            foreach($subscribers as $subscriber) {
               $post = Post::where('site_id', $site->id)->orderBy('created_at', 'desc')->first();

               Mail::to($subscriber->email)->send(new LetterMailable($post));
            }
        }
   }
}