<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

use App\Models\Patients;
use Illuminate\Http\Request;

class PatientsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('HMS.index');
    }

    public function panel()
    {
        $patient_id = Session::get('patient_id');
        $patient = Patients::find($patient_id);
        return view('HMS.admin.admin_panel_patient', ['patientData' => $patient]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request = request()->all();

        $patient = new Patients();
        $patient->fname = $request['fname'];
        $patient->lname = $request['lname'];
        $patient->email = $request['email'];
        $patient->password = md5($request['password']);
        $patient->gender = $request['gender'];
        $patient->created_at = now()->format('Y-m-d');
        $patient->updated_at = now()->format('Y-m-d');
        $patient->save();


        return to_route('hms');
    }

    public function login(Request $request)
    {
        $request = request()->all();
        $patients = Patients::all();
        $password = md5($request['password']);
        $email = $request['email'];

        foreach ($patients as $patient) {
            if ($email == $patient['email'] && $password == $patient['password']) {
                Session::put('patient_id', $patient->id);
                return to_route('patient_panel');
            }
        }
        dd('error');
    }


    /**
     * Display the specified resource.
     */
    public function show(Patients $patients)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patients $patients)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patients $patients)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patients $patients)
    {
        //
    }
}
