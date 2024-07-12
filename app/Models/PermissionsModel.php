<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PermissionsModel extends Model
{
    use HasFactory;
    public static function permissionsDetails($id)
    {
        return DB::table('users')
            ->where('id', $id)
            ->select('*')
            ->get();
    }

    public function savePermissionChanges($id, $canAddReservations, $canAllowReservations, $canDeleteReservations, $canEditReservations){
        $query = DB::table('users')
            ->where('id', $id)
            ->update([
                'canAddReservations' => $canAddReservations,
                'canAllowReservations' => $canAllowReservations,
                'canDeleteReservations' => $canDeleteReservations,
                'canEditReservations' => $canEditReservations
            ]);
        return $query;
    }
}
