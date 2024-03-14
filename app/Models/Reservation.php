<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'apart_id',
        'guestFirstName',
        'guestLastName',
        'date_start',
        'date_end',
        'fullPrice',
        'taxPrice',
        'guestNumber',
        'arrivalTime',
        'guestRegistered',
        'reservationType',
        'guestPaid',
        'guestHasCar',
        'guestDescription',
    ];

    public function getReservations($apartmentID){
        // dd($apartmentID);
        $getRes = DB::table('reservations')
                ->select('*')
                ->where('apart_id', $apartmentID)
                ->get();
// dd($getRes);
        return $getRes;
    }
}
