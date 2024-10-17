<?php

use App\Http\Controllers\PatientsController;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\DoctorsController;
use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\PrescriptionsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



Route::get('/', function () {
    return view('hms/index');
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


// admin auth

Route::get('admin/login', function () {
    return view('HMS/index');
})->name('admin.login');
Route::post('admin/login', [AdminsController::class, 'login'])->name('admin.login.post');
Route::get('admin/dashboard', [AdminsController::class, 'dashboard'])->middleware('AdminAuth')->name('admin.dashboard');
Route::post('admin/logout', [AdminsController::class, 'logout'])->name('admin.logout');
Route::get('admin/logout', [AdminsController::class, 'logout'])->middleware('AdminAuth')->name('admin.logout.get');
Route::post('/check-appointment', [PatientsController::class, 'checkAppointment'])->name('check_appointment');


Route::get('admin/add-doctor', [AdminsController::class, 'dashboard'])->name('admin.addDoctor.get');
Route::post('admin/add-doctor', [AdminsController::class, 'addDoctor'])->middleware('AdminAuth')->name('admin.addDoctor');

// Doctor Routes
Route::post('doctor/login', [DoctorsController::class, 'login'])->name('doctor.login.post');

// Search Contact and Cancel Appointment Routes
Route::POST('/search-contact', [AppointmentsController::class, 'searchContact'])->name('searchContact');
Route::delete('/appointments/{id}/cancel', [AppointmentsController::class, 'cancel'])->name('appointments.cancel');

// Admin Doctor Panel
Route::get('/HMS/admin/admin_panel_doctor', [AppointmentsController::class, 'index'])->name('doctor_admin_dashboard');
Route::get('/HMS/admin/logout', fn() => view('HMS/admin/logout'))->name('logout');

// Appointments Routes
Route::get('/appointments', [AppointmentsController::class, 'index'])->name('appointments.index');

// Prescriptions Routes
Route::prefix('prescriptions')->group(function () {
    Route::get('/', [PrescriptionsController::class, 'index'])->name('prescriptions.index');
    Route::get('/prescriptions/create', [PrescriptionsController::class, 'create'])->name('prescriptions.create');
    Route::post('/', [PrescriptionsController::class, 'store'])->name('prescriptions.store');
    Route::get('/{prescription}', [PrescriptionsController::class, 'show'])->name('prescriptions.view');
    Route::get('/{prescription}/edit', [PrescriptionsController::class, 'edit'])->name('prescriptions.edit');
    Route::put('/{prescription}', [PrescriptionsController::class, 'update'])->name('prescriptions.update');
    Route::delete('/prescriptions/{prescription}', [PrescriptionsController::class, 'destroy'])->name('prescriptions.destroy');
    
});

Route::post('admin/delete-doctor', [AdminsController::class, 'deleteDoctor'])->name('admin.deleteDoctor');
// submit contact
Route::post('contact/submit', [AdminsController::class, 'contactSubmit'])->name('contact.submit');