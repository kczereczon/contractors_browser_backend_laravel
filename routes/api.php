<?php

use App\Http\Controllers\Api\ContractorController;
use App\Http\Controllers\Api\FakedInvoicesController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\Web\ContractorController as WebContractorController;
use App\Http\Controllers\Web\ContactController as WebContactController;
use App\Http\Controllers\Web\DepartamentController as WebDepartamentController;
use App\Models\Departament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('contractor', ContractorController::class, ['as'=>'api']);
Route::get('/faked/invoices/{nip}', [FakedInvoicesController::class, 'show']);
Route::get('/invoices/{contractor}', [InvoiceController::class, 'show']);
Route::prefix('web')->group(function () {
    Route::get('/departament/contractor/{id}', [WebDepartamentController::class, 'getContractorDepartament']);
    Route::get('/contact/departament/{id}', [WebDepartamentController::class, 'getDepartamentContact']);
    Route::get('/departament/contact/{id}', [WebDepartamentController::class, 'getContactDepartament']);
    Route::get('/contact/contractor/{id}', [WebContactController::class, 'getContractorContact']);
    Route::get('/departament/all', [WebDepartamentController::class, 'getDepartamentAll']);
    Route::resource('contractor', WebContractorController::class);
    Route::resource('contact', WebContactController::class);
    Route::resource('departament', WebDepartamentController::class);
});

