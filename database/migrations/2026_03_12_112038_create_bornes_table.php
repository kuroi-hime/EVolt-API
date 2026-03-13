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
        Schema::create('bornes', function (Blueprint $table) {
            $table->id();
            $table->string('type_connecteur');
            $table->integer('puissance_borne');
            // latitude entre 90|-90
            $table->decimal('latitude_borne', 8, 5);
            // longitude entre 180|-180
            $table->decimal('longitude_borne', 9, 5);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bornes');
    }
};
