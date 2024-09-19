<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/HMS', function () {
    return view('HMS/index');
})->name('hms');
Route::get('/HMS/services', function () {
    return view('HMS/services');
})->name('services');
Route::get('/HMS/contact', function () {
    return view('HMS/contact');
})->name('contact');


Route::get('/HMS/patient_login', function () {
    return view('HMS/patient_login');
})->name('patient_login');


Route::get('/HMS/admin/admin_panel_patient', function () {
    return view('HMS/admin/admin_panel_patient');
})->name('patient_admin_dashboard');
Route::get('/HMS/admin/patient_logout', function () {
    return view('HMS/admin/patient_logout');
})->name('patient_logout');


Route::get('/HMS/admin/admin_panel_doctor', function () {
    return view('HMS/admin/admin_panel_doctor');
})->name('doctor_admin_dashboard');
Route::get('/HMS/admin/logout', function () {
    return view('HMS/admin/logout');
})->name('logout');


Route::get('/HMS/admin/admin_panel_receptionist', function () {
    return view('HMS/admin/admin_panel_receptionist');
})->name('receptionist_admin_dashboard');
