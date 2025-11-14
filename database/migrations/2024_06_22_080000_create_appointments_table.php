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

        Schema::create('booking_times', function (Blueprint $table) {
            $table->id();
            $table->string('AppointmentTime');
            $table->timestamps();
        });
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('AppointmentNumber', 10);
            $table->date('AppointmentDate');
            $table->unsignedBigInteger('AppointmentTime_id');
            $table->string('name');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('landlord_id');
            $table->text('Message')->nullable();
            $table->timestamp('ApplyDate');
            $table->string('Remark')->nullable();
            $table->text('DocMsg')->nullable();
            $table->string('Status')->nullable();
            $table->timestamps();

            
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('landlord_id')->references('id')->on('landlords')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('AppointmentTime_id')->references('id')->on('booking_times')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
        Schema::dropIfExists('booking_times');
    }
};
