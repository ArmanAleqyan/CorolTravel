<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AddressController;
use App\Http\Controllers\Admin\TourOperatorsController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\TourCountryController;
use App\Http\Controllers\Admin\ToursController;
use App\Http\Controllers\Admin\HotelController;
use App\Http\Controllers\Admin\InfoOnasController;
use App\Http\Controllers\Admin\FAQController;
use App\Http\Controllers\Admin\GorodaViletaController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/NoAuth', function () {
    return response()->json([
        'status' => false,
        'message' => 'No Auth user'
    ],401);
})->name('NoAuth');
Route::get('/', function () {
    return redirect()->route('login');
});

Route::prefix('admin')->group(function () {
    Route::middleware(['NoAuthUser'])->group(function () {
        Route::get('/login',[AdminLoginController::class,'login'])->name('login');
        Route::post('/logined',[AdminLoginController::class,'logined'])->name('logined');
    });
    Route::middleware(['AuthUser'])->group(function () {
    Route::get('HomePage', [AdminLoginController::class,'HomePage'])->name('HomePage');
    Route::get('logoutAdmin', [AdminLoginController::class,'logoutAdmin'])->name('logoutAdmin');


    Route::get('all_goroda_vileta', [GorodaViletaController::class, 'all_goroda_vileta'])->name('all_goroda_vileta');
    Route::get('delete_goroda_vileta/city_id={id}', [GorodaViletaController::class, 'delete_goroda_vileta'])->name('delete_goroda_vileta');
    Route::post('create_goroda_vileta', [GorodaViletaController::class, 'create_goroda_vileta'])->name('create_goroda_vileta');

    Route::get('all_faqs', [FAQController::class, 'all_faqs'])->name('all_faqs');
    Route::get('create_faq_page', [FAQController::class, 'create_faq_page'])->name('create_faq_page');
    Route::get('single_page_faq/faq_id={id}', [FAQController::class, 'single_page_faq'])->name('single_page_faq');
    Route::get('delete_faq/faq_id={id}', [FAQController::class, 'delete_faq'])->name('delete_faq');
    Route::post('create_faq', [FAQController::class, 'create_faq'])->name('create_faq');
    Route::post('update_faq', [FAQController::class, 'update_faq'])->name('update_faq');

    Route::get('info_o_nas', [InfoOnasController::class,'info_o_nas'])->name('info_o_nas');
    Route::post('update_info_o_nas', [InfoOnasController::class,'update_info_o_nas'])->name('update_info_o_nas');

    Route::get('settingView', [AdminLoginController::class, 'settingView'])->name('settingView');
    Route::post('updatePassword', [AdminLoginController::class, 'updatePassword'])->name('updatePassword');

    Route::get('all_address', [AddressController::class, 'all_address'])->name('all_address');
    Route::get('create_address_page', [AddressController::class, 'create_address_page'])->name('create_address_page');
    Route::get('single_page_address/address_id={id}', [AddressController::class, 'single_page_address'])->name('single_page_address');
    Route::post('create_address', [AddressController::class, 'create_address'])->name('create_address');
    Route::post('update_address', [AddressController::class, 'update_address'])->name('update_address');


    Route::get('get_tour_operators', [TourOperatorsController::class, 'get_tour_operators'])->name('get_tour_operators');
    Route::get('create_tour_operator_page', [TourOperatorsController::class, 'create_tour_operator_page'])->name('create_tour_operator_page');
    Route::get('single_page_operator/operator_id={id}', [TourOperatorsController::class, 'single_page_operator'])->name('single_page_operator');
    Route::post('create_tour_operator', [TourOperatorsController::class, 'create_tour_operator'])->name('create_tour_operator');
    Route::post('update_tour_operator', [TourOperatorsController::class, 'update_tour_operator'])->name('update_tour_operator');

    Route::get('all_news', [NewsController::class, 'all_news'])->name('all_news');
    Route::get('create_news_page', [NewsController::class, 'create_news_page'])->name('create_news_page');
    Route::get('single_page_news/news_id={id}', [NewsController::class, 'single_page_news'])->name('single_page_news');
    Route::get('delete_news/news_id={id}', [NewsController::class, 'delete_news'])->name('delete_news');
    Route::post('create_news', [NewsController::class, 'create_news'])->name('create_news');
    Route::post('update_news', [NewsController::class, 'update_news'])->name('update_news');


    Route::get('all_tours_country', [TourCountryController::class,'all_tours_country'])->name('all_tours_country');
    Route::get('delete_country/country_id={id}', [TourCountryController::class,'delete_country'])->name('delete_country');
    Route::post('create_country', [TourCountryController::class,'create_country'])->name('create_country');


    Route::get('all_tourss', [ToursController::class, 'all_tourss'])->name('all_tourss');
    Route::get('create_tour_page', [ToursController::class, 'create_tour_page'])->name('create_tour_page');
    Route::get('single_page_tour/tour_id={id}', [ToursController::class, 'single_page_tour'])->name('single_page_tour');
    Route::get('delete_tour/tour_id={id}', [ToursController::class, 'delete_tour'])->name('delete_tour');
    Route::post('create_tour', [ToursController::class, 'create_tour'])->name('create_tour');
    Route::post('update_tour', [ToursController::class, 'update_tour'])->name('update_tour');




    Route::get('all_hotels', [HotelController::class, 'all_hotels'])->name('all_hotels');
    Route::get('create_hotel_page', [HotelController::class, 'create_hotel_page'])->name('create_hotel_page');
    Route::get('single_page_hotel/hotel_id={id}', [HotelController::class, 'single_page_hotel'])->name('single_page_hotel');
    Route::get('delete_hotel_photo/photo_id={id}', [HotelController::class, 'delete_hotel_photo'])->name('delete_hotel_photo');
    Route::get('delete_hotel/photo_id={id}', [HotelController::class, 'delete_hotel'])->name('delete_hotel');
    Route::post('create_hotel', [HotelController::class, 'create_hotel'])->name('create_hotel');
    Route::post('update_hotel', [HotelController::class, 'update_hotel'])->name('update_hotel');
    });
    });
