<?php

namespace App\Http\Controllers;

use App\Models\Admins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Doctors;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Admins $admins)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admins $admins)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admins $admins)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admins $admins)
    {
        //
    }


    // Admin Auth
        // admin login
            public function login(Request $request)
            {
                
                $request->validate([
                    'username' => 'required|string',
                    'password' => 'required|string',
                ]);
        

                if (Auth::guard('admin')->attempt(['name' => $request->username, 'password' => $request->password])) {

                    return redirect()->route('admin.dashboard');
                }

                return back()->withErrors(['loginError' => 'Invalid credentials.']);
            }


        //show admin(receptionist) dashboard (admin_panel_receptionist.blade.php)
            public function dashboard(Request $request)
            {


                if (Auth::guard('admin')->check()) {

                    
                    if ($request->has('app_contact'))     //if appointments by patient_id (contact)
                    {   
                        $request->validate([
                            'app_contact' => 'required|integer',
                        ]);
                        $contact = $request->input('app_contact');
                        $appointments = DB::table('appointments')
                            ->join('patients', 'appointments.patient_id', '=', 'patients.id')
                            ->join('doctors', 'appointments.doctor_id', '=', 'doctors.id')
                            ->select(
                                'appointments.id as appointment_id',
                                'patients.id as patient_id',
                                'patients.fName as patient_first_name',
                                'patients.lName as patient_last_name',
                                'patients.gender as patient_gender',
                                'patients.email as patient_email',
                                'doctors.name as doctor_name',
                                'doctors.fees as doctor_fees',
                                'appointments.date as appointment_date',
                                'appointments.time as appointment_time',
                                'appointments.currentStatus as appointment_status'
                            )
                            ->where('patients.id', '=', $contact)
                            ->get();
                            $doctors = $this->getDoctorsData(); 
                            $patients = $this->getPatientsData();
                            $prescriptions = $this->getPrescriptionsData();  
                            $messages= $this->getQueryData();                           
                    }


                    else {

                        $appointments = $this->getAppointmentsData();
                        $doctors = $this->getDoctorsData(); 
                        $patients = $this->getPatientsData();
                        $prescriptions = $this->getPrescriptionsData();
                        $messages= $this->getQueryData();
                        
                    }

                    return view('HMS.admin.admin_panel_receptionist', compact('appointments','doctors','patients','prescriptions','messages'));
                }
                return redirect()->route('admin.login');
            }

            private function getAppointmentsData(){

                return DB::table('appointments')
                ->join('patients', 'appointments.patient_id', '=', 'patients.id')
                ->join('doctors', 'appointments.doctor_id', '=', 'doctors.id')
                ->select(
                    'appointments.id as appointment_id',
                    'patients.id as patient_id',
                    'patients.fName as patient_first_name',
                    'patients.lName as patient_last_name',
                    'patients.gender as patient_gender',
                    'patients.email as patient_email',
                    'doctors.name as doctor_name',
                    'doctors.fees as doctor_fees',
                    'appointments.date as appointment_date',
                    'appointments.time as appointment_time',
                    'appointments.currentStatus as appointment_status'
                )->get();

            }

            private function getDoctorsData()
            {
                return DB::table('doctors')->select('id','name','email','password','fees','specialization')->whereNull('deletedAt')->get();
            }
            
            private function getPatientsData()
            {
                return DB::table('patients')
                ->select('id','fname','lname','email','password','gender')->get();
            }
            
            // private function getPrescriptionsData(){
            //     return DB::table('appointments')
            //     ->join('prescriptions', 'appointments.prescription_id', '=', 'appointments.id')
            //     ->join('patients', 'appointments.patient_id', '=', 'patients.id')
            //     ->join('doctors', 'appointments.doctor_id', '=', 'doctors.id')
            //     ->select('doctors.name as Doctor','patients.id as Patient_id','appointments.id as Appointment_id',
            //     'patients.fname as First_name','patients.lname as Last_name', 'appointments.date as Appointment_date',
            //     'appointments.time as Appointment_time','prescriptions.disease as Disease','prescriptions.allergy as Allergy',
            //     'prescriptions.prescriptions as Prescription')->get();
            // }
            private function getPrescriptionsData(){
                //TODO
                return DB::table('appointments')
                ->join('patients', 'appointments.patient_id', '=', 'patients.id')
                ->join('doctors', 'appointments.doctor_id', '=', 'doctors.id')
                ->join('prescriptions', 'appointments.prescription_id', '=', 'prescriptions.id')
                ->select(
                    'doctors.name as doctor_name',
                    'patients.id as patient_id',
                    'appointments.id as appointment_id',
                    'patients.fName as patient_first_name',
                    'patients.lName as patient_last_name',
                    'appointments.date as appointment_date',
                    'appointments.time as appointment_time',
                    'prescriptions.disease as prescription_disease',
                    'prescriptions.allergy as prescription_allergy',
                    'prescriptions.prescriptions as prescription_prescriptions'
                )
                ->get();

}
            

            private function getQueryData(){
                
                return DB::table('messages')->select('name','email','phone','message')->get();
            }






    
        // logout
            public function logout()
            {
                Auth::guard('admin')->logout(); 
                return redirect()->route('hms'); 
            }

    // DOCTOR
        // Add doctor

            public function addDoctor(Request $request)
            {
                $validator = Validator::make($request->all(), [
                    'doctor' => 'required|string',
                    'demail' => 'required|email',
                    'dpassword' => 'required|string|confirmed',
                    'docFees' => 'required|integer',
                    'special' => 'required|string',
                ]);


                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput(); 
                }
                try {

                Doctors::create([
                    'name' => $request->input('doctor'),
                    'email' => $request->input('demail'),
                    'password' => Hash::make($request->input('dpassword')),
                    'fees' => $request->input('docFees'),
                    'specialization' => $request->input('special'),
                    'admin_id' => auth()->guard('admin')->user()->id,
                    'createdBy' => auth()->guard('admin')->user()->id,
                    'updatedBy' => auth()->guard('admin')->user()->id,
                ]);


                return redirect()->route('admin.dashboard')->with('success', 'Doctor added');
            } catch (\Exception $e) {

                return redirect()->back()->with('error', $e->getMessage())->withInput();
            }

            }
        

        // delete doctor
            public function deleteDoctor(Request $request)
            {

                $validator = Validator::make($request->all(), [
                    'doctor_id' => 'required|integer',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput(); 
                }
            
                try {

                    $doctor = Doctors::findOrFail($request->input('doctor_id'));
                    $doctor->deletedBy =auth()->guard('admin')->user()->id;
                    $doctor->save();
                    $doctor->delete();
            
                    return redirect()->route('admin.dashboard')->with('success', 'Doctor deleted');
                } catch (\Exception $e) {

                    return redirect()->back()->with('error', $e->getMessage())->withInput();
                }

            }

                    public function contactSubmit(Request $request){
                        $validator = Validator::make($request->all(), ['txtName'=>'required|string','txtEmail'=>'required|email','txtPhone'=>'required|numeric','txtMsg'=>'required|string']);
                        if ($validator->fails()) {
                            return redirect()->back()->withErrors($validator)->withInput(); }
                            try {

                                DB::table('messages')
                    ->insert(['name'=>$request->input('txtName'),'email'=>$request->input('txtEmail'),'phone'=>$request->input('txtPhone'),'message'=>$request->input('txtMsg')]);
                    return redirect()->back()->with('success','message sent successfully');
                        
                            
                            } catch (\Exception $e) {
            
                                return redirect()->back()->with('error', $e->getMessage())->withInput();
                            }
                            
                        

}

}