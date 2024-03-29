<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class CalendarController extends Controller
{
    public function calendar(){
        $user = User::find(session('user')->id);
        return view('calendar', compact('user'));
    }
}
