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
    Schema::create('driver_stats', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('driver_id'); // Foreign key column
        $table->integer('number_of_wins')->default(0);
        $table->integer('points_scored')->default(0);
        $table->integer('number_of_races')->default(0);
        $table->integer('number_of_podiums')->default(0);
        $table->timestamps();

        // Define foreign key constraint
        $table->foreign('driver_id')->references('id')->on('drivers')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('driver_stats');
    }
};
