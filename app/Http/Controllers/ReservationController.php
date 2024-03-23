<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Exception;


class ReservationController extends Controller
{
        public function reservations(){
            return view('reservations');
        }
    public function getReservations(Request $request) {

        try {
            $apartmentID = $request->apartID;
            $query = new Reservation();
            $getRes = $query->getReservations($apartmentID);

            return response()->json($getRes, 200);
        } catch (Exception $ex) {
            return response() - json_encode(['error' => 'Greska u učitavanju naziva apartmana.'], 500);
        }
    }

    public function updateGuestRegistered(Request $request) {
        try {
            $id = $request->id;
            $guestRegistered = $request->guestRegistered;
            $query = new Reservation();
            $query->updateGuestRegistered($id, $guestRegistered);
            return response()->json(['message' => 'Uspesno izmenjeno'], 200);

        } catch (Exception $ex) {
            return response() - json_encode(['error' => 'Greska prilikom promene statusa prijave boravka.'], 500);
        }
    }

    public function updateGuestPaid(Request $request) {
        try {
            $id = $request->id;
            $guestPaid = $request->guestPaid;
            $query = new Reservation();
            $query->updateGuestPaid($id, $guestPaid);
            return response()->json(['message' => 'Uspesno izmenjeno'], 200);

        } catch (Exception $ex) {
            return response() - json_encode(['error' => 'Greska prilikom promene statusa prijave boravka.'], 500);
        }
    }

    public function updateGuestHasCar(Request $request) {
        try {
            $id = $request->id;
            $guestHasCar = $request->guestHasCar;
            $query = new Reservation();
            $query->updateGuestHasCar($id, $guestHasCar);
            return response()->json(['message' => 'Uspesno izmenjeno'], 200);

        } catch (Exception $ex) {
            return response() - json_encode(['error' => 'Greska prilikom promene statusa prijave boravka.'], 500);
        }
    }

    public function reservationsTable(Request $request)
    {
        try {
            $getReservations = new Reservation();
            $modalData = $getReservations->reservationsTable($request);

            $data['draw'] = $request->input('draw');
            $data['recordsFiltered'] = $modalData['recordsFiltered'];
            $data['recordsTotal'] = count($modalData['recordsTotal']);
            $data['data'] = $modalData['data'];

            return json_encode($data, 200);
        } catch (Exception $ex) {
            return response() - json_encode(['error' => 'Greska prilikom ucitavanja tabele korisnika.'], 500);
        }
    }
}
