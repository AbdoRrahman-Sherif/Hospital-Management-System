<?php

namespace App\Http\Controllers;

use App\Models\Doctors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DoctorsController extends Controller
{
    /**
     * Handle the doctor login request.
     */
    public function login(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',  // Change this to validate ID
            'password' => 'required',     // Keep password validation
        ]);
    
        // Prepare credentials for authentication
        $credentials = [
            'id' => $request->id,
            'password' => $request->password,
        ];
    
        if (Auth::guard('doctor')->attempt($credentials)) {
            return redirect()->route('doctor_admin_dashboard');
        }
            
        return back()->withErrors(['Invalid credentials.']);
    
        }

    public function index()
    {
        $doctors = Doctors::all(); 
        return view('admin.doctors.index', compact('doctors'));
    }

    public function create()
    {
        return view('admin.doctors.create'); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:doctors,email',
            'password' => 'required|string|min:8',
            'fees' => 'required|numeric',
            'specialization' => 'required|string|max:255',
        ]);

        Doctors::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), 
            'fees' => $request->fees,
            'specialization' => $request->specialization,
            'admin_id' => Auth::id(), 
            'createdBy' => Auth::id(), 
            'updatedBy' => Auth::id(), 
        ]);

        return redirect()->route('admin.doctors.index')->with('success', 'Doctor created successfully!');
    }

    public function edit(Doctors $doctor)
    {
        return view('admin.doctors.edit', compact('doctor')); // Adjust to your Blade view path
    }

    public function update(Request $request, Doctors $doctor)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:doctors,email,' . $doctor->id,
            'fees' => 'required|numeric',
            'specialization' => 'required|string|max:255',
            'password' => 'nullable|string|min:8', 
        ]);

        $doctor->name = $request->name;
        $doctor->email = $request->email;
        $doctor->fees = $request->fees;
        $doctor->specialization = $request->specialization;

        if ($request->filled('password')) {
            $doctor->password = Hash::make($request->password);
        }

        $doctor->save();

        return redirect()->route('admin.doctors.index')->with('success', 'Doctor updated successfully!');
    }

    public function destroy(Doctors $doctor)
    {
        $doctor->delete(); 

        return redirect()->route('admin.doctors.index')->with('success', 'Doctor deleted successfully!');
    }

    public function dashboard()
    {
        // Add any logic necessary to retrieve data for the dashboard
        return view('admin.doctors.index'); // Ensure you have a corresponding Blade view
    }
}
