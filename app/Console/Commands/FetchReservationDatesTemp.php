<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
class FetchReservationDatesTemp extends Command
{
    protected $signature = 'reservation:dates {id}';

    protected $description = 'Fetches all dates between date_start and date_end for a given reservation ID';

    public function handle()
    {
        $id = $this->argument('id');

        $reservation = DB::table('reservations')
            ->select('date_start', 'date_end')
            ->where('apart_id', $id)
            ->first();

        if ($reservation) {
            $startDate = $reservation->date_start;
            $endDate = $reservation->date_end;

            $datesInRange = [];
            $currentDate = $startDate;

            while ($currentDate < $endDate) {
                $datesInRange[] = $currentDate;
                $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
            }

            $this->info('Dates in range:');
            $this->table(['Date'], array_map(function ($date) {
                return [$date];
            }, $datesInRange));
        } else {
            $this->error('Reservation not found!');
        }
    }
}
