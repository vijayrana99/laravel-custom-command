<?php

namespace App\Console\Commands;

use Mail;
use Carbon;
use App\User;
use Illuminate\Console\Command;

class CountUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'count:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Count the total number of user registered today';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //get total number of registered user today
        $users = User::whereDate('created_at', Carbon::today())->count();

        // send mail to specified user
        Mail::send([], [], function ($message) use ($users) {
          $message->to('info@kodementor.com')
            ->subject('New Users Report From Kodementor')
            ->setBody('Hi Vijay, The total number of registered users in Kodementor today is '.$users);
        });
    }
}
