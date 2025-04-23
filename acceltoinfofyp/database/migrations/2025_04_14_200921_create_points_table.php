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
        Schema::create('points', function (Blueprint $table) {
            $table->id();
            $table->string('pointable_type'); // Store the model type (e.g., Driver or Team)
            $table->unsignedBigInteger('pointable_id'); // Store the model ID
            $table->integer('points')->default(0); // Store the points
            $table->timestamps();
    
            $table->index(['pointable_type', 'pointable_id']); // Add index for faster lookup
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('points');
    }
};
