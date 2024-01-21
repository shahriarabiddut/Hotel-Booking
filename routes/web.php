<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StaffDepartment;

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

Route::get('/', [HomeController::class, 'home'])->name('root');
// Admin Login
Route::get('admin/login', [AdminController::class, 'login']);
Route::post('admin/login', [AdminController::class, 'check_login']);
Route::get('admin/logout', [AdminController::class, 'logout']);
// Admin Dashboard
Route::get('admin', [AdminController::class, 'dashboard']);


// RoomTypes Routes
Route::get('admin/roomtype/{id}/delete', [RoomTypeController::class, 'destroy']);
Route::resource('admin/roomtype', RoomTypeController::class);
// Room Routes
Route::get('admin/rooms/{id}/delete', [RoomController::class, 'destroy']);
Route::resource('admin/rooms', RoomController::class);
// Customer Routes
Route::get('admin/customer/{id}/delete', [CustomerController::class, 'destroy']);
Route::resource('admin/customer', CustomerController::class);

// Delete RoomType Images
Route::get('admin/roomtypeImage/delete/{id}', [RoomTypeController::class, 'destroy_image']);

// Department Routes
Route::get('admin/department/{id}/delete', [StaffDepartment::class, 'destroy']);
Route::resource('admin/department', StaffDepartment::class);
// Facilities Routes
Route::get('admin/facility/{id}/delete', [FacilityController::class, 'destroy']);
Route::resource('admin/facility', FacilityController::class);
// Staff Routes
// Staff Payment
Route::get('admin/staff/payments/{id}', [StaffController::class, 'all_payment']);
Route::get('admin/staff/payment/{id}/add', [StaffController::class, 'add_payment']);
Route::post('admin/staff/payment/{id}', [StaffController::class, 'save_payment']);
Route::get('admin/staff/payment/{id}/{stuff_id}/delete', [StaffController::class, 'delete_payment']);
// Staff Crud
Route::get('admin/staff/{id}/delete', [StaffController::class, 'destroy']);
Route::resource('admin/staff', StaffController::class);
// Booking Routes admin
Route::get('admin/booking/{id}/delete', [BookingController::class, 'destroy']);
Route::get('admin/booking/available-rooms/{checkin_date}', [BookingController::class, 'available_rooms']);
Route::resource('admin/booking', BookingController::class);

//Customer SignUp
Route::get('customer/login', [CustomerController::class, 'login']);
Route::post('customer/login', [CustomerController::class, 'check_login']);
Route::get('welcome', function () {
    return view('welcome');
});
Route::get('customer/roomtype/', [RoomTypeController::class, 'cshow'])->name('cshow');
Route::get('customer/register', [CustomerController::class, 'register']);
Route::get('customer/logout', [CustomerController::class, 'logout']);
//Customer Extra Routes
Route::get('customer/profile', [CustomerController::class, 'customerProfile'])->name('customerProfile');
Route::get('customer/mybookings', [BookingController::class, 'mybookings'])->name('mybookings');
// Booking Routes Front
Route::get('booking', [BookingController::class, 'front_booking']);
//Payment
Route::get('booking/pay/{id}', [BookingController::class, 'front_payment'])->name('payment');
Route::get('admin/booking/pay/{id}', [BookingController::class, 'admin_payment'])->name('admin.payment');
Route::post('booking/pay/store', [BookingController::class, 'paymentStore'])->name('payment.store');

Route::get('admin/pay/{id}/accept', [BookingController::class, 'paymentAccept'])->name('admin.paymentAccept');
Route::get('admin/generate/{id}/bill', [BookingController::class, 'generateBill'])->name('admin.generateBill');

Route::get('admin/bills', [BillController::class, 'index'])->name('admin.bill.index');
Route::get('admin/bill/create', [BillController::class, 'create'])->name('admin.bill.create');
Route::post('admin/bill/generate/', [BillController::class, 'generate'])->name('admin.bill.generate');
Route::get('admin/bill/pay/{id}&{customer_id}', [BillController::class, 'admin_payment'])->name('admin.bill.payment');
Route::get('admin/bill/paymentTotal/{data}', [BillController::class, 'clear_payment'])->name('admin.bill.paymentTotal');
