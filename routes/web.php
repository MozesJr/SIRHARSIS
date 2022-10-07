<?php

use App\Http\Controllers\CatatanController;
use App\Http\Controllers\ExtController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\KetServerController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\LevelsController;
use App\Http\Controllers\PencatatanController;
use App\Http\Controllers\PenugasanController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\SpekServerController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\Statuss;
use App\Http\Controllers\StatussController;
use App\Http\Controllers\UserController;
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
    return redirect()->intended('login');
});

Route::group(['middleware' => ['auth', 'checkRole:5']], function () {
    Route::resource('level', LevelController::class);
    Route::resource('lvlSvr', LevelsController::class);
    Route::resource('status', StatusController::class);
    Route::resource('stsSvr', StatussController::class);
    Route::resource('role', RoleController::class);
    Route::resource('job', JobController::class);
    Route::resource('users', UserController::class);
    Route::resource('ext', ExtController::class);
});

Route::group(['middleware' => ['auth', 'checkRole:5,1']], function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::resource('pencatatan', PencatatanController::class);
    Route::resource('penugasan', PenugasanController::class);
    Route::resource('users', UserController::class)->only('show', 'edit');
    Route::resource('servers', ServerController::class);
    Route::resource('spekServer', SpekServerController::class);
    Route::resource('ketServer', KetServerController::class);
});

require __DIR__ . '/auth.php';
