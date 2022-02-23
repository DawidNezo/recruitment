<?php

namespace Tests\Feature;

use App\Models\Employee;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class RestaurantServiceTest extends TestCase
{
    use RefreshDatabase;

    public function testAssignable()
    {
        $user = User::factory()->create();
        $employee = Employee::factory()->create();
        $restaurants = Restaurant::factory()->count(4)->create();

        $this->actingAs($user)->get(route('restaurants.assignable', $employee->id))
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'display_name'
                    ]
                ]
            ]);
    }
}
