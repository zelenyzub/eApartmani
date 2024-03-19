<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class UserAdministration extends Model
{
    use HasFactory;

    public function usersTable($request) {
        $start = isset($request['start']) ? $request['start'] : 0;
        $length = isset($request['length']) ? $request['length'] : 0;
        $sort = 'users.id';
        $sorting = 'asc';
        $search = isset($request['search']['value']) ? $request['search']['value'] : 0;

        if (isset($request['order'][0]['column'])) {
            switch ($request['order'][0]['column']) {
                case '0':
                    $sort = 'users.id';
                    break;
                case '1':
                    $sort = 'users.name';
                    break;
            }
        }

        $getUserData = DB::table('users')
                ->select('id', 'name', 'surname', 'email', 'role')
                ->orderBy($sort, $sorting);

        if(!empty($search)) {
            $getUserData = $getUserData->whereRaw("name LIKE '%{$search}%' OR surname LIKE '%{$search}%' OR email LIKE '%{$search}%'");
        }

        $recordsFiltered = $getUserData->count();
        $recordsTotal = $getUserData->offset($start)->limit($length)->get();
        $data = $getUserData->get();

        return [
            'recordsFiltered' => $recordsFiltered,
            'recordsTotal' => $recordsTotal,
            'data' => $data,
        ];
    }

    public function deleteUser($id) {
        DB::table('users')
            ->where('id', $id)
            ->delete();
    }
}
