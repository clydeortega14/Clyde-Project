<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\RentCar;
use App\Service\smsSender;

class RentSchedules extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:rent';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Schedule customers for renting a car';

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
        $date = Carbon::now();
        $dateToday = $date->toDateString();

        $rent_schedules = RentCar::all();

        foreach ($rent_schedules as $key => $schedule) {
            
            if($dateToday == $schedule->pick_up_date){

                RentCar::whereDate('pick_up_date', $dateToday)->update(['status_id' => 4]);

                $message = 'Good Morning'.' '.$schedule->customer->name.' '.'you have a reservation that is scheduled today please pick up the'.' '.$schedule->car->model.' '.'in the'.' '.$schedule->pick_up_address.' ';
                smsSender::sendSms($schedule->customer->contact_number, $message); /* SEND SMS */
                
            }else if($dateToday == $schedule->drop_off_date){

                RentCar::whereDate('drop_off_date', $dateToday)->update(['status_id' => 5]);

                $message = 'Good Morning'.' '.$schedule->customer->name. ' '.'did you enjoy your ride so far? thank you choosing us, Come Again! ';
                smsSender::sendSms($schedule->customer->contact_number, $message);
            }
        }
    }
}
