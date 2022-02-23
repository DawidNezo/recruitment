<?php

namespace App\Services;

use App\Http\Requests\EmployeeAssignRestaurantRequest;
use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Interfaces\EmployeeInterface;
use App\Models\Employee;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class EmployeeService implements EmployeeInterface
{
    public function getEmployees(): AnonymousResourceCollection
    {
        $employees = Employee::with('restaurants')->get();

        return EmployeeResource::collection($employees);
    }

    public function storeEmployee(EmployeeRequest $request): EmployeeResource
    {
        $employee = Employee::create($request->validated());

        return new EmployeeResource($employee);
    }

    public function showEmployee(Employee $employee): EmployeeResource
    {
        $employee = $employee->load('restaurants');

        return new EmployeeResource($employee);
    }

    public function updateEmployee(EmployeeRequest $request, Employee $employee): EmployeeResource
    {
        $employee->update($request->validated());

        return new EmployeeResource($employee);
    }

    public function destroyEmployee(Employee $employee): Response
    {
        $employee->restaurants()->detach();
        $employee->delete();

        return response()->noContent();
    }

    public function assignRestaurant(EmployeeAssignRestaurantRequest $request, Employee $employee): EmployeeResource
    {
        $employee->restaurants()->sync($request->restaurant_ids);

        return new EmployeeResource($employee);
    }
}
