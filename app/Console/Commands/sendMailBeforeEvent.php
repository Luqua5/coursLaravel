<?php

namespace App\Console\Commands;

use App\Models\Event;
use App\Jobs\ProcessMail;
use Illuminate\Console\Command;

class sendMailBeforeEvent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-mail-before-event';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $events = Event::all();
        
        foreach($events as $event){
            if($event->start_date->format('Y-m-d') === now()->addDay()->format('Y-m-d')){
                $users = $event->users;
                foreach($users as $user){
                    dispatch(new ProcessMail($user));
                }
            }
        }
    }
}
