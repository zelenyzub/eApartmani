<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use Exception;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function getApartmentName()
    {
        try {
            $modalQuery = new Apartment();
            $queryApartName = $modalQuery->getApartmentName();
            // dd($queryApartName);
            return json_encode($queryApartName, 200);
        } catch (Exception $ex) {
            return response() - json_encode(['error' => 'Greska u učitavanju naziva apartmana.'], 500);
        }
    }
}
