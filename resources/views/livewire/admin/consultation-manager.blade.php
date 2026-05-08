<div class="relative">
    <x-slot name="action">
        <x-wire-button gray label="Volver" icon="arrow-left" href="{{ route('admin.appointments.index') }}" />
    </x-slot>


    <!-- Patient Info and Top Actions -->
    <div class="flex justify-between items-start mb-6">
        <div>
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ optional($appointment->patient->user)->name }}</h3>
            <p class="text-sm text-gray-500">DNI: {{ optional($appointment->patient->user)->id_number }}</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.patients.edit', $appointment->patient->id) }}?tab=antecedentes" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg shadow-sm hover:bg-gray-50 text-sm font-medium flex items-center gap-2 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                Ver Historia
            </a>
            <button wire:click="$set('showPreviousConsultationsModal', true)" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg shadow-sm hover:bg-gray-50 text-sm font-medium flex items-center gap-2 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Consultas Anteriores
            </button>
        </div>
    </div>

    <!-- Tabs and Content -->
    <div class="bg-white rounded-lg shadow dark:bg-gray-800 border border-gray-100 dark:border-gray-700 p-6">
        <!-- Tabs Nav -->
        <div class="border-b border-gray-200 dark:border-gray-700 mb-6">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400">
                <li class="mr-2">
                    <button wire:click="$set('activeTab', 'consulta')" class="inline-flex items-center gap-2 p-4 border-b-2 rounded-t-lg {{ $activeTab === 'consulta' ? 'text-blue-600 border-blue-600 dark:text-blue-500 dark:border-blue-500' : 'border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Consulta
                    </button>
                </li>
                <li class="mr-2">
                    <button wire:click="$set('activeTab', 'receta')" class="inline-flex items-center gap-2 p-4 border-b-2 rounded-t-lg {{ $activeTab === 'receta' ? 'text-blue-600 border-blue-600 dark:text-blue-500 dark:border-blue-500' : 'border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                        Receta
                    </button>
                </li>
            </ul>
        </div>

        <form wire:submit.prevent="saveConsultation">
            <!-- Consulta Tab Content -->
            <div class="{{ $activeTab === 'consulta' ? 'block' : 'hidden' }} space-y-4">
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Diagnóstico</label>
                    <textarea wire:model="diagnosis" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border {{ $errors->has('diagnosis') ? 'border-red-500 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500' : 'border-indigo-300 focus:ring-indigo-500 focus:border-indigo-500' }} dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Describa el diagnóstico del paciente aquí..."></textarea>
                    @error('diagnosis') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tratamiento</label>
                    <textarea wire:model="treatment" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border {{ $errors->has('treatment') ? 'border-red-500 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500' : 'border-gray-300 focus:ring-blue-500 focus:border-blue-500' }} dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Describa el tratamiento recomendado aquí..."></textarea>
                    @error('treatment') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Notas</label>
                    <textarea wire:model="notes" rows="3" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Agregue notas adicionales sobre la consulta..."></textarea>
                </div>
            </div>

            <!-- Receta Tab Content -->
            <div class="{{ $activeTab === 'receta' ? 'block' : 'hidden' }} space-y-4">
                <div class="grid grid-cols-12 gap-4 items-end bg-gray-50 p-4 rounded-lg dark:bg-gray-700 border border-gray-200 dark:border-gray-600">
                    <div class="col-span-5">
                        <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Medicamento</label>
                        <input type="text" wire:model="newMedication.name" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white" placeholder="Ej: Amoxicilina 500mg">
                    </div>
                    <div class="col-span-2">
                        <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Dosis</label>
                        <input type="text" wire:model="newMedication.dose" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white" placeholder="Ej: 1 pastilla">
                    </div>
                    <div class="col-span-4">
                        <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Frecuencia / Duración</label>
                        <input type="text" wire:model="newMedication.frequency" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white" placeholder="Ej: cada 8 horas por 7 días">
                    </div>
                    <div class="col-span-1 text-right">
                        <button type="button" wire:click="addMedication" class="px-3 py-2 text-sm font-medium text-center text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            +
                        </button>
                    </div>
                </div>

                @if(count($medications) > 0)
                <div class="mt-4">
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($medications as $index => $med)
                        <li class="py-3 sm:py-4 flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                        {{ $med['name'] }}
                                    </p>
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                        Dosis: {{ $med['dose'] }} | Frecuencia: {{ $med['frequency'] }}
                                    </p>
                                </div>
                            </div>
                            <button type="button" wire:click="removeMedication({{ $index }})" class="inline-flex items-center p-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>

            <!-- Submit Button -->
            <div class="mt-6 flex justify-end">
                <button type="submit" class="px-5 py-2.5 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 font-medium transition focus:ring-4 focus:ring-indigo-300 dark:focus:ring-indigo-800 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                    Guardar Consulta
                </button>
            </div>
        </form>
    </div>

    <!-- Modal: Historia Médica -->
    @if($showHistoryModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="relative w-full max-w-2xl bg-white rounded-lg shadow dark:bg-gray-800">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Historia médica del paciente
                </h3>
                <button wire:click="$set('showHistoryModal', false)" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <div class="grid grid-cols-4 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Tipo de sangre:</p>
                        <p class="font-medium dark:text-white">{{ optional($appointment->patient->bloodType)->name ?? 'No registrado' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Alergias:</p>
                        <p class="font-medium dark:text-white">{{ $appointment->patient->allergies ?? 'No registradas' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Enfermedades crónicas:</p>
                        <p class="font-medium dark:text-white">{{ $appointment->patient->chronic_conditions ?? 'No registradas' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Antecedentes quirúrgicos:</p>
                        <p class="font-medium dark:text-white">{{ $appointment->patient->surgical_history ?? 'No registradas' }}</p>
                    </div>
                </div>
                <div class="text-right">
                    <a href="#" class="text-blue-600 hover:underline text-sm font-medium dark:text-blue-500">Ver / Editar Historia Médica</a>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal: Consultas Anteriores -->
    @if($showPreviousConsultationsModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="relative w-full max-w-3xl bg-white rounded-lg shadow dark:bg-gray-800 max-h-[90vh] flex flex-col">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Consultas Anteriores
                </h3>
                <button wire:click="$set('showPreviousConsultationsModal', false)" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 overflow-y-auto space-y-4">
                <!-- Mockup de consultas -->
                <div class="p-4 border border-indigo-200 rounded-lg bg-indigo-50 dark:bg-gray-700 dark:border-indigo-500">
                    <div class="flex justify-between items-start mb-2">
                        <div class="flex items-center gap-2 text-indigo-700 dark:text-indigo-300 font-bold">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            09/03/2026 a las 17:30
                        </div>
                        <button class="text-indigo-600 border border-indigo-600 px-3 py-1 rounded text-sm hover:bg-indigo-600 hover:text-white transition dark:text-indigo-400 dark:border-indigo-400">Consultar Detalle</button>
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mb-3">Atendido por: Dr(a). Ariadna Saavedra</p>
                    <div class="text-sm space-y-1 text-gray-800 dark:text-gray-200">
                        <p><strong>Diagnóstico:</strong> Gastritis aguda</p>
                        <p><strong>Tratamiento:</strong> Qui cum numquam aliquam quasi eos soluta. Et omnis fuga molestiae sint...</p>
                        <p><strong>Notas:</strong> El paciente reporta mejoría.</p>
                    </div>
                </div>

                <div class="p-4 border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600">
                    <div class="flex justify-between items-start mb-2">
                        <div class="flex items-center gap-2 text-indigo-700 dark:text-indigo-300 font-bold">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            07/03/2026 a las 17:30
                        </div>
                        <button class="text-indigo-600 border border-indigo-600 px-3 py-1 rounded text-sm hover:bg-indigo-600 hover:text-white transition dark:text-indigo-400 dark:border-indigo-400">Consultar Detalle</button>
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mb-3">Atendido por: Dr. Luis Torres</p>
                    <div class="text-sm space-y-1 text-gray-800 dark:text-gray-200">
                        <p><strong>Diagnóstico:</strong> Infección respiratoria aguda</p>
                        <p><strong>Tratamiento:</strong> Aspernatur ipsa vitae debitis iste et ipsam et accusantium...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
