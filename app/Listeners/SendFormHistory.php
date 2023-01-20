<?php

namespace App\Listeners;

use App\Events\SendEmailEvent;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class SendFormHistory
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\SendEmailEvent  $event
     * @return bool
     */
    public function handle(SendEmailEvent $event)
    {
        $current_timestamp = Carbon::now()->toDateTimeString();
        $forminfo = $event->form;

        $saveHistory = DB::table('form_history')->insert(
            ['text' => $forminfo->text, 'email' => $forminfo->email, 'date' => $forminfo->date, 'created_at' => $current_timestamp, 'updated_at' => $current_timestamp]
        );
        return $saveHistory;
    }
}
