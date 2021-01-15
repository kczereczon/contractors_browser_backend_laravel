<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

class InvoiceController extends Controller
{
    public function show(Request $request, string $nip)
    {
        $apiBase = env("INVOICES_API_BASE", null);

        if($apiBase) {
            return Http::get($apiBase."/".$nip);
        } else {
            $request = Request::create("/api/faked/invoices/".$nip, 'GET');
            return Route::dispatch($request);;     
        }
    }
}
