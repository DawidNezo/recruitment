<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RestaurantResource;
use App\Interfaces\RestaurantInterface;
use App\Models\Employee;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    private $restaurantService;

    public function __construct(RestaurantInterface $restaurantService)
    {
        $this->restaurantService = $restaurantService;
    }

    /**
     * @OA\Get(
     *      path="/api/restaurants/assignable",
     *      @OA\Parameter(
     *          name="id",
     *          description="Employee id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function assignable(int $employee_id)
    {
        return $this->restaurantService->assignable($employee_id);
    }
}
