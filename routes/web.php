<?php

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
    return view('welcome');
});

Auth::routes();



Route::middleware(['auth'])->prefix('user')->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


    Route::get('/my-booking/manage-bookings', [App\Http\Controllers\User\MyBookingController::class, 'manageBookings'])->name('mybooking.managebookings');
    Route::get('/my-booking/manage-bookings/create-booking', [App\Http\Controllers\User\MyBookingController::class, 'createBooking'])->name('mybooking.createbooking');
    Route::post('/my-booking/manage-bookings/create-booking/store', [App\Http\Controllers\User\MyBookingController::class, 'storeBooking'])->name('user.mybooking.createbooking.store');

    Route::get('/my-booking/manage-bookings/view-booking/{id}', [App\Http\Controllers\User\MyBookingController::class, 'viewBooking'])->name('user.mybooking.managebookings.viewbooking');
    Route::get('/my-booking/manage-bookings/edit-booking/{id}', [App\Http\Controllers\User\MyBookingController::class, 'editBooking'])->name('user.mybooking.managebookings.editbooking');
    Route::put('/my-booking/manage-bookings/edit-booking/{id}/update', [App\Http\Controllers\User\MyBookingController::class, 'updateBooking'])->name('user.mybooking.managebookings.updatebooking');

    Route::get('/payments', [App\Http\Controllers\User\PaymentController::class, 'index'])->name('user.payments');



});



// Staff Endpoints
Route::get('staff', [App\Http\Controllers\Staff\StaffAuthController::class, 'getLogin'])->name('staff.login');
Route::get('staff/login', [App\Http\Controllers\Staff\StaffAuthController::class, 'getLogin'])->name('staff.login');
Route::post('staff/login', [App\Http\Controllers\Staff\StaffAuthController::class, 'postLogin'])->name('staff.login.post');

Route::middleware(['staff.auth'])->prefix('staff')->group(function () {
    Route::post('staff/logout', [App\Http\Controllers\Staff\StaffAuthController::class, 'logout'])->name('staff.logout');



    Route::get('home', [App\Http\Controllers\Staff\HomeController::class, 'index'])->name('staff.home');


    Route::get('bookings', [App\Http\Controllers\Staff\BookingsController::class, 'allBookings'])->name('staff.bookings.allbookings');
    Route::get('bookings/view-booking/{id}', [App\Http\Controllers\Staff\BookingsController::class, 'viewBooking'])->name('staff.bookings.viewbooking');

    Route::patch('bookings/view-booking/{booking}/status', [App\Http\Controllers\Staff\BookingsController::class, 'updateStatus'])->name('staff.bookings.updatestatus');

    Route::get('users/customers', [App\Http\Controllers\Staff\UsersController::class, 'customers'])->name('staff.users.customers');

    Route::post('/payments/mark-as-paid', [App\Http\Controllers\Staff\PaymentController::class, 'store'])->name('payments.store');

    Route::get('/my-booking/create-booking', [App\Http\Controllers\Staff\BookingsController::class, 'createBooking'])->name('staff.mybooking.createbooking');
    Route::post('/my-booking/create-booking/create-booking/store', [App\Http\Controllers\Staff\BookingsController::class, 'storeBooking'])->name('mybooking.createbooking.store');

    Route::get('/reports/analytics', [App\Http\Controllers\Staff\ReportsController::class, 'analytics'])->name('staff.analytics');



});

