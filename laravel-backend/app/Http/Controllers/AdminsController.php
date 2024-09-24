<?php

namespace App\Http\Controllers;

use App\Models\Admins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Doctors;
use Illuminate\Support\Facades\Validator;


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
            public function dashboard()
            {
                if (Auth::guard('admin')->check()) {
                    return view('HMS.admin.admin_panel_receptionist'); 
                }

                
                return redirect()->route('admin.login');
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



}
