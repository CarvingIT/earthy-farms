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
        Schema::create('soil_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('crop_id');
            $table->date('sample_date');
            $table->double('Ph');
            $table->double('EC');
            $table->double('OC');
            $table->double('N');
            $table->double('P');
            $table->double('K');
            $table->double('Boron');
            $table->double('Fe');
            $table->double('Zn');
            $table->double('Cu');
            $table->double('Mg');
            $table->double('S');
            $table->double('microbial_count');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soil_reports');
    }
};
