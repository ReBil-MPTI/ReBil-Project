<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->string('transmission_type')->nullable()->after('car_image');
            $table->string('engine_capacity')->nullable()->after('transmission_type');
            $table->string('fuel_type')->nullable()->after('engine_capacity');
            $table->string('transmission_concept')->nullable()->after('fuel_type');
            $table->unsignedBigInteger('price')->nullable()->after('transmission_concept');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
