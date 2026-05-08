<?php

namespace App\Livewire\Admin\Doctor;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\Layout;

class Create extends Component
{
    public $doctor_id;
    public $name, $email, $id_number, $phone, $specialty, $password;

    public function mount($doctor_id = null)
    {
        if ($doctor_id) {
            $this->doctor_id = $doctor_id;
            $doctor = Doctor::with('user')->findOrFail($doctor_id);
            $this->name = $doctor->user->name;
            $this->email = $doctor->user->email;
            $this->id_number = $doctor->user->id_number;
            $this->phone = $doctor->user->phone;
            $this->specialty = $doctor->specialty;
        }
    }

    public function save()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . ($this->doctor_id ? Doctor::find($this->doctor_id)->user_id : 'NULL'),
            'id_number' => 'required|string|max:20|unique:users,id_number,' . ($this->doctor_id ? Doctor::find($this->doctor_id)->user_id : 'NULL'),
            'phone' => 'nullable|string|max:20',
            'specialty' => 'required|string|max:255',
        ];

        if (!$this->doctor_id) {
            $rules['password'] = 'required|string|min:8';
        }

        $this->validate($rules);

        if ($this->doctor_id) {
            $doctor = Doctor::findOrFail($this->doctor_id);
            $user = $doctor->user;
            
            $userData = [
                'name' => $this->name,
                'email' => $this->email,
                'id_number' => $this->id_number,
                'phone' => $this->phone,
            ];

            if ($this->password) {
                $userData['password'] = Hash::make($this->password);
            }

            $user->update($userData);
            $doctor->update(['specialty' => $this->specialty]);

            session()->flash('success', 'Doctor actualizado correctamente.');
        } else {
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'id_number' => $this->id_number,
                'phone' => $this->phone,
                'password' => Hash::make($this->password),
            ]);

            Doctor::create([
                'user_id' => $user->id,
                'specialty' => $this->specialty,
            ]);

            session()->flash('success', 'Doctor creado correctamente.');
        }

        return redirect()->route('admin.doctors.index');
    }

    public function render()
    {
        return view('livewire.admin.doctor.create')
            ->layout('layouts.admin', [
                'title' => 'Doctores',
                'breadcrumbs' => [
                    ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
                    ['name' => 'Doctores', 'href' => route('admin.doctors.index')],
                    ['name' => $this->doctor_id ? 'Editar' : 'Nuevo'],
                ]
            ]);
    }
}
