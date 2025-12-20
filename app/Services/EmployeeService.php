<?php

namespace App\Services;

use App\Models\Employee;
use Illuminate\Validation\ValidationException;

class EmployeeService
{
    public function create(array $data): Employee
    {
        $this->validatePresident($data);
        $this->validateBoss($data);

        $employee = Employee::create($data);

        if (isset($data['positions'])) {
            $employee->positions()->sync($data['positions']);
        }

        return $employee;
    }

    public function update(Employee $employee, array $data): Employee
    {
        $this->validatePresident($data, $employee);
        $this->validateBoss($data, $employee);

        $employee->update($data);

        if (isset($data['positions'])) {
            $employee->positions()->sync($data['positions']);
        }

        return $employee;
    }

    protected function validatePresident(array $data, Employee $employee = null): void
    {
        if (!empty($data['is_president'])) {

            $exists = Employee::where('is_president', true)
                ->when($employee, fn($q) => $q->where('id', '!=', $employee->id))
                ->exists();

            if ($exists) {
                throw ValidationException::withMessages([
                    'is_president' => 'Ya existe un presidente en la empresa.',
                ]);
            }

            if (!empty($data['boss_id'])) {
                throw ValidationException::withMessages([
                    'boss_id' => 'El presidente no puede tener jefe.',
                ]);
            }
        }
    }

    protected function validateBoss(array $data, Employee $employee = null): void
    {
        if (empty($data['boss_id'])) {
            return;
        }

        if ($employee && $data['boss_id'] == $employee->id) {
            throw ValidationException::withMessages([
                'boss_id' => 'Un empleado no puede ser su propio jefe.',
            ]);
        }

        $boss = Employee::active()->find($data['boss_id']);

        if (!$boss) {
            throw ValidationException::withMessages([
                'boss_id' => 'El jefe seleccionado no es válido.',
            ]);
        }

        if ($employee && $this->createsCycle($employee, $boss)) {
            throw ValidationException::withMessages([
                'boss_id' => 'La jerarquía genera un ciclo inválido.',
            ]);
        }
    }

    protected function createsCycle(Employee $employee, Employee $boss): bool
    {
        while ($boss) {
            if ($boss->id === $employee->id) {
                return true;
            }
            $boss = $boss->boss;
        }

        return false;
    }
}
