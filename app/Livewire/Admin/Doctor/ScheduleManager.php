<?php

namespace App\Livewire\Admin\Doctor;

use App\Models\Doctor;
use Livewire\Component;
use Livewire\Attributes\Layout;

class ScheduleManager extends Component
{
    public $doctor_id;
    public $doctor_name;

    public function mount($doctor)
    {
        $this->doctor_id = $doctor;
        $doc = Doctor::with('user')->findOrFail($doctor);
        $this->doctor_name = $doc->user->name;
    }

    public function render()
    {
        return view('livewire.admin.doctor.schedule-manager')
            ->layout('layouts.admin', [
                'title' => 'Horarios',
                'breadcrumbs' => [
                    ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
                    ['name' => 'Doctores', 'href' => route('admin.doctors.index')],
                    ['name' => 'Horarios de ' . $this->doctor_name],
                ]
            ]);
    }
}
