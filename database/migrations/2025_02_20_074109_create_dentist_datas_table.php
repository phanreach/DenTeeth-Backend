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
        Schema::create('dentist_datas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('license_number')->unique(); 
            $table->string('speciality');
            $table->unsignedInteger('experience_years');
            $table->string('qualification');
            $table->timestamps();
        });
        
    }
    public function down(): void
    {
        Schema::dropIfExists('dentist_datas');
    }
};
