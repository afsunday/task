<?php

namespace App\Console\Commands;

use App\Http\Actions\Newsletter as ActionsNewsletter;
use Illuminate\Console\Command;

class NewsEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:newsLetter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send new email';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $mail = new ActionsNewsletter();
        $mail->send();
    }
}
