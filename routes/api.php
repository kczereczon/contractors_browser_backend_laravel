<?php

use App\Http\Controllers\Api\ContractorController;
use App\Http\Controllers\Web\ContractorController as WebContractorController;
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
    Route::resource('contractor', WebContractorController::class);
});
