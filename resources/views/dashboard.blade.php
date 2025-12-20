<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                <div class="bg-white shadow-lg rounded-xl p-6 border border-gray-200">

                    <div class="flex items-center mb-6">
                        <div class="bg-blue-100 p-3 rounded-lg mr-4">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>

                        <h3 class="text-2xl font-bold text-gray-800">
                            Empleados
                        </h3>
                    </div>

                    <div class="mb-8">
                        <p class="text-gray-600 text-base leading-relaxed">
                            Gestiona la información de los empleados de la empresa. Crea nuevos registros, edita
                            información existente y administra los datos del personal.
                        </p>
                    </div>

                    <div class="space-y-4">
                        <a href="{{ route('employees.index') }}"
                            class="flex items-center w-full px-5 py-4 bg-blue-600 text-white font-medium rounded-lg shadow hover:bg-blue-700 transition duration-200">
                            <div class="flex items-center w-full">
                                <div class="bg-white/20 p-2 rounded-lg mr-4">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <span class="font-semibold">Ver empleados</span>
                                    <p class="text-sm text-white/90 font-normal">Explora la lista completa</p>
                                </div>
                                <svg class="w-5 h-5 text-white/70" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </a>
                        <div class="mb-2"></div>
                        <a href="{{ route('employees.create') }}"
                            class="flex items-center w-full px-5 py-4 bg-green-600 text-white font-medium rounded-lg shadow hover:bg-green-700 transition duration-200">
                            <div class="flex items-center w-full">
                                <div class="bg-white/20 p-2 rounded-lg mr-4">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <span class="font-semibold">Crear empleado</span>
                                    <p class="text-sm text-white/90 font-normal">Agregar nuevo registro</p>
                                </div>
                                <svg class="w-5 h-5 text-white/70" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
