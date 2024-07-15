<?php

namespace App\Http\Controllers;

use App\Models\PermissionsModel;
use Illuminate\Http\Request;
use App\Models\User;

class Permissions extends Controller
{
    public function permissionsPage($id)
    {
        $user = User::find(session('user')->id);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $permissions = PermissionsModel::permissionsDetails($id);

        return view('permissionsPage', compact('user', 'id', 'permissions'));
    }

    public function savePermissionChanges(Request $request){
        $id = $request->id;
        $canAddReservations = $request->canAddReservations;
        $canAllowReservations = $request->canAllowReservations;
        $canDeleteReservations = $request->canDeleteReservations;
        $canEditReservations = $request->canEditReservations;

        $canAddApartments = $request->canAddApartments;
        $canEditApartments = $request->canEditApartments;
        $canDeleteApartments = $request->canDeleteApartments;

        $savePermissionChanges = new PermissionsModel();
        $savePermissionChanges->savePermissionChanges($id, $canAddReservations, $canAllowReservations, $canDeleteReservations, $canEditReservations, $canAddApartments, $canEditApartments, $canDeleteApartments);

        return response()->json(['message' => 'Uspesno sačuvano'], 200);
    }
}
