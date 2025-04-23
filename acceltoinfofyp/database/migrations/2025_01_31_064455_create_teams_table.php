<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('name');
            $table->string('team_principal');
            $table->string('engine_supplier');
            $table->string('constructors_championships');
            $table->unsignedBigInteger('driver1')->nullable(); // Foreign key for first driver
            $table->unsignedBigInteger('driver2')->nullable(); // Foreign key for second driver

            // Define foreign key constraint (optional)
            $table->foreign('driver1')->references('id')->on('drivers')->onDelete('set null');
            $table->foreign('driver2')->references('id')->on('drivers')->onDelete('set null');        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teams');

        $table->dropForeign(['driver1']);
        $table->dropForeign(['driver2']);

        // Drop columns
        $table->dropColumn(['driver1', 'driver2']);    }
};
