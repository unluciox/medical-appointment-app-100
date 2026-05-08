<div>
    <x-slot name="action">
        <x-wire-button blue label="Nuevo" icon="plus" href="{{ route('admin.doctors.create') }}" />
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
                    <th scope="col" class="px-6 py-4">NOMBRE</th>
                    <th scope="col" class="px-6 py-4">EMAIL</th>
                    <th scope="col" class="px-6 py-4">DNI</th>
                    <th scope="col" class="px-6 py-4">TELEFONO</th>
                    <th scope="col" class="px-6 py-4">ESPECIALIDAD</th>
                    <th scope="col" class="px-6 py-4 text-center">ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($doctors as $doctor)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4">{{ $doctor->id }}</td>
                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ optional($doctor->user)->name }}</td>
                    <td class="px-6 py-4">{{ optional($doctor->user)->email }}</td>
                    <td class="px-6 py-4">{{ optional($doctor->user)->id_number }}</td>
                    <td class="px-6 py-4">{{ optional($doctor->user)->phone }}</td>
                    <td class="px-6 py-4">{{ $doctor->specialty }}</td>
                    <td class="px-6 py-4 text-center flex justify-center gap-2">
                        <!-- Edit Button -->
                        <a href="{{ route('admin.doctors.create', ['doctor_id' => $doctor->id]) }}" class="bg-blue-500 text-white p-1.5 rounded-lg shadow hover:bg-blue-600 transition" title="Editar">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        </a>
                        <!-- Schedule Button -->
                        <a href="{{ route('admin.doctors.schedule', ['doctor' => $doctor->id]) }}" class="bg-green-500 text-white p-1.5 rounded-lg shadow hover:bg-green-600 transition" title="Horarios">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="px-6 py-4">
            {{ $doctors->links() }}
        </div>
    </div>
</div>
