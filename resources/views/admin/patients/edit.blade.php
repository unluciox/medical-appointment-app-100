{{--logica de php para manejar errores y controlar pestaña activa--}}
@php
    //definimos que campos pertenecen a cada pestaña para detectar errores
    $errorGroups =[
      'antecedentes' => ['allergies','chronic_conditions','surgical_history','family_history'],
      'informacion-general'=> ['blood_type_id','observations'],
      'contacto-emergencia'=>['emergency_contact_name','emergency_contact_phone','emergency_contact_relationship'],
    ];
    //petaña por defecto
    $initialTab='datos-personales';

    //si hay errores, buscamos en que grupoestan

    foreach ($errorGroups as $tabName =>$fields) {
      if ($errors->hasAny($fields)) {
        $initialTab=$tabName;
        break; //Salimos del blucle
      }
    }
@endphp
<x-admin-layout title="Pacientes" :breadcrumbs="[
  [
    'name' => 'Dashboard',
    'href' => route('admin.dashboard'),

  ],
  [
    'name' => 'Pacientes',
    'href' => route('admin.patients.index'),
  ],
  [
    'name' => 'Editar'
  ]
]">

  <form action="{{route('admin.patients.update',$patient)}}" method="POST">
    @csrf
    @method('PUT')
  <x-wire-card class="mb-8">
    <div class="lg:flex lg:justify-between lg:items-center">
      <div class="flex items-center">

        <img src="{{$patient->user->profile_photo_url}}" alt="{{$patient->user->name}}"
        class="h-20 w-20 rounded-full object-cover object-center">

        <div><p class="text-2xl font-bold text-gray-900 ml-4">{{$patient->user->name}}</p></div>

      </div>
      <div class="flex space-x-3 mt-6 lg:mt-0">
        <x-wire-button outline gray href="{{route('admin.patients.index')}}">Volver</x-wire-button>
        <x-wire-button type="submit">
          <i class="fa-solid fa-check"></i>
          Guardar cambios
        </x-wire-button>
      </div>
    </div>

  </x-wire-card>

  {{--Tabs de navegacion--}}
  
  <x-wire-card>
    <div>
  
{{--Menu de pestañas--}}

    <x-tabs :active="$initialTab">
    <x-slot name="header">
    
      {{--Tab1: Datos personales--}}
        @php
            $hasError = $errors->hasAny($errorGroups['datos-personales']??[]);
        @endphp
        <x-tabs-link tab="datos-personales" :error="$hasError">
            <i class="fa-solid fa-user me-2"></i>
            Datos personales
        </x-tabs-link>
        {{--tab2: antecedentes--}}
        @php
            $hasError = $errors->hasAny($errorGroups['antecedentes']);
        @endphp
        <x-tabs-link tab="antecedentes" :error="$hasError">
            <i class="fa-solid fa-file-lines me-2"></i>
            Antecedentes
        </x-tabs-link>
        {{--tab3: informacion general--}}
        @php
            $hasError = $errors->hasAny($errorGroups['informacion-general']);
        @endphp
        <x-tabs-link tab="informacion-general" :error="$hasError">
            <i class="fa-solid fa-file me-2"></i>
            Información general
        </x-tabs-link>

        {{--tab4: contacto de emergencia--}}
        @php
            $hasError = $errors->hasAny($errorGroups['contacto-emergencia']);
        @endphp 
        <x-tabs-link tab="contacto-emergencia" :error="$hasError">
            <i class="fa-solid fa-heart me-2"></i>
            Contacto de emergencia
        </x-tabs-link>
        
        </x-slot>

