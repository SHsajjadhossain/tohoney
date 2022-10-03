<?php

use App\Http\Controllers\{HomeController, ProfileController};
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/mail/box', [HomeController::class, 'mailbox'])->name('mailbox');
Route::get('/send/mail/{id}', [HomeController::class, 'sendmail'])->name('sendmail');
Route::post('/check/mail', [HomeController::class, 'checkmail'])->name('checkmail');
Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
Route::post('/profile/name/change', [ProfileController::class, 'namechange'])->name('profile.namechange');
Route::post('/profile/password/change', [ProfileController::class, 'passwordchange'])->name('passwordchange');
Route::post('/profile/photo/change', [ProfileController::class, 'photochange'])->name('profile.photochange');
