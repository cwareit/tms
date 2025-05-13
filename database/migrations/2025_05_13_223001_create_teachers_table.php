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
        Schema::create('teachers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index('teachers_user_id_foreign');
            $table->string('name');
            $table->string('gender');
            $table->string('province');
            $table->string('district');
            $table->string('municipality');
            $table->string('ward');
            $table->string('type');
            $table->string('level');
            $table->string('class');
            $table->string('sheetroll_number')->nullable();
            $table->string('epf_number')->nullable();
            $table->string('license_number')->nullable();
            $table->string('insurance_number')->nullable();
            $table->string('dob_in_certificate');
            $table->string('dob_in_citizenship');
            $table->string('latest_qualification');
            $table->string('first_appointment_date');
            $table->string('studied_subject');
            $table->string('appointment_subject')->nullable();
            $table->string('teaching_subject')->nullable();
            $table->string('account_number')->nullable();
            $table->string('phone_number');
            $table->string('email')->nullable();
            $table->string('created_by');
            $table->string('photo')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->string('fy');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
