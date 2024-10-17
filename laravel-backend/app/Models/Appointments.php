<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    protected $fillable = ['date', 'time', 'currentStatus', 'doctor_id', 'prescription_id', 'patient_id'];

    public function patient()
    {
        return $this->belongsTo(Patients::class, 'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctors::class, 'doctor_id');
    }

    public function prescription()
    {
        return $this->belongsTo(Prescriptions::class, 'prescription_id');
    }
}
