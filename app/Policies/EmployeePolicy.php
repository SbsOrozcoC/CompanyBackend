<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Employee;

class EmployeePolicy
{
    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Employee $employee)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Employee $employee)
    {
        return true;
    }

    public function delete(User $user, Employee $employee)
    {
        return !$employee->is_president;
    }
}
