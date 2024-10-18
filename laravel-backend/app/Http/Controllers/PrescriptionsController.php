<?php

namespace App\Http\Controllers;

use App\Models\Prescriptions;
use App\Models\Appointments;
use App\Models\Patients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class PrescriptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch prescriptions with related patient and appointment data
        $prescriptions = Prescriptions::with(['patient', 'appointment'])->get();
        
        // Debugging line
        Log::info('Number of prescriptions retrieved: ' . $prescriptions->count());
    
        // Fetch all appointments to pass to the view
        $appointments = Appointments::all();
    
        return view('hms.admin.admin_panel_doctor', compact('prescriptions', 'appointments'));
    }
        /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $appointmentId = $request->input('appointment_id');
        $patientId = $request->input('patient_id');
    
        // Fetch appointment and patient information
        $appointment = Appointments::find($appointmentId);
        $patient = Patients::find($patientId);
    
        if (!$appointment || !$patient) {
            return redirect()->back()->with('error', 'Appointment or Patient not found.');
        }
    
        // Pass the necessary data to the view
        return view('hms.admin.create_prescription', [
            'appointment_id' => $appointment->id,
            'patient_id' => $patient->id,
            'prescription_id' => null, // Set it to null or the relevant value
            'appointment' => $appointment,
            'patient' => $patient,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'patient_id' => 'required|integer|exists:patients,id',
            'appointment_id' => 'required|integer|exists:appointments,id',
            'prescriptions' => 'required|string|max:255',
            'allergy' => 'nullable|string|max:255',
            'disease' => 'required|string|max:255',
        ]);
    
        // Create a new prescription
        $prescription = Prescriptions::create($request->only(['patient_id', 'appointment_id', 'prescriptions', 'allergy', 'disease']));
    
        // Update the appointment with the new prescription and set currentStatus to "done"
        Appointments::where('id', $prescription->appointment_id)
            ->update([
                'prescription_id' => $prescription->id,
                'currentStatus' => 'done', // Set currentStatus to "done"
            ]);
    
        // Redirect to the prescriptions index with a success message
        return redirect()->route('prescriptions.index')->with('success', 'Prescription created successfully!');
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prescriptions $prescription)
    {
        // Pass the existing prescription data to the edit view
        return view('hms.admin.edit_prescription', [
            'prescription' => $prescription,
            'patient_id' => $prescription->patient_id,
            'appointment_id' => $prescription->appointment_id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prescriptions $prescription)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'prescriptions' => 'required|string|max:255',
            'allergy' => 'nullable|string|max:255',
            'disease' => 'required|string|max:255',
        ]);

        // Update the prescription
        $prescription->update($validatedData);

        return redirect()->route('prescriptions.index')->with('success', 'Prescription updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Find the prescription to be deleted
            $prescription = Prescriptions::findOrFail($id);
    
            // Update the appointment's currentStatus to 'active'
            Appointments::where('id', $prescription->appointment_id)
                ->update(['currentStatus' => 'active']);
    
            // Disable foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            
            // Force delete the prescription
            $prescription->forceDelete();
            
            // Enable foreign key checks back
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    
            return redirect()->route('prescriptions.index')->with('success', 'Prescription deleted successfully.');
        } catch (\Exception $e) {
            // Enable foreign key checks back in case of an exception
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            
            // Log the error message for debugging
            Log::error('Error deleting prescription: ' . $e->getMessage());
            
            // Redirect back with the error message
            return redirect()->route('prescriptions.index')->with('error', 'Failed to delete prescription: ' . $e->getMessage());
        }
    }
    }
