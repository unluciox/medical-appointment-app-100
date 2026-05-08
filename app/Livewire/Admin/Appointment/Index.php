<?php

namespace App\Livewire\Admin\Appointment;

use App\Models\Appointment;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        $appointments = Appointment::with(['patient.user', 'doctor.user'])
            ->whereHas('patient.user', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            })
            ->orWhereHas('doctor.user', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy('date', 'desc')
            ->orderBy('start_time', 'desc')
            ->paginate(10);

        return view('livewire.admin.appointment.index', compact('appointments'))
            ->layout('layouts.admin', [
                'title' => 'Citas',
                'breadcrumbs' => [
                    ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
                    ['name' => 'Citas'],
                ]
            ]);
    }
}
