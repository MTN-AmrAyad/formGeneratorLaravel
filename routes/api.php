<?php

use App\Http\Controllers\FormController;
use App\Http\Controllers\ResponseFormController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::controller(FormController::class)->group(function () {
    Route::post('form-generate', 'store');
    Route::get('form-retriving', 'index');
});
Route::controller(ResponseFormController::class)->group(function () {
    Route::post('response-generate/{slug}', 'store');
    Route::get('response/{slug}', 'getSubmitionBySlug');
    // Route::get('form-retriving', 'index');
});
