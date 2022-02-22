<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Restaurant;
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
        DB::table('restaurants')->insert([
            ['display_name' => 'MeatChefs'],
            ['display_name' => 'VegeChefs'],
            ['display_name' => 'BurgerChefs'],
        ]);

        foreach(Restaurant::all() as $restaurant) {
            for($i = 0; $i < config('enums.limit_employee'); $i++) {
                $restaurant->employees()->attach(self::getRandomEmployee($restaurant));
            }
        }
    }

    private function getRandomEmployee($restaurant) {
        $employees = Employee::whereDoesntHave('restaurants', function ($q) use ($restaurant) {
            $q->where('restaurant_id', $restaurant->id);
        })->get();
        $employee = $employees->random(1)->first();
        if(self::validateEmployee($employee)) {
            return $employee;
        } else {
            return self::getRandomEmployee($employees);
        }
    }

    private function validateEmployee($employee) {
        return $employee->restaurants->count() <= config('enums.limit_restaurant');
    }
}
