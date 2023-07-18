<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\Panel\BranchController;
use App\Http\Controllers\Panel\BrokerController;
use App\Http\Controllers\Panel\CityController;
use App\Http\Controllers\Panel\ClientController;
use App\Http\Controllers\Panel\NeighborhoodController;
use App\Http\Controllers\Panel\OfferController;
use App\Http\Controllers\Panel\OrderController;
use App\Http\Controllers\Panel\ReservationController;
use App\Http\Controllers\Panel\SaleController;
use App\Http\Controllers\Panel\UserController;
use App\Http\Controllers\PanelViewsController;
use App\Http\Controllers\WebViewsController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('index', [Controller::class, 'index'])->name('index');

Route::controller(WebViewsController::class)->prefix('')->as('web.')->middleware(['web'])->group(function () {
    Route::get('', 'index')->name('index');
});

Route::controller(PanelViewsController::class)->prefix('panel/')->as('panel.')->middleware(['web', 'auth'])->group(function () {
    Route::get('', 'index')->name('index');

    Route::controller(UserController::class)->prefix('users/')->as('users.')->group(function () {
        Route::get('', 'index')->name('index')->can('users', User::class);
        Route::get('create', 'create')->name('create')->can('createUser', User::class);
        Route::get('{id}/edit', 'edit')->name('edit')->can('updateUser', User::class);
        Route::get('{user}/profile', 'profile')->name('profile')->can('viewUser', User::class);
    });

    Route::controller(ClientController::class)->prefix('clients/')->as('clients.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('{client}/profile', 'profile')->name('profile');
    });

    Route::controller(BranchController::class)->prefix('branches/')->as('branches.')->group(function () {
        Route::get('', 'index')->name('index');
    });

    Route::controller(OrderController::class)->prefix('orders/')->as('orders.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('assigned', 'assigned')->name('assigned');
        Route::get('{order}/profile', 'profile')->name('profile');
    });

    Route::controller(OfferController::class)->prefix('offers/')->as('offers.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('{offer}/profile', 'profile')->name('profile');
        Route::get('direct-offer', 'directOffer')->name('direct-offer');
        Route::get('in-direct-offer', 'inDirectOffer')->name('in-direct-offer');
    });

    Route::controller(ReservationController::class)->prefix('reservations/')->as('reservations.')->group(function () {
        Route::get('', 'index')->name('index');
    });

    Route::controller(SaleController::class)->prefix('sales/')->as('sales.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('{sale}/profile', 'profile')->name('profile');
        Route::get('client-payments', 'clientPayments')->name('client-payments');
    });

    Route::controller(CityController::class)->prefix('cities/')->as('cities.')->group(function () {
        Route::get('', 'index')->name('index');
    });

    Route::controller(NeighborhoodController::class)->prefix('neighborhoods/')->as('neighborhoods.')->group(function () {
        Route::get('', 'index')->name('index');
    });

    Route::controller(BrokerController::class)->prefix('brokers/')->as('brokers.')->group(function () {
        Route::get('', 'index')->name('index');
    });
});



Route::get(
    'testing',
    function () {
        return view('web.tesing');
    }
);
