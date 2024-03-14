<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Exception;


class ReservationController extends Controller
{
    public function getReservations(Request $request) {

        try {
            $apartmentID = $request->apartID;
// dd($apartmentID);
            $query = new Reservation();
            $getRes = $query->getReservations($apartmentID);
            // dd($getRes);
            return response()->json($getRes, 200);
        } catch (Exception $ex) {
            return response() - json_encode(['error' => 'Greska u učitavanju naziva apartmana.'], 500);
        }
    }
}
