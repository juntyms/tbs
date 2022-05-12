<?php

namespace App\Console;

use DateTime;
use App\Models\Tutorial_request;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function(){

            $currentdatetime=new DateTime();
            $currentdate=$currentdatetime->format('Y-m-d');
            $currenthour=$currentdatetime->format('H');

            $listTutorial=Tutorial_request::where('active',1)
            ->whereExists(function($query){
                    $query->where('accepted',0)
                        ->orWhere('accepted',1);})->get();

            

            if($listTutorial)
            {
                foreach($listTutorial as $list)
                {
                    if($list->date<$currentdate)
                    {

                        $list->update(['accepted'=>4]);
                    }elseif($list->date==$currentdate)
                    {

                        if($list->AvaliableCourse->time<$currenthour)
                        {
                            $list->update(['accepted'=>4]);

                        }
                    }
                }
            }

        })->dailyAt(env('TIMESCH','23:30'));
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
