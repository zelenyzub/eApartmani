<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
