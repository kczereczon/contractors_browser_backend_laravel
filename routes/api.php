<?php

use App\Http\Controllers\Api\ContractorController;
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
Route::prefix('web')->group(function () {
    Route::get('departament/all', [WebDepartamentController::class, 'getDepartamentAll']);
    Route::resource('contractor', WebContractorController::class);
    Route::resource('contact', WebContactController::class);
    Route::resource('departament', WebDepartamentController::class);
    
});

