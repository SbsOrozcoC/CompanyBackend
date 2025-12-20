<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Empleados') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                    <h3 class="text-lg font-semibold text-gray-700">
                        Listado de empleados
                    </h3>

                    <a href="{{ route('employees.create') }}"
                        class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-indigo-700 transition">
                        + Nuevo empleado
                    </a>

                </div>

                <div class="overflow-x-auto">
                    <table id="employees-table" class="min-w-full border border-gray-200 rounded-lg">
                        <thead class="bg-gray-100">
                            <tr>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Identificación</th>
                                <th>Teléfono</th>
                                <th>Ciudad</th>
                                <th>Cargos</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($employees as $employee)
                                <tr>
                                    <td>{{ $employee->first_name }}</td>
                                    <td>{{ $employee->last_name }}</td>
                                    <td>{{ $employee->identification }}</td>
                                    <td>{{ $employee->phone }}</td>
                                    <td>{{ optional($employee->city)->name }}</td>
                                    <td>
                                        {{ $employee->positions->pluck('name')->join(', ') }}
                                    </td>
                                    <td class="text-center">
                                        <div class="flex justify-center gap-2">
                                            <a href="{{ route('employees.edit', $employee) }}"
                                                class="px-3 py-1 bg-blue-600 text-white rounded">
                                                Editar
                                            </a>

                                            <form action="{{ route('employees.destroy', $employee) }}" method="POST"
                                                class="delete-form inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="px-3 py-1 bg-red-600 text-white rounded">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#employees-table').DataTable({
            pageLength: 10,
            lengthChange: false,
            language: {
                search: "Buscar:",
                emptyTable: "No hay empleados registrados",
                info: "Mostrando _START_ a _END_ de _TOTAL_ empleados",
                infoEmpty: "Mostrando 0 empleados",
                paginate: {
                    next: "Siguiente",
                    previous: "Anterior"
                }
            },
            columnDefs: [{
                orderable: false,
                targets: -1
            }]
        });
    });
</script>
