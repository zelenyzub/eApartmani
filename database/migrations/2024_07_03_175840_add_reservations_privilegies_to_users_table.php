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
            $table->boolean('canEditReservations')->default(0);
            $table->boolean('canAddReservations')->default(0);
            $table->boolean('canAllowReservations')->default(0);
            $table->boolean('canDeleteReservations')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('canEditReservations');
            $table->dropColumn('canAddReservations');
            $table->dropColumn('canAllowReservations');
            $table->dropColumn('canDeleteReservations');
        });
    }
};
