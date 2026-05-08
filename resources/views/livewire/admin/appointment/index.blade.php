<div>
    <x-slot name="action">
        <x-wire-button blue label="Nuevo" icon="plus" href="{{ route('admin.appointments.create') }}" />
    </x-slot>
    <!-- Toolbar -->
    <div class="mb-4 bg-white p-4 shadow rounded-lg dark:bg-gray-800 flex justify-between items-center border border-gray-100 dark:border-gray-700">
        <div class="relative w-1/3">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="text" wire:model.live="search" placeholder="Buscar" class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white shadow rounded-lg overflow-x-auto dark:bg-gray-800 border border-gray-100 dark:border-gray-700">
        <table class="min-w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-500 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-b border-gray-200 dark:border-gray-600">
                <tr>
                    <th scope="col" class="px-6 py-4">ID</th>
                    <th scope="col" class="px-6 py-4">PACIENTE</th>
                    <th scope="col" class="px-6 py-4">DOCTOR</th>
                    <th scope="col" class="px-6 py-4">FECHA</th>
                    <th scope="col" class="px-6 py-4">HORA</th>
                    <th scope="col" class="px-6 py-4">HORA FIN</th>
                    <th scope="col" class="px-6 py-4">ESTADO</th>
                    <th scope="col" class="px-6 py-4 text-center">ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($appointments as $appointment)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4">{{ $appointment->id }}</td>
                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ optional(optional($appointment->patient)->user)->name }}</td>
                    <td class="px-6 py-4">{{ optional(optional($appointment->doctor)->user)->name }}</td>
                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($appointment->date)->format('d/m/Y') }}</td>
                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($appointment->start_time)->format('H:i') }}</td>
                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($appointment->end_time)->format('H:i') }}</td>
                    <td class="px-6 py-4 text-center">
                        @if($appointment->status == 1)
                            <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Programado</span>
                        @elseif($appointment->status == 2)
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">Completado</span>
                        @else
                            <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Cancelado</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center flex justify-center gap-2">
                        <!-- Edit Button -->
                        <a href="{{ route('admin.appointments.create', ['appointment_id' => $appointment->id]) }}" class="bg-blue-500 text-white p-1.5 rounded-lg shadow hover:bg-blue-600 transition" title="Editar">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        </a>
                        <!-- Consult Button (Stethoscope) -->
                        <a href="{{ route('admin.consultation.manager', ['appointment' => $appointment->id]) }}" class="bg-green-500 text-white p-1.5 rounded-lg shadow hover:bg-green-600 transition" title="Consulta">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11v1a7 7 0 01-14 0v-1M12 21v-4m0 0a2 2 0 100-4 2 2 0 000 4z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 11a3 3 0 106 0M3 11a3 3 0 106 0"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 11a3 3 0 10-6 0"></path></svg>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="px-6 py-4">
            {{ $appointments->links() }}
        </div>
    </div>
</div>
