<?php

use App\Http\Controllers\ArsipController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InposController;
use App\Http\Controllers\KepalaController;
use App\Http\Controllers\PreviewController;
use App\Http\Controllers\RouteController;
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

Route::get('/', function () {
    return view('Layout.landing');
});

//Route untuk masuk ke login
Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/loginproses', [AuthController::class, 'loginproses'])->name('loginproses');



Route::group(['middleware' => ['auth']], function () {
    //Route Untuk Logout
    Route::get('/logout', [AuthController::class, 'logout']);

    //Admin Start
    //Route ke Dashboard
    Route::get('/dashboard', [RouteController::class, 'dashboard'])->name('dashboard');

    //Route ke arsip
    Route::get('/arsip', [ArsipController::class, 'showarsip']);

    //Route untuk unggah
    Route::get('/unggah', [RouteController::class, 'unggah']);
    Route::post('/unggahproses', [InposController::class, 'storefile']);

    //Route untuk konfirmasi
    Route::get('/konfirmasi/{nomor_surat}', [RouteController::class, 'konfirmasi']);
    Route::get('/konfirmasimanager/{nomor_surat}', [RouteController::class, 'konfirmasimanager']);
    Route::post('/konfirmasiproses/{nomor_surat}', [InposController::class, 'storekonfirmasi']);
    Route::get('/konfirmasikeluar', [RouteController::class, 'konfirmasikeluar']);
    Route::get('/konfirmasimasuk', [RouteController::class, 'konfirmasimasuk']);
    Route::get('/konfirmasimanagerkeluar', [RouteController::class, 'konfirmasimanagerkeluar']);


    //Route ke preview
    Route::get('/preview/{nama_file}', [PreviewController::class, 'showfile']);
    Route::get('/previewkeluar/{nama_file}', [PreviewController::class, 'showfilekeluar']);
    Route::get('/previewkonfirmasi/{nomor_surat}', [PreviewController::class, 'konfirmasidetail']);
    Route::get('/unduh/{nama_file}', [PreviewController::class, 'unduh']);

    //Route untuk arsip
    Route::post('/arsipfile/{nama_file}', [PreviewController::class, 'arsipfile']);

    //Route untuk disposisi
    Route::get('/disposisi/{nomor_surat}', [RouteController::class, 'disposisi']);
    Route::post('/disposisiproses/{nomor_surat}', [InposController::class, 'storedisposisi']);
    Route::post('/disposisistaff/{nomor_surat}', [InposController::class, 'storedisposisistaff']);

    //Route untuk konfirmasi
    Route::get('/konfirmasi', [RouteController::class, 'konfirmasi']);
    Route::get('/unduhkonfirmasi/{nama_file}', [PreviewController::class, 'unduhkonfirmasi']);

    //route untuk delete
    Route::delete('/arsip/delete/{file_pdf}', [InposController::class, 'delete']);

    //Route outgoing
    Route::get('/buatsurat', [RouteController::class, 'outgoing']);
    Route::get('/outgoing-masuk', [RouteController::class, 'outgoing']);
    Route::get('/outgoingstaff', [RouteController::class, 'outgoingstaff']);
    Route::get('/outgoing-preview/{nomor_surat}', [RouteController::class, 'hasil']);
    Route::post('/outgoingprocess', [InposController::class, 'outgoing']);

    //Route Download outgoing
    Route::get('/export-pdf/{nomor_surat}', [InposController::class, 'exportpdf']);
    Route::get('/kirimsurat/{nomor_surat}', [InposController::class, 'kirimsurat']);
    Route::get('/setujuisurat/{nomor_surat}', [InposController::class, 'setujuisurat']);
});



//Admin End
