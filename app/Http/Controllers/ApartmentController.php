<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use Exception;
use Illuminate\Http\Request;
use App\Models\User;

class ApartmentController extends Controller
{
    public function apartmentListPage()
    {
        $user = User::find(session('user')->id);
        return view('apartmentList', compact('user'));
    }

    public function addApartmentPage()
    {
        $user = User::find(session('user')->id);
        return view('addApartmentPage', compact('user'));
    }
    
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
    public function apartmentList(Request $request)
{
    try {
        $getApartmentList = new Apartment();
        $modalData = $getApartmentList->apartmentList($request);

        $recordsTotal = $modalData['recordsTotal']->get();

        $data['draw'] = $request->input('draw');
        $data['recordsFiltered'] = $modalData['recordsFiltered'];
        $data['recordsTotal'] = $recordsTotal->count(); 
        $data['data'] = $modalData['data'];

        return response()->json($data, 200);
    } catch (Exception $ex) {
        return response()->json(['error' => 'Greska prilikom ucitavanja liste apartmana.'], 500);
    }
}

}
