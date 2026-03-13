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
        Schema::table('bornes', function (Blueprint $table) {
            // sans nullable elle est considérée comme non nulle.
            $table->string('nom_borne')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bornes', function (Blueprint $table) {
            $table->dropColumn(['nom_borne']);
        });
    }
};
