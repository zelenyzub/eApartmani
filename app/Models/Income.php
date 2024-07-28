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
                    ->whereYear('reservations.created_at', $currentYear);
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
                DB::raw('COALESCE(exp.totalExpencesPrice, 0) as totalExpencesPrice')
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
}
