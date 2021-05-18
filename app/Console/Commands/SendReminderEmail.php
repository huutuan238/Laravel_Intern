<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use Mail;
use App\Mail\EmailReminder;
use Carbon\Carbon;

class SendReminderEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Daily Mail';

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
     * @return int
     */
    public function handle()
    {
        $today = Carbon::now();
        $posts = Post::orderby('id', 'desc')->where('status', 1)->whereDay('created_at', $today)->get();
        Mail::to('tuannh.intern@gmail.com')->send(new EmailReminder($posts));
        // $this->info('Demo:Cron Cummand Run successfully!');
    }
}
