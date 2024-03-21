<?php

use App\Http\Controllers\DataBackupController;
use App\Http\Controllers\EngineController;
use App\Http\Controllers\HarianController;
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
use App\Http\Controllers\StatussController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;

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
    Route::resource('engine', EngineController::class);
    Route::resource('backup', DataBackupController::class);
    Route::post('/harian/getData', [HarianController::class, 'getData'])->name('harian.getData');
});

Route::group(['middleware' => ['auth', 'checkRole:5,1']], function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::resource('pencatatan', PencatatanController::class);
    Route::resource('penugasan', PenugasanController::class);
    // Route::resource('users', UserController::class)->only('show', 'edit');
    Route::resource('users', UserController::class);
    Route::resource('servers', ServerController::class);
    Route::get('/server/showServer/{id}', [ServerController::class, 'showServer'])->name('showServer');
    Route::get('/exportServers', [ServerController::class, 'exportExcel'])->name('exportServer');
    Route::resource('spekServer', SpekServerController::class);
    Route::resource('ketServer', KetServerController::class);
    Route::resource('harian', HarianController::class);
    Route::get('/harian/add/addData/{id}', [HarianController::class, 'addHarian'])->name('harian.add');
    Route::get('/harian/update/ubahData/{id}', [HarianController::class, 'updateHarian'])->name('harian.updateData');
    Route::post('/harian/upload', [HarianController::class, 'storeMedia'])->name('harian.upload');
    Route::get('exportHarianId/{id}', [HarianController::class, 'exportHarianId'])->name('exportHarianId');
    Route::get('exportPdfHarian/{id}', [HarianController::class, 'exportPdfHarian'])->name('exportPdfHarian');
    Route::get('/harian/generatePDF/{id}', [HarianController::class, 'generatePDF'])->name('generatePDF');
    Route::post('/harian/generatePDFByRange', [HarianController::class, 'generatePDFRange'])->name('generatePDFByRange');
    Route::post('/upload', [UploadController::class, 'uploadDropzoneFile'])->name('front.upload');
    Route::post('/file-destroy', [UploadController::class, 'destroyFile'])->name('front.file-destroy');
    Route::get('harian/export/{id}', [HarianController::class, 'exportHarianId'])->name('harian.export');
    Route::post('harian/export/{id}', [HarianController::class, 'exportHarianRange'])->name('harian.export.range');
});

require __DIR__ . '/auth.php';
