<?php

use App\Http\Controllers\ArsipController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InposController;
use App\Http\Controllers\KepalaController;
use App\Http\Controllers\PreviewController;
use App\Http\Controllers\AlurController;
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



// Route::group(['middleware' => ['auth']], function () {
//Route Untuk Logout
Route::get('/logout', [AuthController::class, 'logout']);

//Admin Start
//Route ke Dashboard
Route::get('/dashboard', [AlurController::class, 'dashboard'])->name('dashboard');
Route::post('/createuser', [InposController::class, 'storeuser']);

//Route ke arsip
Route::get('/arsip', [ArsipController::class, 'showarsip']);

//Route untuk unggah
Route::get('/unggah', [AlurController::class, 'unggah']);
Route::post('/unggahproses', [InposController::class, 'storefile']);

//Route untuk konfirmasi
Route::get('/konfirmasi/{nomor_surat}', [AlurController::class, 'konfirmasi']);
Route::get('/konfirmasimanager/{nomor_surat}', [AlurController::class, 'konfirmasimanager']);
Route::post('/konfirmasiproses/{nomor_surat}', [InposController::class, 'storekonfirmasi']);
Route::get('/konfirmasikeluar', [AlurController::class, 'konfirmasikeluar']);
Route::get('/konfirmasimasuk', [AlurController::class, 'konfirmasimasuk']);
Route::get('/konfirmasimanagerkeluar', [AlurController::class, 'konfirmasimanagerkeluar']);


//Route ke preview
Route::get('/preview/{nama_file}', [PreviewController::class, 'showfile']);
Route::get('/previewkeluar/{nama_file}', [PreviewController::class, 'showfilekeluar']);
Route::get('/previewkonfirmasi/{nomor_surat}', [PreviewController::class, 'konfirmasidetail']);
Route::get('/unduh/{nama_file}', [PreviewController::class, 'unduh']);

//Route untuk arsip
Route::post('/arsipfile/{nama_file}', [PreviewController::class, 'arsipfile']);

//Route untuk disposisi
Route::get('/disposisi/{nomor_surat}', [AlurController::class, 'disposisi']);
Route::post('/disposisiproses/{nomor_surat}', [InposController::class, 'storedisposisi']);
Route::post('/disposisistaff/{nomor_surat}', [InposController::class, 'storedisposisistaff']);

//Route untuk konfirmasi
Route::get('/konfirmasi', [AlurController::class, 'konfirmasi']);
Route::get('/unduhkonfirmasi/{nama_file}', [PreviewController::class, 'unduhkonfirmasi']);

//route untuk delete
Route::delete('/arsip/delete/{file_pdf}', [InposController::class, 'delete']);

//Route outgoing
Route::get('/buatsurat', [AlurController::class, 'outgoing']);
Route::get('/outgoing-masuk', [AlurController::class, 'outgoing']);
Route::get('/outgoingstaff', [AlurController::class, 'outgoingstaff']);
Route::get('/outgoing-preview/{nomor_surat}', [AlurController::class, 'hasil']);
Route::post('/outgoingprocess', [InposController::class, 'outgoing']);

//Route Download outgoing
Route::get('/export-pdf/{nomor_surat}', [InposController::class, 'exportpdf']);
Route::get('/kirimsurat/{nomor_surat}', [InposController::class, 'kirimsurat']);
Route::get('/setujuisurat/{nomor_surat}', [InposController::class, 'setujuisurat']);

//Route List Superadmin
Route::get('/liststaff', [AlurController::class, 'list']);
Route::get('/listmanager', [AlurController::class, 'listmanager']);
Route::get('/listdeputi', [AlurController::class, 'listdeputi']);
Route::get('/listgm', [AlurController::class, 'listgm']);
Route::get('/listadmin', [AlurController::class, 'listadmin']);
Route::get('/edit/{id_pos}', [AlurController::class, 'edituser']);
route::post('/update/{id_pos}', [AlurController::class, 'update']);
// });



//Admin End
