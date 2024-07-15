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
        $canAddApartments = $user->canAddApartments;
        $canEditApartments = $user->canEditApartments;
        $canDeleteApartments = $user->canDeleteApartments;

        return view('apartmentList', compact('user', 'canAddApartments', 'canEditApartments', 'canDeleteApartments'));
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

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $imagePath = $request->file('avatar')->store('public/apartments');

            // Save to another location
            $destinationPath = 'assets/media/stock/ecommerce';
            $imageName = $request->file('avatar')->getClientOriginalName();
            $myPath = str_replace('public/apartments/', '', $imagePath);
            $request->file('avatar')->move($destinationPath, $myPath);

            // Remove 'public/' from the image path
            $relativeImagePath = str_replace('public/', '', $imagePath);
            return response()->json(['image_path' => $relativeImagePath]);
        }

        return response()->json(['error' => 'No valid image uploaded'], 400);
    }


    public function addApartment(Request $request)
    {
        try {
            // dd($request->all());
            $parkingStatus = $request->input('parkingStatus');
            $gmLocation = $request->input('gmLocation');
            $apartmentName = $request->input('apartmentName');
            $apartmentAddress = $request->input('apartmentAddress');
            $apartmentCapacity = $request->input('apartmentCapacity');
            $wifiPassword = $request->input('wifiPassword');
            $apartmentDescription = $request->input('apartmentDescription');
            $ownerFirstName = $request->input('ownerFirstName');
            $ownerLastName = $request->input('ownerLastName');
            $aditionalApartInfo = $request->input('aditionalApartInfo');
            $avatar = $request->input('avatar');
            // dd($avatar);
            $validatedData = $request->validate([
                'parkingStatus' => 'required',
                'gmLocation' => 'required',
                'apartmentName' => 'required',
                'apartmentAddress' => 'required',
                'apartmentCapacity' => 'required|numeric',
                'wifiPassword' => 'required',
                'apartmentDescription' => 'nullable',
                'ownerFirstName' => 'required',
                'ownerLastName' => 'required',
                'aditionalApartInfo' => 'nullable',
                'avatar' => 'required'
            ]);

            $apartment = Apartment::addApartment(
                $parkingStatus,
                $gmLocation,
                $apartmentName,
                $apartmentAddress,
                $apartmentCapacity,
                $wifiPassword,
                $apartmentDescription,
                $ownerFirstName,
                $ownerLastName,
                $aditionalApartInfo,
                $avatar
            );

            return response()->json(['message' => 'Apartman uspješno dodat', 'apartment' => $apartment]);
        } catch (Exception $e) {
            return response()->json(['message' => 'Došlo je do greške prilikom dodavanja apartmana: ' . $e->getMessage()], 500);
        }
    }

    public function getApartDeailedInfo(Request $request){
        $apartID = $request->apartID;
        $details = Apartment::getApartDeailedInfo($apartID);
        
        return response()->json($details);
    }

}
