<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;

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

    public function getReservations($apartmentID)
    {
        $getRes = DB::table('reservations')
            ->select('*')
            ->where('apart_id', $apartmentID)
            ->where('checkRole', 1)
            ->get();
        return $getRes;
    }

    public function updateGuestRegistered($id, $guestRegistered)
    {
        $query = DB::table('reservations')
            ->where('id', $id)
            ->update([
                'guestRegistered' => $guestRegistered
            ]);
        return $query;
    }

    public function updateGuestPaid($id, $guestPaid)
    {
        $query = DB::table('reservations')
            ->where('id', $id)
            ->update([
                'guestPaid' => $guestPaid
            ]);
        return $query;
    }

    public function updateGuestHasCar($id, $guestHasCar)
    {
        $query = DB::table('reservations')
            ->where('id', $id)
            ->update([
                'guestHasCar' => $guestHasCar
            ]);
        return $query;
    }

    public function reservationsTable($request)
    {
        $start = isset($request['start']) ? $request['start'] : 0;
        $length = isset($request['length']) ? $request['length'] : 0;
        $sort = 'reservations.date_start';
        $sorting = 'desc';
        $search = isset($request['search']['value']) ? $request['search']['value'] : 0;

        if (isset($request['order'][0]['column'])) {
            switch ($request['order'][0]['column']) {
                case '0':
                    $sort = 'reservations.date_start';
                    break;
                case '1':
                    $sort = 'reservations.guestFirstName';
                    break;
                case '2':
                    $sort = 'reservations.id';
                    break;
            }
        }

        if (isset($request['filterApart'])) {
            $filterApart = $request['filterApart'];
        }
        if (isset($request['filterResStatus'])) {
            $filterResStatus = $request['filterResStatus'];
        }
        if (isset($request['filterResType'])) {
            $filterResType = $request['filterResType'];
        }

        $getReservations = DB::table('reservations')
            ->join('users', 'reservations.user_id', '=', 'users.id')
            ->join('apartments', 'reservations.apart_id', '=', 'apartments.id')
            ->select('reservations.id', 'reservations.guestFirstName', 'reservations.guestLastName', 'reservations.date_start', 'reservations.date_end', 'reservations.fullPrice', 'reservations.checkRole', 'users.name', 'users.surname', 'apartments.apartmentName')
            ->orderBy($sort, $sorting);

        if (!empty($search)) {
            $getReservations = $getReservations->whereRaw("reservations.guestFirstName LIKE '%{$search}%' OR reservations.guestLastName LIKE '%{$search}%' OR reservations.date_start LIKE '%{$search}%' OR reservations.fullPrice LIKE '%{$search}%'  OR users.name LIKE '%{$search}%' OR users.surname LIKE '%{$search}%' OR apartments.apartmentName LIKE '%{$search}%'");
        }
        if (!empty($filterApart)) {
            $getReservations = $getReservations->where('reservations.apart_id', $filterApart);
        }
        if ($filterResStatus != '') {
            $getReservations = $getReservations->where('reservations.checkRole', $filterResStatus);
        }
        if (!empty($filterResType)) {
            $getReservations = $getReservations->where('reservations.reservationType', $filterResType);
        }
        $recordsFiltered = $getReservations->count();
        $recordsTotal = $getReservations->offset($start)->limit($length)->get();
        $data = $getReservations->get();

        return [
            'recordsFiltered' => $recordsFiltered,
            'recordsTotal' => $recordsTotal,
            'data' => $data,
        ];
    }

    public function newReservation(
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
    ) {
        $hours = isset($arrivalTime['HH']) ? $arrivalTime['HH'] : '00';
        $minutes = isset($arrivalTime['mm']) ? $arrivalTime['mm'] : '00';

        $formattedArrivalTime = sprintf("%02d:%02d:00", $hours, $minutes);
        $data = [
            'apart_id' => $apartID,
            'guestFirstName' => $guestFirstName,
            'guestLastName' => $guestLastName,
            'date_start' => $dateStart ? Carbon::parse($dateStart)->toDateString() : null,
            'date_end' => $dateEnd ? Carbon::parse($dateEnd)->toDateString() : null,
            'fullPrice' => $fullPrice,
            'taxPrice' => $taxPrice,
            'guestNumber' => $guestNumber,
            'arrivalTime' => $formattedArrivalTime,
            'reservationType' => $reservationType,
            'guestPaid' => $guestPaid,
            'guestDescription' => $guestDescription,
            'created_at' => Carbon::now(),
            'checkRole' => $checkRole,
            'user_id' => $userID
        ];

        $query = DB::table('reservations')
            ->insertGetId($data);
        return $query;
    }

    public function allowReservation($id)
    {
        $query = DB::table('reservations')
            ->where('id', $id)
            ->update(['checkRole' => 1]);
        return $query;
    }

    public function deleteReservation($id)
    {
        DB::table('reservations')
            ->where('id', $id)
            ->delete();
    }

    public function getReservationDataForEdit($id)
    {
        $query = DB::table('reservations')
            ->where('id', $id)
            ->get();
        return $query;
    }

    public function editReservation(
        $id,
        $apartID,
        $firstName,
        $lastName,
        $dateStart,
        $dateEnd,
        $fullPrice,
        $taxPrice,
        $guestNumber,
        $arrivalTime,
        $reservationType,
        $guestPaid,
        $guestDescription
    ) {
        $query = DB::table('reservations')
            ->where('id', $id)
            ->update([
                'apart_id' => $apartID,
                'guestFirstName' => $firstName,
                'guestLastName' => $lastName,
                'date_start' => $dateStart ? Carbon::parse($dateStart)->toDateString() : null,
                'date_end' => $dateEnd ? Carbon::parse($dateEnd)->toDateString() : null,
                'fullPrice' => $fullPrice,
                'taxPrice' => $taxPrice,
                'guestNumber' => $guestNumber,
                'arrivalTime' => $arrivalTime,
                'reservationType' => $reservationType,
                'guestPaid' => $guestPaid,
                'guestDescription' => $guestDescription,
            ]);
        return $query;
    }

    public static function getDisabledDates($apartId)
    {
        $reservation = DB::table('reservations')
            ->select('date_start', 'date_end')
            ->where('apart_id', $apartId)
            ->first();

            $startDate = $reservation->date_start;
            $endDate = $reservation->date_end;

            $datesInRange = [];
            $currentDate = $startDate;

            while ($currentDate < $endDate) {
                $datesInRange[] = $currentDate;
                $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
            }

        // dd($datesInRange);
        return $datesInRange;
    }
}
