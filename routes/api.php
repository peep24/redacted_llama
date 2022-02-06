<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ethAPIController;
use App\Http\Controllers\API\authAPIController;


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

// Public routes
Route::post('/register', [authAPIController::class, 'register']);
Route::post('/login', [authAPIController::class, 'login']);


// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [authAPIController::class, 'logout']);
    Route::post('/balance', [ethAPIController::class, 'getBalance']);
    Route::post('/bank_balance', [ethAPIController::class, 'getBankBalance']);
    Route::post('/fund', [ethAPIController::class, 'fund']);
    Route::post('/getAccounts', [ethAPIController::class, 'updateAccounts']);
    
    Route::post('/test', [authAPIController::class, 'test']);

});



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
