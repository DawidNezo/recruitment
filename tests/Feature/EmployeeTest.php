<?php

namespace Tests\Feature;

use App\Interfaces\EmployeeInterface;
use App\Models\Employee;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;

    public function testGetEmployees()
    {
        $this->getJson(route('employees.index'))
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'surname',
                        'email',
                        'restaurants' => [
                            'id',
                            'display_name'
                        ],
                        'restaurant_ids' => []
                    ]
                ]
            ]);
    }

    public function testDestroyEmployee()
    {
        $employee = Employee::factory()->create();
        $user = User::factory()->create();

        $this->actingAs($user)->delete(route('employees.destroy', [$employee]))
            ->assertStatus(Response::HTTP_NO_CONTENT);
    }

    public function testUpdateEmployee()
    {
        $employee = Employee::factory()->create();
        $user = User::factory()->create();

        $this->actingAs($user)->patch(route('employees.update', $employee), ['name' => $employee->name, 'surname' => $employee->surname, 'email' => $employee->email])
            ->assertStatus(Response::HTTP_OK);
    }

    public function testStoreEmployee()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post(route('employees.store'), ['name' => "newName", 'surname' => 'newSurname', 'email' => 'test@test.pl'])
            ->assertStatus(Response::HTTP_CREATED);
    }

    public function testShowEmployee()
    {
        $employee = Employee::factory()->create();

        $this->getJson(route('employees.show', $employee))
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'surname',
                    'email',
                ]
            ]);
    }

    public function testAssignRestaurant()
    {
        $employee = Employee::factory()->create();
        $user = User::factory()->create();

        $this->actingAs($user)->patch(route('employees.assign.restaurant', $employee))
            ->assertStatus(Response::HTTP_OK);

        $restaurants = Restaurant::factory()->count(4)->create();
        $this->actingAs($user)->patch(route('employees.assign.restaurant', $employee), ['restaurant_ids' => $restaurants->pluck('id')->toArray()])
            ->assertSessionHasErrors();
    }
}
