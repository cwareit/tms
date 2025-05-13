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
        Schema::create('firstappointments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('teacher_id')->index('firstappointments_teacher_id_foreign');
            $table->string('level');
            $table->string('class');
            $table->string('date');
            $table->string('remarks')->nullable();
            $table->string('created_by');
            $table->timestamps();
            $table->string('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('firstappointments');
    }
};
