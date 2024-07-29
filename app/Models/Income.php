<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Income extends Model
{
    use HasFactory;

    public static function incomeData()
    {
        $currentYear = date('Y');
    
        $incomeData = DB::table('apartments')
            ->leftJoin('reservations', function ($join) use ($currentYear) {
                $join->on('apartments.id', '=', 'reservations.apart_id')
                    ->whereYear('reservations.date_start', $currentYear);
            })
            ->leftJoin(DB::raw('(SELECT apart_id, SUM(expencesPrice) as totalExpencesPrice 
            FROM expences 
            WHERE YEAR(created_at) = ' . $currentYear . '
            GROUP BY apart_id) as exp'), 'apartments.id', '=', 'exp.apart_id')
            ->select(
                'apartments.id',
                'apartments.apartmentName',
                'apartments.apartmentPhotos',
                DB::raw('SUM(reservations.fullPrice) as totalFullPrice'),
                DB::raw('SUM(reservations.taxPrice) as totalTaxPrice'),
                DB::raw('IFNULL(SUM(exp.totalExpencesPrice), 0) as totalExpencesPrice')
            )
            ->groupBy('apartments.id', 'apartments.apartmentName', 'apartments.apartmentPhotos')
            ->get();
    
        return $incomeData;
    }

    public function saveNewExpence($apartID, $description, $amount)
    {
        $data = [
            'apart_id' => $apartID,
            'expencesDescription' => $description,
            'expencesPrice' => $amount,
            'created_at' => Carbon::now()
        ];

        $query = DB::table('expences')
            ->insertGetId($data);
        return $query;
    }
    public function getInvoiceExportData($apartID)
    {
        $currentYear = date('Y');

        $reservationsInvoice = DB::table('reservations')
            ->join('apartments', 'reservations.apart_id', '=', 'apartments.id')
            ->where('reservations.apart_id', $apartID)
            ->whereYear('reservations.date_start', $currentYear)
            ->select(
                'reservations.date_start',
                'reservations.date_end',
                'reservations.fullPrice',
                'apartments.apartmentName'
            )
            ->get();

        $expencesInvoice = DB::table('expences')
            ->join('apartments', 'expences.apart_id', '=', 'apartments.id')
            ->where('expences.apart_id', $apartID)
            ->whereYear('expences.created_at', $currentYear)
            ->select(
                'expences.expencesDescription',
                'expences.expencesPrice',
                'apartments.apartmentName'
            )
            ->get();

        // dd($reservationsInvoice, $expencesInvoice);
        return [
            'reservationsInvoice' => $reservationsInvoice,
            'expencesInvoice' => $expencesInvoice
        ];
    }

}
