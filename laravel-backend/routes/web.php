<?php

use App\Http\Controllers\PatientsController;
use App\Models\Patients;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminsController;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
});




Route::get('/HMS', [PatientsController::class, 'index'])->name('hms');




Route::get('/HMS/services', function () {
    return view('HMS/services');
})->name('services');
Route::get('/HMS/contact', function () {
    return view('HMS/contact');
})->name('contact');


Route::get('/HMS/patient_login', function () {
    return view('HMS/patient_login');
})->name('patient_login');

Route::post('/HMS/patient_login', [PatientsController::class, 'login'])->name('patient_login');

Route::post('/HMS/patient_store', [PatientsController::class, 'store'])->name('patient_store');
Route::post('/HMS/cancel_appointment', [PatientsController::class, 'appointmentCancel'])->name('cancel_appointment');

Route::post('/HMS/patient_appointment', [PatientsController::class, 'appointment'])->name('patient_appointment');


Route::get('/HMS/patient_panel', [PatientsController::class, 'panel'])->name('patient_panel');



Route::get('/HMS/admin/admin_panel_patient', function () {
    return view('HMS/admin/admin_panel_patient');
})->name('patient_admin_dashboard');

Route::get('/HMS/admin/patient_logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return view('HMS/admin/patient_logout');
})->name('patient_logout');


Route::get('/HMS/admin/admin_panel_doctor', function () {
    return view('HMS/admin/admin_panel_doctor');
})->name('doctor_admin_dashboard');
Route::get('/HMS/admin/logout', function () {
    return view('HMS/admin/logout');
})->name('logout');


//commented to not let non admins access the admin dashboard
/*Route::get('/HMS/admin/admin_panel_receptionist', function () {
    return view('HMS/admin/admin_panel_receptionist');
})->name('receptionist_admin_dashboard');*/




// admin auth

Route::get('admin/login', function () {
    return view('HMS/index');
})->name('admin.login');
Route::post('admin/login', [AdminsController::class, 'login'])->name('admin.login.post');
Route::get('admin/dashboard', [AdminsController::class, 'dashboard'])->middleware('AdminAuth')->name('admin.dashboard');
Route::post('admin/logout', [AdminsController::class, 'logout'])->name('admin.logout');
Route::get('admin/logout', [AdminsController::class, 'logout'])->middleware('AdminAuth')->name('admin.logout.get');

// admin add delete doctor
// add doctor

Route::get('admin/add-doctor', [AdminsController::class, 'dashboard'])->name('admin.addDoctor.get');
Route::post('admin/add-doctor', [AdminsController::class, 'addDoctor'])->middleware('AdminAuth')->name('admin.addDoctor');

// admin delete doctor

Route::post('admin/delete-doctor', [AdminsController::class, 'deleteDoctor'])->name('admin.deleteDoctor');
