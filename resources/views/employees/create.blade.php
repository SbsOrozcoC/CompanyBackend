<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Crear Empleado</h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto">
        <div class="bg-white p-6 rounded shadow">
            <form method="POST" action="{{ route('employees.store') }}">
                @include('employees._form')
            </form>
        </div>
    </div>
</x-app-layout>
