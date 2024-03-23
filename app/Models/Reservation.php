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

    public function reservationsTable($request)
    {
        $start = isset($request['start']) ? $request['start'] : 0;
        $length = isset($request['length']) ? $request['length'] : 0;
        $sort = 'reservations.id';
        $sorting = 'asc';
        $search = isset($request['search']['value']) ? $request['search']['value'] : 0;

        if (isset($request['order'][0]['column'])) {
            switch ($request['order'][0]['column']) {
                case '0':
                    $sort = 'reservations.id';
                    break;
                case '1':
                    $sort = 'reservations.guestFirstName';
                    break;
                case '2':
                    $sort = 'reservations.date_start';
                    break;
            }
        }

        $getReservations = DB::table('reservations')
            ->select('id', 'guestFirstName', 'guestLastName', 'date_start', 'date_end', 'fullPrice')
            ->orderBy($sort, $sorting);

        if (!empty($search)) {
            $getReservations = $getReservations->whereRaw("guestFirstName LIKE '%{$search}%' OR guestLastName LIKE '%{$search}%' OR date_start LIKE '%{$search}%' OR fullPrice LIKE '%{$search}%'");
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
}
