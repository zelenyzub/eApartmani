<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->integer('apart_id');
            $table->foreign('apart_id')->references('id')->on('apartment');
            $table->string('guestFirstName');
            $table->string('guestLastName');
            $table->date('date_start');
            $table->date('date_end');
            $table->double('fullPrice');
            $table->double('taxPrice');
            $table->integer('guestNumber');
            $table->time('arrivalTime')->nullable();
            $table->boolean('guestRegistered')->default(0);
            $table->enum('reservationType', ['booking', 'airbnb', 'private']);
            $table->boolean('guestPaid')->default(0);
            $table->boolean('guestHasCar')->default(0);
            $table->string('guestDescription')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
