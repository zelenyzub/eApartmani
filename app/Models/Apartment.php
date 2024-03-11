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
                        ->select('id', 'apartmentName')
                        ->get();
// dd($queryApartName);
        return $queryApartName;
    }
}
