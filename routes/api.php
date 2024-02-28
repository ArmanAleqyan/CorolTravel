<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\TourController;
use App\Http\Controllers\Admin\InfoOnasController;
use App\Http\Controllers\Admin\FAQController;
use App\Http\Controllers\Admin\TourCountryController;
use App\Http\Controllers\Api\ApplyNowController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('get_address', [AddressController::class, 'get_address']);
Route::get('get_news', [NewsController::class, 'get_news']);
Route::get('single_page_news', [NewsController::class, 'single_page_news']);
Route::get('get_tours_country', [TourCountryController::class, 'get_tours_country']);
Route::get('get_tour', [TourController::class, 'get_tour']);
Route::get('single_page_tour', [TourController::class, 'single_page_tour']);
Route::get('get_stories', [TourController::class, 'get_stories']);
Route::get('get_tour_category', [TourController::class, 'get_tour_category']);

Route::get('get_info_o_nas', [InfoOnasController::class ,'get_info_o_nas']);
Route::get('get_all_faqs', [FAQController::class, 'get_all_faqs']);

Route::post('apply_now', [ApplyNowController::class,'apply_now']);
