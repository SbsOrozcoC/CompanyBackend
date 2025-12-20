<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Editar Empleado</h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto">
        <div class="bg-white p-6 rounded shadow">
            <form method="POST" action="{{ route('employees.update', $employee) }}">
                @method('PUT')
                @csrf

                @include('employees._form')
            </form>
        </div>
    </div>
</x-app-layout>