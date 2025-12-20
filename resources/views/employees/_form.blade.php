@csrf

@if ($errors->any())
    <div class="mb-4 rounded bg-red-100 p-4 text-red-700">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">

    <div>
        <label class="block text-sm font-medium">Nombres</label>
        <input type="text" name="first_name" value="{{ old('first_name', $employee->first_name ?? '') }}"
            class="w-full mt-1 rounded border-gray-300 no-special-chars">
    </div>

    <div>
        <label class="block text-sm font-medium">Apellidos</label>
        <input type="text" name="last_name" value="{{ old('last_name', $employee->last_name ?? '') }}"
            class="w-full mt-1 rounded border-gray-300 no-special-chars">
    </div>

    <div>
        <label class="block text-sm font-medium">Identificación</label>
        <input type="text" name="identification" maxlength="10" inputmode="numeric" pattern="[0-9]{10}"
            value="{{ old('identification', $employee->identification ?? '') }}"
            class="w-full mt-1 rounded border-gray-300 only-numbers">

    </div>

    <div>
        <label class="block text-sm font-medium">Teléfono</label>
        <input type="text" name="phone" maxlength="10" inputmode="numeric" pattern="[0-9]{1,10}"
            value="{{ old('phone', $employee->phone ?? '') }}" class="w-full mt-1 rounded border-gray-300 only-numbers">
    </div>

    <div class="md:col-span-2">
        <label class="block text-sm font-medium text-gray-700 mb-3">Cargos</label>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            @foreach ($positions as $position)
                @php
                    $checked = false;
                    if (old('positions')) {
                        $checked = in_array($position->id, old('positions', []));
                    } elseif (isset($employee) && $employee->positions) {
                        $checked = $employee->positions->contains('id', $position->id);
                    }
                @endphp

                <label
                    class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition cursor-pointer">
                    <input type="checkbox" name="positions[]" value="{{ $position->id }}"
                        class="h-5 w-5 text-blue-600 rounded border-gray-300 focus:ring-blue-500 focus:ring-2 focus:ring-offset-2"
                        {{ $checked ? 'checked' : '' }}>
                    <span class="text-gray-700 font-medium">{{ $position->name }}</span>
                </label>
            @endforeach
        </div>

        @error('positions')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>


    <div class="md:col-span-2">
        <label class="block text-sm font-medium">Dirección</label>
        <input type="text" name="address" value="{{ old('address', $employee->address ?? '') }}"
            class="w-full mt-1 rounded border-gray-300">
    </div>

    <div>
        <label class="block text-sm font-medium">País</label>
        <select name="country_id" id="country" class="w-full mt-1 rounded border-gray-300">
            <option value="">Seleccione un país</option>
            @foreach ($countries as $country)
                <option value="{{ $country->id }}"
                    {{ old('country_id', $employee->city->country_id ?? '') == $country->id ? 'selected' : '' }}>
                    {{ $country->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium">Ciudad</label>
        <select name="city_id" id="city" class="w-full mt-1 rounded border-gray-300"
            data-selected="{{ old('city_id', $employee->city_id ?? '') }}">
            <option value="">Seleccione la ciudad</option>
        </select>

    </div>

</div>

<div class="mt-6 flex justify-end gap-3">
    <a href="{{ route('employees.index') }}" class="px-4 py-2 bg-gray-300 rounded">
        Cancelar
    </a>

    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
        Guardar
    </button>
</div>
