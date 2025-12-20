<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Employee;
use App\Models\City;
use App\Models\Country;
use App\Models\Position;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    public function test_can_create_employee()
    {
        $country = Country::first();
        $city = City::where('country_id', $country->id)->first();
        $position = Position::first();

        $this->actingAs(User::factory()->create());
        $response = $this->post('/employees', [
            'first_name' => 'Juan',
            'last_name' => 'Perez',
            'identification' => '1234567890',
            'phone' => '3001234567',
            'address' => 'calle 1 carrera 2',
            'city_id' => $city->id,
            'positions' => [$position->id],
        ]);

        $response->assertRedirect('/employees');

        $this->assertDatabaseHas('employees', [
            'identification' => '1234567890',
        ]);
    }

    public function test_employee_validation_errors()
    {
        $this->actingAs(User::factory()->create());
        $response = $this->post('/employees', []);

        $response->assertSessionHasErrors([
            'first_name',
            'last_name',
            'identification',
            'city_id',
            'positions',
        ]);
    }

    public function test_cannot_create_two_presidents()
    {
        Employee::factory()->create([
            'is_president' => true
        ]);

        $city = City::first();
        $position = Position::first();

        $this->actingAs(User::factory()->create());
        $response = $this->post('/employees', [
            'first_name' => 'Carlos',
            'last_name' => 'Lopez',
            'identification' => '9999999999',
            'address' => 'calle 1 carrera 2',
            'city_id' => $city->id,
            'positions' => [$position->id],
            'is_president' => true,
        ]);

        $response->assertSessionHasErrors('is_president');
    }

    public function test_can_update_employee()
    {
        $employee = Employee::factory()->create();
        $city = City::first();

        $this->actingAs(User::factory()->create());
        $response = $this->put("/employees/{$employee->id}", [
            'first_name' => 'Nombre Editado',
            'last_name' => $employee->last_name,
            'identification' => $employee->identification,
            'address' => $employee->address,
            'city_id' => $city->id,
            'positions' => Position::pluck('id')->take(1)->toArray(),
        ]);

        $response->assertRedirect('/employees');

        $this->assertDatabaseHas('employees', [
            'id' => $employee->id,
            'first_name' => 'Nombre Editado',
        ]);
    }
}
