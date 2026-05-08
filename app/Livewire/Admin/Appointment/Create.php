<?php

namespace App\Livewire\Admin\Appointment;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Carbon\Carbon;

class Create extends Component
{
    public $appointment_id;
    public $patient_id, $doctor_id, $date, $start_time, $end_time, $reason;
    public $patients = [], $doctors = [];

    public function mount($appointment_id = null)
    {
        $this->patients = Patient::with('user')->get();
        $this->doctors = Doctor::with('user')->get();

        if ($appointment_id) {
            $this->appointment_id = $appointment_id;
            $appointment = Appointment::findOrFail($appointment_id);
            $this->patient_id = $appointment->patient_id;
            $this->doctor_id = $appointment->doctor_id;
            $this->date = $appointment->date;
            $this->start_time = Carbon::parse($appointment->start_time)->format('H:i');
            $this->end_time = Carbon::parse($appointment->end_time)->format('H:i');
            $this->reason = $appointment->reason;
        }
    }

    public function save()
    {
        $this->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'date' => 'required|date|after_or_equal:today',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'reason' => 'required|string',
        ]);

        if ($this->appointment_id) {
            $appointment = Appointment::findOrFail($this->appointment_id);
            $appointment->update([
                'patient_id' => $this->patient_id,
                'doctor_id' => $this->doctor_id,
                'date' => $this->date,
                'start_time' => $this->start_time,
                'end_time' => $this->end_time,
                'reason' => $this->reason,
            ]);
            session()->flash('success', 'Cita actualizada correctamente.');
        } else {
            Appointment::create([
                'patient_id' => $this->patient_id,
                'doctor_id' => $this->doctor_id,
                'date' => $this->date,
                'start_time' => $this->start_time,
                'end_time' => $this->end_time,
                'reason' => $this->reason,
                'status' => 1,
            ]);
            session()->flash('success', 'Cita creada correctamente.');
        }

        return redirect()->route('admin.appointments.index');
    }

    public function render()
    {
        return view('livewire.admin.appointment.create')
            ->layout('layouts.admin', [
                'title' => 'Citas',
                'breadcrumbs' => [
                    ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
                    ['name' => 'Citas', 'href' => route('admin.appointments.index')],
                    ['name' => $this->appointment_id ? 'Editar' : 'Nuevo'],
                ]
            ]);
    }
}
