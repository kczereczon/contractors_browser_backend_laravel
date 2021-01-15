<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use DateTime;
use Illuminate\Http\Request;

class FakedInvoicesController extends Controller
{
    public function show(Request $request, string $nip)
    {
        $data = [];
        $statuses = [
            "opłacona",
            "nieopłcona"
        ];
        for ($i=1; $i < 10; $i++) {
            $paymentDate = new DateTime();

            if($request->data_od) {
                $paymentDate = new DateTime($request->data_od." +1");
            }

            if($request->data_do) {
                $paymentDate = new DateTime($request->data_do." -1");
            }

            $date = $paymentDate->format("Y/m/d/");

            $data[] = [
                "ID" => $i,
                "Numer_faktury" => $date . $i,
                "NIP" => $nip,
                "Status" => $statuses[array_rand($statuses)],
                "Data_płatności" => $paymentDate->format("Y-m-d"),
                "Wartosc_faktury_brutto" => rand(100,10000)
            ];
        }

        return response()->json($data);
    }

    public function randomizedNip()
    {
        $random_number=''; 
        $count = 0;

        while ( $count < 10 ) {
            $random_digit = mt_rand(0, 9);
            
            $random_number .= $random_digit;
            $count++;
        }

        return $random_number;
    }
}
