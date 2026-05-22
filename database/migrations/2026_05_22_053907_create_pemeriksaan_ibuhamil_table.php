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
        Schema::create('pemeriksaan_ibuhamil', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ibuhamil_id')->constrained('ibuhamil')->onDelete('cascade');
            $table->date('hpht');
            $table->date('hpl');
            $table->string('tensi');
            $table->decimal('berat');
            $table->string('pemeriksaan_darah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan_ibuhamil');
    }
};
