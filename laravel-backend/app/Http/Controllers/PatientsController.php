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
    public function index()
    {
        return view('HMS.index');
    }

    public function panel()
    {
        $patient_id = Session::get('patient_id');
        
        // Ensure the patient is logged in and exists
        if (!$patient_id) {
            return redirect()->route('hms')->with('error', 'Please log in first.');
        }
    
        $patient = Patients::find($patient_id);
    
        // Retrieve doctor specializations and all doctors
        $specializations = Doctors::distinct()->pluck('specialization');
        $doctors = Doctors::all();
    
        // Refined query to retrieve the patient's appointments
        $appointments = DB::table('appointments')
            ->join('doctors', 'appointments.doctor_id', '=', 'doctors.id')
            ->where('appointments.patient_id', $patient_id) // Filter by patient ID
            ->select(
                'appointments.id',
                'appointments.date',
                'appointments.time',
                'appointments.currentStatus',
                'doctors.name as doctor_name',
                'doctors.fees'
            )
            ->get();
    
        // New query to retrieve prescriptions for the logged-in patient
        $prescriptions = DB::table('prescriptions')
            ->where('patient_id', $patient_id) // Filter by patient ID
            ->select(
                'id',
                'disease',
                'allergy',
                'prescriptions'
            )
            ->get();
    
        return view('HMS.admin.admin_panel_patient', [
            'patientData' => $patient,
            'SpecializationsData' => $specializations,
            'DoctorsData' => $doctors,
            'appointments' => $appointments,
            'prescriptions' => $prescriptions // Pass prescriptions data to the view
        ]);
    }
            public function appointmentCancel(Request $request)
    {
        $appointment = Appointments::find($request->appointment);

        if ($appointment && $appointment->patient_id == Session::get('patient_id')) {
            $appointment->currentStatus = 'cancelledByPatient';
            $appointment->save();
            return redirect()->route('patient_panel')->with('success', 'Appointment cancelled successfully.');
        }

        return redirect()->route('patient_panel')->with('error', 'Unable to cancel appointment.');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|unique:patients,email',
            'password' => 'required|string|min:8',
            'gender' => 'required'
        ]);

        $patient = new Patients();
        $patient->fname = $data['fname'];
        $patient->lname = $data['lname'];
        $patient->email = $data['email'];
        $patient->password = md5($data['password']);
        $patient->gender = $data['gender'];
        $patient->created_at = now();
        $patient->updated_at = now();
        $patient->save();

        return redirect()->route('hms')->with('success', 'Patient registered successfully.');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $password = md5($credentials['password']);
        $patient = Patients::where('email', $credentials['email'])
            ->where('password', $password)
            ->first();

        if ($patient) {
            Session::put('patient_id', $patient->id);
            return redirect()->route('patient_panel');
        }

        return back()->with('error', 'Invalid email or password.');
    }

    public function appointment(Request $request)
    {
        $data = $request->validate([
            'appdate' => 'required|date',
            'apptime' => 'required',
            'doctor' => 'required|exists:doctors,id'
        ]);

        $patient_id = Session::get('patient_id');

        $appointment = new Appointments();
        $appointment->date = $data['appdate'];
        $appointment->time = $data['apptime'];
        $appointment->currentStatus = 'Active';
        $appointment->doctor_id = $data['doctor'];
        $appointment->patient_id = $patient_id;
        $appointment->created_at = now();
        $appointment->updated_at = now();
        $appointment->save();

        return redirect()->route('patient_panel')->with('success', 'Appointment booked successfully.');
    }
    public function checkAppointment(Request $request)
{
    $data = $request->validate([
        'appdate' => 'required|date',
        'apptime' => 'required'
    ]);

    $exists = Appointments::where('date', $data['appdate'])
        ->where('time', $data['apptime'])
        ->exists();

    return response()->json(['exists' => $exists]);
}

}