<?php

namespace App\Livewire\Admin\Doctor;

use App\Models\Doctor;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        $doctors = Doctor::with('user')
            ->whereHas('user', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%')
                      ->orWhere('id_number', 'like', '%' . $this->search . '%');
            })
            ->paginate(10);

        return view('livewire.admin.doctor.index', compact('doctors'))
            ->layout('layouts.admin', [
                'title' => 'Doctores',
                'breadcrumbs' => [
                    ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
                    ['name' => 'Doctores'],
                ]
            ]);
    }
}
