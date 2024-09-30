<?php

namespace App\Http\Controllers;

use App\Models\Doctors;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use App\Models\Patients;
use App\Models\Appointments;
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

        $Specializations = Doctors::distinct()->pluck('specialization');
        $Doctors = Doctors::all()->toArray();



        $appointments = DB::table('appointments')->join('doctors', 'appointments.doctor_id', '=', 'doctors.id')->join('prescriptions', 'appointments.prescription_id', '=', 'prescriptions.id')->where('appointments.patient_id', $patient_id)->select('appointments.*', 'doctors.name as doctor_name', 'doctors.fees as fees', 'prescriptions.disease as disease', 'prescriptions.allergy as allergy', 'prescriptions.prescriptions as prescriptions')->get()->toArray();


        return view('HMS.admin.admin_panel_patient', [
            'patientData' => $patient,
            'SpecializationsData' => $Specializations,
            'DoctorsData' => $Doctors,
            'appointments' => $appointments
        ]);
    }



    public function appointmentCancel(Request $request)
    {
        $appointment = Appointments::find($request->appointment);

        $appointment->currentStatus = 'cancelledByPatient';
        $appointment->save();
        return to_route('patient_panel');
    }



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


    public function appointment(Request $request)
    {
        $request = request()->all();
        $patient_id = Session::get('patient_id');

        $appointment = new Appointments();
        $appointment->date = $request['appdate'];
        $appointment->time = $request['apptime'];
        $appointment->currentStatus = 'Active';
        $appointment->doctor_id = $request['doctor'];
        $appointment->patient_id = $patient_id;
        $appointment->prescription_id = 1;
        $appointment->created_at = now()->format('Y-m-d');
        $appointment->updated_at = now()->format('Y-m-d');

        $appointment->save();


        return to_route('patient_panel');
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
