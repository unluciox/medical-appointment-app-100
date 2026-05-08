<div>
    <x-slot name="action">
        <x-wire-button gray label="Volver" icon="arrow-left" href="{{ route('admin.doctors.index') }}" />
    </x-slot>

    <!-- Toolbar -->
    <div class="mb-4 bg-white p-4 shadow rounded-lg dark:bg-gray-800 flex justify-between items-center border border-gray-100 dark:border-gray-700">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Gestor de horarios</h3>
        <button type="button" class="px-4 py-2 bg-indigo-500 text-white rounded shadow hover:bg-indigo-600 text-sm font-medium">
            Guardar horario
        </button>
    </div>

    <!-- Table Mockup -->
    <div class="bg-white shadow rounded-lg overflow-x-auto dark:bg-gray-800 border border-gray-100 dark:border-gray-700">
        <table class="min-w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-500 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-b border-gray-200 dark:border-gray-600">
                <tr>
                    <th scope="col" class="px-6 py-4">DÍA/HORA</th>
                    <th scope="col" class="px-6 py-4 text-center">LUNES</th>
                    <th scope="col" class="px-6 py-4 text-center">MARTES</th>
                    <th scope="col" class="px-6 py-4 text-center">MIÉRCOLES</th>
                    <th scope="col" class="px-6 py-4 text-center">JUEVES</th>
                    <th scope="col" class="px-6 py-4 text-center">VIERNES</th>
                </tr>
            </thead>
            <tbody>
                <!-- 08:00 Block -->
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4 font-bold text-gray-900 dark:text-white">
                        <div class="flex items-center gap-2">
                            <input type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                            08:00:00
                        </div>
                    </td>
                    @foreach(['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'] as $day)
                    <td class="px-6 py-4 align-top">
                        <div class="space-y-2">
                            <label class="flex items-center gap-2 text-xs font-semibold">
                                <input type="checkbox" class="w-4 h-4 rounded text-blue-600 border-gray-300"> Todos
                            </label>
                            <label class="flex items-center gap-2 text-xs">
                                <input type="checkbox" class="w-4 h-4 rounded text-blue-600 border-gray-300" {{ in_array($day, ['Lunes', 'Martes', 'Miércoles']) ? 'checked' : '' }}> 08:00 - 08:15
                            </label>
                            <label class="flex items-center gap-2 text-xs">
                                <input type="checkbox" class="w-4 h-4 rounded text-blue-600 border-gray-300"> 08:15 - 08:30
                            </label>
                            <label class="flex items-center gap-2 text-xs">
                                <input type="checkbox" class="w-4 h-4 rounded text-blue-600 border-gray-300"> 08:30 - 08:45
                            </label>
                            <label class="flex items-center gap-2 text-xs">
                                <input type="checkbox" class="w-4 h-4 rounded text-blue-600 border-gray-300"> 08:45 - 09:00
                            </label>
                        </div>
                    </td>
                    @endforeach
                </tr>
                <!-- 09:00 Block -->
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4 font-bold text-gray-900 dark:text-white">
                        <div class="flex items-center gap-2">
                            <input type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                            09:00:00
                        </div>
                    </td>
                    @foreach(['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'] as $day)
                    <td class="px-6 py-4 align-top">
                        <div class="space-y-2">
                            <label class="flex items-center gap-2 text-xs font-semibold">
                                <input type="checkbox" class="w-4 h-4 rounded text-blue-600 border-gray-300"> Todos
                            </label>
                            <label class="flex items-center gap-2 text-xs">
                                <input type="checkbox" class="w-4 h-4 rounded text-blue-600 border-gray-300"> 09:00 - 09:15
                            </label>
                            <label class="flex items-center gap-2 text-xs">
                                <input type="checkbox" class="w-4 h-4 rounded text-blue-600 border-gray-300"> 09:15 - 09:30
                            </label>
                            <label class="flex items-center gap-2 text-xs">
                                <input type="checkbox" class="w-4 h-4 rounded text-blue-600 border-gray-300"> 09:30 - 09:45
                            </label>
                            <label class="flex items-center gap-2 text-xs">
                                <input type="checkbox" class="w-4 h-4 rounded text-blue-600 border-gray-300"> 09:45 - 10:00
                            </label>
                        </div>
                    </td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
</div>
