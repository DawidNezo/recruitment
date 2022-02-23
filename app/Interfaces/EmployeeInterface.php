<?php

namespace App\Interfaces;

use App\Http\Requests\EmployeeAssignRestaurantRequest;
use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;

interface EmployeeInterface
{
    public function getEmployees();

    public function storeEmployee(EmployeeRequest $request);

    public function showEmployee(Employee $employee);

    public function updateEmployee(EmployeeRequest $request, Employee $employee);

    public function destroyEmployee(Employee $employee);

    public function assignRestaurant(EmployeeAssignRestaurantRequest $request, Employee $employee);
}
