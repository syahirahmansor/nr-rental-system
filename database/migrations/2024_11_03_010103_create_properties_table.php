<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('landlord_id'); // Foreign key to landlords table
            $table->string('property_name');
            $table->string('property_number', 10)->unique();
            $table->string('price', 255);
            $table->enum('types', ['landed', 'room', 'high-rise']);
            $table->tinyInteger('utilities')->unsigned()->default(10);
            $table->tinyInteger('rooms')->unsigned()->default(10);
            $table->tinyInteger('parking')->unsigned()->default(10);
            $table->enum('furnished', ['fully', 'partially', 'unfurnished']);
            $table->text('map_link');
            $table->enum('tenant', ['male', 'female']);
            $table->string('contact_number', 15);
            $table->tinyInteger('contract')->unsigned()->default(12);
            $table->timestamp('apply_date')->nullable(); // Apply date for booking
            $table->text('message')->nullable(); // Message from landlord
            $table->string('status', 50)->default('in progress'); // Initial status as pending
            $table->string('remark', 255)->nullable(); // Admin remarks
            $table->timestamps();

            // Foreign key constraint for landlord_id
            $table->foreign('landlord_id')->references('id')->on('landlords')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
