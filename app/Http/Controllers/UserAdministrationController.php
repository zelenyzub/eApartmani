<?php

namespace App\Http\Controllers;

use App\Models\UserAdministration;
use Illuminate\Http\Request;
use Exception;
use App\Models\User;


class UserAdministrationController extends Controller
{
    public function userAdministration()
    {
        $user = User::find(session('user')->id);
        return view('userAdministration', compact('user'));
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

    public function getUserDataForEdit(Request $request)
    {
        try {
            $id = $request->id;
            $editUserData = new UserAdministration();
            $data = $editUserData->getUserDataForEdit($id);

            return response()->json(['data' => $data], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Greška prilikom uzimanja podataka korisnika!'], 500);
        }
    }

    public function editUser(Request $request)
    {
        try {
            $id = $request->id;
            $name = $request->name;
            $surname = $request->surname;
            $email = $request->email;
            $role = $request->role;

            $editData = new UserAdministration();
            $editData->editUser($id, $name, $surname, $email, $role);
            // dd($request->all());
            return response()->json(['message' => 'Uspesno izmenjeno'], 200);

        } catch (Exception $ex) {
            return response() - json_encode(['error' => 'Greska prilikom izmene korisnika.'], 500);
        }



    }
}
