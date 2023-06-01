<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\TargetController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\DailyController;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\ContributorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TeamController;

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
Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['checkPermission:user|superuser']], function () {
        Route::get('/', [HomeController::class, 'index']);
        Route::resource('activity', ActivityController::class);
        Route::resource('target', TargetController::class);
        Route::resource('project', ProjectController::class);
        Route::resource('setting', SettingController::class);
        Route::resource('daily', DailyController::class);
        Route::resource('daily', DailyController::class);
        Route::resource('teams', TeamController::class)->only([
            'index',
        ]);
    });
    Route::group(['middleware' => ['checkPermission:superuser']], function () {
        Route::resource('reminder', ReminderController::class);
        Route::resource('teams', TeamController::class);
    });
});
Route::get('/logout', function(){
    Auth::logout();
    session()->flush();
    return Redirect::to('login');
 });
Auth::routes();

