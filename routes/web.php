<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\CustomAuthController;
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

Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

Route::middleware(['auth'])->group(function () {

    Route::get('/', function(){ return redirect('home'); });
    Route::get('/home', [CustomAuthController::class, 'home'])->name('home');
    Route::get('/update/profile', [Admin::class, 'getProfile'])->name('updateprofile');
    Route::post('/save/update/profile', [Admin::class, 'updateProfile'])->name('saveupdateprofile');
    Route::get('/edit/password', [Admin::class, 'editPass'])->name('editpass');
    Route::post('/change/password', [Admin::class, 'changePass'])->name('changepass');
    Route::get('/new/task', [Admin::class, 'newTask'])->name('newtask');
    Route::post('/set/new/task', [Admin::class, 'setNewTask'])->name('setnewtask');
    Route::get('/waiting', [Admin::class, 'getWaiting'])->name('waiting');
    Route::get('/pending', [Admin::class, 'getPending'])->name('pending');
    Route::get('/accepted', [Admin::class, 'getAccepted'])->name('accepted');
    Route::get('/rejected', [Admin::class, 'getRejected'])->name('rejected');
    Route::get('/returned', [Admin::class, 'getReturned'])->name('returned');
    Route::get('/task/returned/delete/{id}', [Admin::class, 'deleteReturned'])->name('deletereturned');
    Route::get('/resend/{id}', [Admin::class, 'resendReturned'])->name('resendreturned');
    Route::post('/resend/resubmit', [Admin::class, 'resubmitReturned'])->name('resubmitreturned');
    Route::get('/imgupload/{id}', [Admin::class, 'imgTest']);
});
