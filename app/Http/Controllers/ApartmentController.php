<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use Exception;
use Illuminate\Http\Request;
use App\Models\User;

class ApartmentController extends Controller
{
    public function getApartmentName()
    {
        try {
            $user = User::find(session('user')->id);
            $modalQuery = new Apartment();
            $queryApartName = $modalQuery->getApartmentName();
            // dd($queryApartName);
            return json_encode($queryApartName, 200);
        } catch (Exception $ex) {
            return response() - json_encode(['error' => 'Greska u učitavanju naziva apartmana.'], 500);
        }
    }
}