{{--contenidos de los tabs--}}

  {{--tab1: contenido--}}
  <div x-show="tab==='datos-personales'">
    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-4 mb-6 rounded-r-lg shadow-sm">
     <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
      {{--lado izquierdo--}}
      <div class="flex items-start">
        <div class="flex-shrink-0">
          <i class="fa-solid fa-user-gear text-blue-500 text-xl mt-1"></i>
          
          </div>
          <div class="ml-3">
            <h3 class="text-sm font-bold text-blue-800">
              Edicion de cuenta de usuario
            </h3>
            <div class="mt-1 text-sm text-blue-600">
              <p>La <strong>informacion de acceso </strong>(nombre,email y contraseña) debe de gestionarse desde la cuenta de usuario asociada.</p>
            </div>
      </div>
    </div>
      {{--Boton de accion lado derecho--}}
        <div class="flex-shrink-0">
          <x-wire-button primary sm href="{{route('admin.users.edit',$patient->user)}}" target="_blank">
            Editar usuario
            <i class="fa-solid fa-arrow-up-right-from-square ms-2"></i>
          </x-wire-button>
        </div>
      </div>
      </div>
      <div class="grid lg:grid-cols-2 gap-4">
        <div>
          <span class="text-gray-500 font-semibold">Telefono:</span>
          <span class="text-gray-500 text-sm ml-1">{{$patient->user->phone}}</span>
        </div>
        <div>
          <span class="text-gray-500 font-semibold">Email:</span>
          <span class="text-gray-500 text-sm ml-1">{{$patient->user->email}}</span>
        </div>
        <div>
          <span class="text-gray-500 font-semibold">Direccion:</span>
          <span class="text-gray-500 text-sm ml-1">{{$patient->user->address}}</span>
        </div>
      </div>
    </div>
    {{--Contenido de tab 2 antecedentes--}}
    <div x-show="tab === 'antecedentes'" style="display: none">
      <div class="grid lg:grid-cols-2 gap-4">
        <div>
          <x-wire-textarea label="Alergias conocidas" name="allergies">
            {{old("allergies",$patient->allergies)}}
          </x-wire-textarea>
        </div>
        <div>
          <x-wire-textarea label="Enfermedades crónicas" name="chronic_conditions">
            {{old("chronic_conditions",$patient->chronic_conditions)}}
          </x-wire-textarea>
        </div>
        <div>
          <x-wire-textarea label="Antecedentes quirurjicos" name="surgical_history">
            {{old("surgical_history",$patient->surgical_history)}}
          </x-wire-textarea>
        </div>
        <div>
          <x-wire-textarea label="Antecedetes familiares" name="family_history">
            {{old("family_allergies",$patient->family_allergies)}}
          </x-wire-textarea>
        </div>

    </div>
  </div>

</div>
{{--Contenido de tab 3 info general--}}
    <div x-show="tab === 'informacion-general'" style="display: none">
      
        <x-wire-native-select label="Tipo de sangre" class="mb-4" name="blood_type_id">
          <option value="">Selecciona un tipo de sangre</option>
          @foreach ($bloodTypes as $bloodType)
            <option value="{{$bloodType->id}}"@selected(old('blood_type_id',$patient->blood_type_id)==$bloodType->id)>
              {{$bloodType->name}}

            </option>
              
          @endforeach
        </x-wire-native-select>
        <x-wire-textarea label="Observaciones" name="observations">
          {{old("observations",$patient->observations)}}

        </x-wire-textarea>
      </div>
      {{--Contenido de tab 3 contacto de emergencia--}}
      <div x-show="tab === 'contacto-emergencia'" style="display: none">
        <div class="space-y-4">
          <x-wire-input label="Nombre de contacto" name="emergency_contact_name" value="{{old('emergency_contact_name',$patient->emergency_contact_name)}}"/>
          <x-wire-phone label="Telefono de contacto" name="emergency_contact_phone" mask="(###) ###-####" placeholder="(999) 999-9999" value="{{old('emergency_contact_phone',$patient->emergency_contact_phone)}}"/>
          <x-wire-input label="Relacion con el contacto" name="emergency_contact_relationship" placeholder="Familiar, Amigo, etc" value="{{old('emergency_contact_relationship',$patient->emergency_contact_relationship)}}"/>
        </div>

</x-tabs>
</div>

  </x-wire-card>
  </form>

</x-admin-layout>