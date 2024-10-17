<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Models\Prescriptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctorId = Auth::guard('doctor')->id();
    
        // Check if a doctor is logged in
        if ($doctorId) {
            // Retrieve only the appointments for the logged-in doctor, including related patient information
            $appointments = Appointments::where('doctor_id', $doctorId)
                ->with('patient')
                ->get();
    
            // Fetch prescriptions associated with the appointments for this doctor
            $prescriptions = Prescriptions::whereIn('appointment_id', $appointments->pluck('id'))
                ->with('patient', 'appointment')
                ->get();
    
            // Return the view with filtered appointments and prescriptions
            return view('hms.admin.admin_panel_doctor', compact('appointments', 'prescriptions'));
        }
    
        // If no doctor is logged in, return an empty list or an error
        return redirect()->back()->with('error', 'You are not authorized to view these appointments.');
    }
        /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Logic for displaying a form for creating a new appointment
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'date' => 'required|date',
            'time' => 'required|date_format:H:i', // Use 'H:i' for 'hour:minute'
            'currentStatus' => 'required|string',
            'doctor_id' => 'required|exists:doctors,id', // Ensure doctor exists
            'patient_id' => 'required|exists:patients,id', // Ensure patient exists
        ]);
    
        // Create the appointment using validated data
        Appointments::create($validatedData);
    
        return back()->with('success', 'Appointment created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointments $appointments)
    {
        // Logic for displaying a single appointment
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointments $appointments)
    {
        // Logic for displaying the form to edit an appointment
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointments $appointments)
    {
        $doctorId = Auth::guard('doctor')->id();

        // Check if the appointment belongs to the logged-in doctor
        if ($appointments->doctor_id !== $doctorId) {
            return redirect()->back()->with('error', 'You are not authorized to update this appointment.');
        }

        $validatedData = $request->validate([
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'currentStatus' => 'required|string',
        ]);

        // Update the appointment with validated data
        $appointments->update($validatedData);
    
        return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointments $appointments)
    {
        $doctorId = Auth::guard('doctor')->id();

        // Check if the appointment belongs to the logged-in doctor
        if ($appointments->doctor_id !== $doctorId) {
            return redirect()->back()->with('error', 'You are not authorized to delete this appointment.');
        }

        $appointments->delete();

        return back()->with('success', 'Appointment deleted successfully!');
    }

    /**
     * Search appointments by contact number.
     */
    public function searchContact(Request $request)
    {
        $contact = $request->input('contact');
    
        if (empty($contact)) {
            return redirect()->back()->with('error', 'Please enter a contact number to search.');
        }
    
        // Search for appointments with matching contact number
        $appointments = Appointments::whereHas('patient', function ($query) use ($contact) {
            $query->where('contact', 'like', '%' . $contact . '%');
        })->get();
    
        // Fetch prescriptions related to these appointments
        $prescriptions = Prescriptions::whereIn('appointment_id', $appointments->pluck('id'))
            ->with('patient', 'appointment')
            ->get();
    
        if ($appointments->isEmpty()) {
            return redirect()->back()->with('error', 'No appointments found for the provided contact number.');
        }
    
        return view('hms.admin.admin_panel_doctor', compact('appointments', 'prescriptions'));
    }

    /**
     * Cancel an appointment.
     */
    public function cancel($id)
    {
        $appointment = Appointments::find($id);
        $doctorId = Auth::guard('doctor')->id();

        // Check if the appointment belongs to the logged-in doctor
        if ($appointment && $appointment->doctor_id === $doctorId) {
            $appointment->currentStatus = 'cancelledByDoctor';
            $appointment->save();

            return redirect()->back()->with('success', 'Appointment cancelled successfully.');
        }

        return redirect()->back()->with('error', 'Appointment not found or you are not authorized to cancel it.');
    }
}
