<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;


class IncomeController extends Controller
{
    public function incomeListPage()
    {
        $user = User::find(session('user')->id);
        $incomeData = Income::incomeData();
        $canManagePercentage = $user->canManagePercentage;
        $canManageAdditionalExpences = $user->canManageAdditionalExpences;
        $canExportExpences = $user->canExportExpences;
        // dd($user);
        return view('incomeList', compact('user', 'incomeData', 'canManagePercentage', 'canManageAdditionalExpences', 'canExportExpences'));
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
        } catch (Exception $ex) {
            return response() - json_encode(['error' => 'Greška prilikom čuvanja novog troška'], 500);
        }
    }


    public function exportInvoiceTxt(Request $request)
    {
        $apartID = $request->apartID;
        $query = new Income();
        $getInvoiceExportData = $query->getInvoiceExportData($apartID);
    
        $reservationsInvoice = $getInvoiceExportData['reservationsInvoice'];
        $expencesInvoice = $getInvoiceExportData['expencesInvoice'];
    
        $txtData = "Rezervacije za apartman:\n";
        if (!empty($reservationsInvoice)) {
            foreach ($reservationsInvoice as $reservation) {
                $txtData .= "Datum rezervacije: {$reservation->date_start} - {$reservation->date_end} Cena rezervacije: {$reservation->fullPrice}\n";
            }
        } else {
            $txtData .= "Nema rezervacija.\n";
        }
    
        $txtData .= "\nDodatni troškovi:\n";
        if (!empty($expencesInvoice)) {
            foreach ($expencesInvoice as $expense) {
                $txtData .= "Opis dodatnog troška: {$expense->expencesDescription}, Cena dodatnog troška: {$expense->expencesPrice}\n";
            }
        } else {
            $txtData .= "Nema dodatnih troškova.\n";
        }
    
        // Create a response for the file download
        return Response::make($txtData, 200, [
            'Content-Type' => 'text/plain',
            'Content-Disposition' => 'attachment; filename="izvod_apartman.txt"',
        ]);
    }


}
