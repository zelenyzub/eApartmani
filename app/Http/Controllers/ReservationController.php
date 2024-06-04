<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Reservation;
use App\Notifications\AllowReservationNotifications;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ReservationsNotifications;


class ReservationController extends Controller
{
    public function reservations()
    {
        $user = User::find(session('user')->id);
        return view('reservations', compact('user'));
    }
    public function getReservations(Request $request)
    {

        try {
            $apartmentID = $request->apartID;
            $query = new Reservation();
            $getRes = $query->getReservations($apartmentID);

            return response()->json($getRes, 200);
        } catch (Exception $ex) {
            return response() - json_encode(['error' => 'Greska u učitavanju naziva apartmana.'], 500);
        }
    }

    public function updateGuestRegistered(Request $request)
    {
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

    public function updateGuestPaid(Request $request)
    {
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

    public function updateGuestHasCar(Request $request)
    {
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
            return response() - json_encode(['error' => 'Greska prilikom ucitavanja tabele rezervacija.'], 500);
        }
    }

    public function newReservation(Request $request)
    {
        try {
            $apartID = $request->apartID;
            $guestFirstName = $request->guestFirstName;
            $guestLastName = $request->guestLastName;
            $dateStart = $request->dateStart;
            $dateEnd = $request->dateEnd;
            $fullPrice = $request->fullPrice;
            $taxPrice = $request->taxPrice;
            $guestNumber = $request->guestNumber;
            $arrivalTime = $request->arrivalTime;
            $reservationType = $request->reservationType;
            $guestPaid = $request->guestPaid;
            $guestDescription = $request->guestDescription;

            $userID = session('user')->id;

            // dd($guestPaid);
            if (session('user')->role == "SUPERADMIN") {
                $checkRole = 1;
            } else {
                $checkRole = 0;
            }

            $query = new Reservation();
            $addReservation = $query->newReservation(
                $apartID,
                $guestFirstName,
                $guestLastName,
                $dateStart,
                $dateEnd,
                $fullPrice,
                $taxPrice,
                $guestNumber,
                $arrivalTime,
                $reservationType,
                $guestPaid,
                $guestDescription,
                $checkRole,
                $userID
            );

            $user = User::All();
            // dd(session('user')->surname);
            $apartName = Apartment::getApartmentNameForNotification($apartID);
            if (session('user')->role === "SUPERADMIN") {
                $message = session('user')->name . ' ' . session('user')->surname . ' je dodao novu rezervaciju za apartman - ' . $apartName[0]->apartmentName . '. ';
            } else {
                $message = session('user')->name . ' ' . session('user')->surname . ' je dodao novi zahtev za rezervaciju za apartman - ' . $apartName[0]->apartmentName . '. ';
                foreach ($user as $u) {
                    if ($u->role === "SUPERADMIN") {
                        $user = $u;
                    }
                }
            }
            $notificationPath = "/rezervacije";
            Notification::sendNow($user, new ReservationsNotifications($message, $notificationPath, $apartName));
            return json_encode($addReservation, 200);
        } catch (Exception $ex) {
            dd($ex->getMessage());
            return response() - json_encode(['error' => 'Greska prilikom dodavanja nove rezervacije.'], 500);
        }

    }

    public function allowReservation(Request $request)
    {
        try {
            $id = $request->id;
            $allowReservation = new Reservation();
            $allowReservation->allowReservation($id);

            $user = User::All();
            $message = session('user')->name . ' ' . session('user')->surname . ' je odobrio rezervaciju.';

            $notificationPath = "/rezervacije";
            Notification::sendNow($user, new AllowReservationNotifications($message, $notificationPath));
            return response()->json(['message' => 'Uspesno odobreno'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Greška prilikom odobravanja rezervacije!'], 500);
        }
    }

    public function deleteReservation(Request $request)
    {
        try {
            $id = $request->id;
            $deleteReservation = new Reservation();
            $deleteReservation->deleteReservation($id);

            return response()->json(['message' => 'Uspesno obrisana rezervacija'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Greška prilikom brisanja rezervacije!'], 500);
        }
    }

    public function editReservation(Request $request) {
        try {
            // dd($request);
            $id = $request->id;
            $apartID = $request->apartID;
            $firstName = $request->firstName;
            $lastName = $request->lastName;
            $dateStart = $request->dateStart;
            $dateEnd = $request->dateEnd;
            $fullPrice = $request->fullPrice;
            $taxPrice = $request->taxPrice;
            $guestNumber = $request->guestNumber;
            $arrivalTime = $request->arrivalTime;
            $reservationType = $request->reservationType;
            $guestPaid = $request->guestPaid;
            $guestDescription = $request->guestDescription;

            $editReservation = new Reservation();
            $editReservation->editReservation($id, $apartID, $firstName, $lastName, $dateStart, $dateEnd, 
            $fullPrice, $taxPrice, $guestNumber, $arrivalTime, $reservationType, $guestPaid, $guestDescription);

            return response()->json(['message' => 'Uspesno izmenjeno'], 200);

        } catch (Exception $ex) {
            return response() - json_encode(['error' => 'Greska prilikom izmene rezervacije.'], 500);
        }
    }

    public function getReservationDataForEdit(Request $request)
    {
        try {
            $id = $request->id;
            $editReservationData = new Reservation();
            $data = $editReservationData->getReservationDataForEdit($id);

            return response()->json(['data' => $data], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Greška prilikom uzimanja podataka o rezervaciji!'], 500);
        }
    }
}
