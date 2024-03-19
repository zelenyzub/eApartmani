<?php

namespace App\Http\Controllers;

use App\Models\UserAdministration;
use Illuminate\Http\Request;
use Exception;


class UserAdministrationController extends Controller
{
    public function userAdministration()
    {
        return view('userAdministration');
    }

    public function getUserData(Request $request)
    {
        try {
            $getUserData = new UserAdministration();
            $modalData = $getUserData->usersTable($request);

            $data['draw'] = $request->input('draw');
            $data['recordsFiltered'] = $modalData['recordsFiltered'];
            $data['recordsTotal'] = count($modalData['recordsTotal']);
            $data['data'] = $modalData['data'];

            return json_encode($data, 200);
        } catch (Exception $ex) {
            return response() - json_encode(['error' => 'Greska prilikom ucitavanja tabele korisnika.'], 500);
        }
    }

    public function deleteUser(Request $request)
    {
        try {
            $id = $request->id;
            $deleteUser = new UserAdministration();
            $deleteUser->deleteUser($id);

            return response()->json(['message' => 'Uspesno obrisano'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Greška prilikom brisanja korisnika!'], 500);
        }
    }
}
