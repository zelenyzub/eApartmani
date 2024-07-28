<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;

class IncomeController extends Controller
{
    public function incomeListPage()
    {
        $user = User::find(session('user')->id);
        $incomeData = Income::incomeData();
        // dd($incomeData);
        return view('incomeList', compact('user', 'incomeData'));
    }

    public function saveNewExpence(Request $request)
    {
        try {
            $apartID = $request->apartID;
            $description = $request->description;
            $amount = $request->amount;

            $query = new Income();
            $saveNewExpence = $query->saveNewExpence($apartID, $description, $amount);

            return json_encode($saveNewExpence, 200);
        }
        catch(Exception $ex) {
            return response() - json_encode(['error' => 'Greška prilikom čuvanja novog troška'], 500);
        }
    }
}
