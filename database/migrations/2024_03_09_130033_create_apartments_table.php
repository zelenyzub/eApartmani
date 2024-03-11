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
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string('apartmentName');
            $table->string('gmLocation');
            $table->string('apartmentPhotos');
            $table->integer('apartmentCapacity');
            $table->string('apartmentDescription');
            $table->string('ownerFirstName');
            $table->string('ownerLastName');
            $table->string('apartmentAddress');
            $table->string('aditionalApartInfo');
            $table->string('wifiPassword');
            $table->boolean('parking')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apartments');
    }
};
