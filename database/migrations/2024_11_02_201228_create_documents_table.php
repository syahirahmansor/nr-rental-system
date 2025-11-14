<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('documents', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('landlord_id'); // Foreign key, cannot be null
        $table->string('file_path'); // Cannot be null
        $table->string('original_name')->nullable(); // Can be null
        $table->timestamps();

        // Foreign key constraint
        $table->foreign('landlord_id', 'fk_documents_landlord_id_landlords')->references('id')->on('landlords')->onDelete('cascade')->onUpdate('cascade');
    });
}


public function down()
{
    Schema::dropIfExists('documents');
}

};
