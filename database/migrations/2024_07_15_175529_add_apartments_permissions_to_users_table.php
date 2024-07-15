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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('canAddApartments')->default(0);
            $table->boolean('canEditApartments')->default(0);
            $table->boolean('canDeleteApartments')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('canAddApartments');
            $table->dropColumn('canEditApartments');
            $table->dropColumn('canDeleteApartments');
        });
    }
};
