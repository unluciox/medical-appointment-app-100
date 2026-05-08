<?php

namespace App\Livewire\Admin;

use App\Models\Appointment;
use Livewire\Component;
use Livewire\Attributes\Layout;

class ConsultationManager extends Component
{
    public $appointment_id;
    public $appointment;
    public $activeTab = 'consulta';
    
    // Consulta fields
    public $diagnosis, $treatment, $notes;

    // Receta fields
    public $medications = [];
    public $newMedication = ['name' => '', 'dose' => '', 'frequency' => ''];

    // Modals state
    public $showHistoryModal = false;
    public $showPreviousConsultationsModal = false;

    public function mount($appointment)
    {
        $this->appointment_id = $appointment;
        $this->appointment = Appointment::with(['patient.user', 'doctor.user', 'patient.bloodType'])->findOrFail($appointment);
    }

    public function addMedication()
    {
        $this->validate([
            'newMedication.name' => 'required|string',
            'newMedication.dose' => 'required|string',
            'newMedication.frequency' => 'required|string',
        ]);

        $this->medications[] = $this->newMedication;
        $this->newMedication = ['name' => '', 'dose' => '', 'frequency' => ''];
    }

    public function removeMedication($index)
    {
        unset($this->medications[$index]);
        $this->medications = array_values($this->medications);
    }

    public function saveConsultation()
    {
        $this->validate([
            'diagnosis' => 'required|string',
            'treatment' => 'required|string',
        ]);

        // Here we would save to a Consultation model, but we'll mock it for now
        // Assuming we update the appointment status to Completed (2)
        $this->appointment->update(['status' => 2]);

        session()->flash('success', 'Consulta guardada exitosamente.');
        return redirect()->route('admin.appointments.index');
    }

    public function render()
    {
        return view('livewire.admin.consultation-manager')
            ->layout('layouts.admin', [
                'title' => 'Consulta',
                'breadcrumbs' => [
                    ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
                    ['name' => 'Citas', 'href' => route('admin.appointments.index')],
                    ['name' => 'Consulta de ' . optional($this->appointment->patient->user)->name],
                ]
            ]);
    }
}
