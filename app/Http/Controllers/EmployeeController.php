<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\City;
use App\Models\Position;
use App\Models\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Services\EmployeeService;

class EmployeeController extends Controller
{
    public function __construct(private EmployeeService $employeeService)
    {
        $this->authorizeResource(Employee::class, 'employee');
    }

    public function index()
    {
        $employees = Employee::with(['city.country', 'positions', 'boss'])
            ->active()
            ->get();

        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create', [
            'countries' => Country::orderBy('name')->get(),
            'positions' => Position::where('name', '!=', 'Presidente')->get(),
            'bosses'    => Employee::notPresident()->get(),
            'selectedCountry' => null,
            'selectedCity'    => null,
        ]);
    }

    public function store(StoreEmployeeRequest $request, EmployeeService $service)
    {
        $service->create($request->validated());

        return redirect()
            ->route('employees.index')
            ->with('success', 'Empleado creado correctamente');
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', [
            'employee'  => $employee->load('positions', 'city.country'),
            'countries' => Country::orderBy('name')->get(),
            'positions' => Position::where('name', '!=', 'Presidente')->get(),
            'bosses'    => Employee::notPresident()
                ->where('id', '!=', $employee->id)
                ->get(),
        ]);
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee, EmployeeService $service)
    {
        $service->update($employee, $request->validated());

        return redirect()
            ->route('employees.index')
            ->with('success', 'Empleado actualizado correctamente');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()
            ->route('employees.index')
            ->with('success', 'Empleado eliminado correctamente');
    }
}
