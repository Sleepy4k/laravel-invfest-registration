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
        Schema::create('competitions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 150);
            $table->string('slug', 150);
            $table->foreignUuid('level_id')->constrained('competition_levels', 'id')->cascadeOnDelete();
            $table->text('description')->nullable();
            $table->string('poster')->nullable();
            $table->string('guidebook')->nullable();
            $table->unsignedInteger('registration_fee');
            $table->string('whatsapp_group')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competitions');
    }
};
