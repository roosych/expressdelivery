<?php

namespace App\Console\Commands;

use App\Models\Driver;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckDriverAvailable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'driver:availability';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check driver availability';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $drivers = Driver::all();

        foreach ($drivers as $driver)
        {
            $future_datetime = Carbon::createFromFormat('Y-m-d H:i:s',  $driver->future_datetime);

            if ($future_datetime < now())
            {
                $driver->update([
                    'service' => true,

                    'zipcode' => $driver->future_zipcode,
                    'location' => $driver->future_location,
                    'latitude' => $driver->future_latitude,
                    'longitude' => $driver->future_longitude,

                    'future_zipcode' => null,
                    'future_location' => null,
                    'future_latitude' => null,
                    'future_longitude' => null,
                    'future_datetime' => null,
                ]);

                info('Driver ' .$driver->id. 'status changed');
            }
        }

        //return Command::SUCCESS;
        return info('Status is changed!');
    }
}
