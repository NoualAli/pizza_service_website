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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('restaurant_id');
            $table->foreignId('user_id')->nullable();
            $table->string('lastname');
            $table->string('firstname');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('order_type');
            $table->decimal('delivery_fee');
            $table->decimal('tax');
            $table->decimal('subtotal');
            $table->decimal('total');

            $table->string('payment_method');
            $table->boolean('payed')->default(false);
            $table->json('location')->nullable();

            $table->string('state')->default('pending');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->on('users')->references('id')->onDelete('set null')->onUpdate('set null');
            $table->foreign('restaurant_id')->on('restaurants')->references('id')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};