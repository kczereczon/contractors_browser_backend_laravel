<?php

namespace App\Http\Controllers;

use App\Models\Contractor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

class InvoiceController extends Controller
{
    public function show(Request $request, Contractor $contractor)
    {
        $apiBase = env("INVOICES_API_BASE", null);

        if (!empty($apiBase)) {
            $response = Http::get(
                $apiBase . "/" . $contractor['nip'],
                [
                    "date_from" => $request->date_from,
                    "date_to" => $request->date_from,
                ]

            );
            return $response->json();
        } else {
            $requestCall = Request::create(
                "/api/faked/invoices/" . $contractor['nip'],
                'GET',
                [
                    "date_from" => $request->date_from,
                    "date_to" => $request->date_from,
                ]
            );
            return Route::dispatch($requestCall);
        }
    }
}
