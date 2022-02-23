<?php

namespace App\Services;

use App\Http\Resources\RestaurantResource;
use App\Interfaces\RestaurantInterface;
use App\Models\Restaurant;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RestaurantService implements RestaurantInterface
{

    public function assignable(int $employee_id): AnonymousResourceCollection
    {
        $restaurants = Restaurant::assignable($employee_id)->get();

        return RestaurantResource::collection($restaurants);
    }
}
