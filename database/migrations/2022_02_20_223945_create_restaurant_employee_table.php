<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurant_employee', function (Blueprint $table) {
            $table->unsignedBigInteger('restaurant_id')->index();
            $table->foreign('restaurant_id')->references('id')->on('restaurants');
            $table->unsignedBigInteger('employee_id')->index();
            $table->foreign('employee_id')->references('id')->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurant_employee');
    }
}
