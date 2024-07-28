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
        Schema::create('expences', function (Blueprint $table) {
            $table->id();
            $table->integer('apart_id');
            $table->foreign('apart_id')->references('id')->on('apartment');
            $table->string('expencesDescription');
            $table->double('expencesPrice');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expences');
    }
};
