<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Apartment extends Model
{
    use HasFactory;
    protected $fillable = [
        'apartmentName',
        'gmLocation',
        'apartmentPhotos',
        'apartmentCapacity',
        'apartmentDescription',
        'ownerFirstName',
        'ownerLastName',
        'apartmentAddress',
        'aditionalApartInfo',
        'wifiPassword',
        'parking',
    ];

    public function getApartmentName()
    {
        $queryApartName = DB::table('apartments')
            ->select('id', 'apartmentName', 'apartmentCapacity')
            ->get();
        return $queryApartName;
    }

    public static function getApartmentNameForNotification($apartID)
    {
        $queryApartName = DB::table('apartments')
            ->select('id', 'apartmentName')
            ->where('id', $apartID)
            ->get();
        return $queryApartName;
    }

    public function apartmentList($request)
    {
        $start = isset($request['start']) ? $request['start'] : 0;
        $length = isset($request['length']) ? $request['length'] : 0;
        $sort = 'apartments.apartmentName';
        $sorting = 'asc';
        $search = isset($request['search']['value']) ? $request['search']['value'] : 0;

        if (isset($request['order'][0]['column'])) {
            switch ($request['order'][0]['column']) {
                case '0':
                    $sort = 'apartments.apartmentName';
                    break;
                case '1':
                    $sort = 'apartments.id';
                    break;
                case '2':
                    $sort = 'apartments.apartmentCapacity';
                    break;
            }
        }

        $getApartmentList = DB::table('apartments')
            ->select('apartments.id', 'apartments.apartmentName', 'apartments.apartmentPhotos', 'apartments.gmLocation', 'apartments.apartmentCapacity')
            ->orderBy($sort, $sorting);

        if (!empty($search)) {
            $getApartmentList = $getApartmentList->whereRaw("apartments.apartmentName LIKE '%{$search}%'");
        }

        $recordsFiltered = $getApartmentList->count();
        $recordsTotal = $getApartmentList->offset($start)->limit($length);
        $data = $getApartmentList->get();

        return [
            'recordsFiltered' => $recordsFiltered,
            'recordsTotal' => $recordsTotal,
            'data' => $data,
        ];
    }
}
