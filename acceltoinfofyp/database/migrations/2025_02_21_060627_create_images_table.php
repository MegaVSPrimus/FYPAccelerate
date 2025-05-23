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
    Schema::create('images', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Image name
        $table->string('path')->nullable(); // File path (for storing in filesystem)
        $table->binary('image')->nullable(); // BLOB data (for storing in database)
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
