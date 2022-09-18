<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('cover')->nullable();
            $table->json('time_slots')->nullable();
            $table->float('minimum_order');
            $table->float('delivery_fee')->default(0);
            $table->float('discount')->default(0);
            $table->integer('delivery_time')->default('60');
            $table->string('address');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->double('longitude');
            $table->double('latitude');
            $table->json('order_types')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurants');
    }
};