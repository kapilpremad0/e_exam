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
            $table->dropColumn('city');
            $table->dropColumn('state');
            $table->string('address')->after('mobile')->nullable();
            $table->string('city_id')->after('address')->nullable();
            $table->string('state_id')->after('city_id')->nullable();
            $table->string('is_verify')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->dropColumn('city_id');
            $table->dropColumn('state_id');
            $table->string('city')->after('mobile')->nullable();
            $table->string('state')->after('city')->nullable();
            $table->dropColumn('is_verify');
        });
    }
};
