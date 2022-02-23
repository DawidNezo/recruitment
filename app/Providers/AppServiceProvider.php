<?php

namespace App\Providers;

use App\Interfaces\EmployeeInterface;
use App\Interfaces\RestaurantInterface;
use App\Services\EmployeeService;
use App\Services\RestaurantService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EmployeeInterface::class, function () {
            return new EmployeeService();
        });
        $this->app->bind(RestaurantInterface::class, function () {
            return new RestaurantService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
