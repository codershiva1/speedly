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
        Schema::create('ads', function (Blueprint $table) {
            $table->id();

            // Placement
            $table->foreignId('ad_placement_id')
                ->constrained()
                ->cascadeOnDelete();

            // What is being promoted (polymorphic style, but simple)
            $table->string('target_type'); 
            // product / category / store / url

            $table->unsignedBigInteger('target_id')->nullable();
            // product_id, category_id, etc.

            $table->string('title')->nullable();
            $table->string('banner_image')->nullable(); // for banner ads

            // Scheduling
            $table->dateTime('starts_at')->nullable();
            $table->dateTime('ends_at')->nullable();

            // Priority & control
            $table->integer('priority')->default(0);
            $table->boolean('is_active')->default(true);

            // Budgeting (Phase 1: optional but future ready)
            $table->integer('max_impressions')->nullable();
            $table->integer('max_clicks')->nullable();

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads');
    }
};
