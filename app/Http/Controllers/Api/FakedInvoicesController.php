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
            "paid",
            "unpaid"
        ];
        for ($i=1; $i < 10; $i++) {
            $paymentDate = new DateTime();

            if($request->date_from) {
                $paymentDate = new DateTime($request->date_from." +1");
            }

            if($request->date_to) {
                $paymentDate = new DateTime($request->date_to." -1");
            }

            $date = $paymentDate->format("Y/m/d/");

            $data[] = [
                "id" => $i,
                "nip" => $nip,
                "invoice_status" => $statuses[array_rand($statuses)],
                "invoice_number" => $i.'/'.date("Y"),
                "invoice_date" => $paymentDate->format("Y-m-d"),
                "due_date" => $paymentDate->format("Y-m-d"),
                "total" => rand(100,10000)
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
