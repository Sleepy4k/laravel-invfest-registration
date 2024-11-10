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
        Schema::create('team_leaders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('team_id')->constrained('teams', 'id')->cascadeOnDelete();
            $table->foreignUuid('user_id')->constrained('users', 'id')->cascadeOnDelete();
            $table->string('name', 150);
            $table->string('phone', 50);
            $table->string('card');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_leaders');
    }
};
