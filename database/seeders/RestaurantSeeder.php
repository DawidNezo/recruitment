<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $restaurants = Restaurant::factory()
            ->count(3)
            ->state(new Sequence(
                ['display_name' => 'MeatChefs'],
                ['display_name' => 'VegeChefs'],
                ['display_name' => 'BurgerChefs'],
            ))
            ->create();

        foreach($restaurants as $restaurant) {
            for($i = 0; $i < config('enums.limit_employee'); $i++) {
                $restaurant->employees()->attach(self::getRandomEmployee($restaurant->id));
            }
        }
    }

    private function getRandomEmployee(int $restaurant_id)
    {
        return Employee::whereDoesntHave('restaurants', function($query) use ($restaurant_id) {
                $query->where('id', $restaurant_id);
            })
            ->where(function($q) {
                $q->has('restaurants', '<=', config('enums.limit_restaurant'))
                    ->orDoesntHave('restaurants');
            })
            ->groupBy('employees.id')
            ->inRandomOrder()
            ->first('employees.id');
    }
}
