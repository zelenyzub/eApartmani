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
        $getRes = DB::table('reservations')
                ->select('*')
                ->where('apart_id', $apartmentID)
                ->get();
        return $getRes;
    }

    public function updateGuestRegistered($id, $guestRegistered) {
        $query = DB::table('reservations')
            ->where('id',$id)
            ->update([
                'guestRegistered' => $guestRegistered
            ]);
        return $query;
    }

    public function updateGuestPaid($id, $guestPaid) {
        $query = DB::table('reservations')
            ->where('id',$id)
            ->update([
                'guestPaid' => $guestPaid
            ]);
        return $query;
    }

    public function updateGuestHasCar($id, $guestHasCar) {
        $query = DB::table('reservations')
            ->where('id',$id)
            ->update([
                'guestHasCar' => $guestHasCar
            ]);
        return $query;
    }
}
