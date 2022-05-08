<?php

use App\Http\Controllers\SyncController;
use App\Http\Controllers\TimeTrackerController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('index');
});

Route::group(['prefix' => '/time-tracker'], function () {
    Route::controller(TimeTrackerController::class)->group(function () {
        Route::get('/', 'index')->name('time-tracker.index');
        Route::get('sync', 'sync')->name('time-tracker.sync');
        Route::post('{entrie}/track', 'track')->name('time-tracker.track');
    });
});

Route::get('init', [SyncController::class, 'init'])->name('init');
