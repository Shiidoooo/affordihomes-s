<?php

use Illuminate\Support\Facades\Route;

// Classes
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ScheduleController;
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

/*  Routing FORMAT

    get Request from /home 
    index method of HomeController class
    (dont forget to add use/app/http/controllers/name-of-your-controller)

    ->name(<module>.<action>);
    naming convention used to identify routes and corresponding controllers and actions

    @ - Seperator between controller name and method name
*/

// Homepopulate
Route::get('/', [PropertyController::class, 'homepopulate'])->name('home');

// LOGIN & LOGOUT
Route::get('/login', [LoginController::class, 'loginpage'])->name('login.loginpage');
Route::post('/home', [LoginController::class, 'login'])->name('login.submit');
Route::match(['get', 'post'], '/logout', [LoginController::class, 'logout'])->name('logout');

// SIGNUP
Route::get('/register/{role}', [LoginController::class, 'signup'])->name('signup.show');
Route::post('/register/{role}', [LoginController::class, 'signupuser'])->name('signup.submit');

Route::get('/agents', [AgentController::class, 'index'])->name('agent.home');
Route::get('/customer', [CustomerController::class, 'index'])->name('customer.home');

// Admin
Route::get('/admin/dashboard', [Admincontroller::class, 'index'])->name('admin.dashboard');
Route::get('/admin/profile', [Admincontroller::class, 'adminprofile'])->name('admin.profile');
Route::post('/admin/update', [Admincontroller::class, 'update'])->name('admin.update');
Route::get('/admin/agents', [Admincontroller::class, 'agents'])->name('admin.agents');
Route::get('/admin/properties', [Admincontroller::class, 'properties'])->name('admin.properties');

// Customer
Route::get('/customer/dashboard', [CustomerController::class, 'index'])->name('customer.dashboard');
Route::get('/customer/schedules', [CustomerController::class, 'appointment'])->name('customer.appointment');
Route::get('/customer/inquiry', [CustomerController::class, 'inquiry'])->name('customer.inquiry');
Route::get('/customer/inquire/{id}', [CustomerController::class, 'inquire'])->name('customer.inquire');
Route::get('/customer/inquire/delete/{customer_id}/{property_id}', [CustomerController::class, 'deleteInquiry'])->name('inquire.delete');
Route::get('/customer/view/transaction', [CustomerController::class, 'transaction'])->name('customer.transaction');

// Agent
Route::get('/agent/dashboard', [AgentController::class, 'index'])->name('agent.dashboard');
Route::get('/agent/view/Appointment', [AgentController::class, 'appointment'])->name('agent.appointment');
Route::get('/agent/view/transaction', [AgentController::class, 'transaction'])->name('agent.transaction');
Route::get('/agent/view/inquiry', [AgentController::class, 'inquiry'])->name('agent.inquiry');
Route::get('/agent/soldto/{customer_id}/{property_id}', [PropertyController::class, 'soldto'])->name('agent.soldto');
Route::post('/agent/soldtox/{customer_id}/{property_id}', [PropertyController::class, 'sold'])->name('agent.sold');

// Property
Route::get('/property/create', [PropertyController::class, 'create'])->name('property.create');
Route::post('/property/store', [PropertyController::class, 'store'])->name('property.store');
Route::get('/property/{id}/edit', [PropertyController::class, 'edit'])->name('property.edit');
Route::post('/property/{id}/update', [PropertyController::class, 'update'])->name('property.update');
Route::get('/property/{id}/delete', [PropertyController::class, 'delete'])->name('property.delete');

///Approve and Reject Property 
Route::get('/approve/{property_id}',[PropertyController::class,'approve'] )->name('property.approve');
Route::get('/reject/{property_id}', [PropertyController::class,'reject'])->name('property.reject');


Route::get('/property/info', [PropertyController::class, 'propertyinfo'])->name('property.info');

//Schedules
Route::prefix('schedule')->group(function () {
    Route::get('/create', [ScheduleController::class, 'create'])->name('schedule.create');
    Route::post('/store', [ScheduleController::class, 'store'])->name('schedule.store');
    Route::get('/customerschedule/{id}', [ScheduleController::class, 'CustomerScheduleStore'])->name('customer.schedule');
});

Route::post('/property/search', [PropertyController::class, 'search'])->name('property.search');

Route::get('/calculator', function () {
    return view('resourceful.calculator');
})->name('calculator');


Route::get('/resources', function () {
    return view('resourceful.resources');
})->name('resources');