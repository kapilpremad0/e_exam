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
        Schema::table('submit_results', function (Blueprint $table) {
            $table->string('correct_answer')->after('total_question')->nullable();
            $table->dropColumn('correct_anster');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('submit_results', function (Blueprint $table) {
            $table->dropColumn('correct_answer');
            $table->string('correct_anster')->after('total_question')->nullable();
        });
    }
};
