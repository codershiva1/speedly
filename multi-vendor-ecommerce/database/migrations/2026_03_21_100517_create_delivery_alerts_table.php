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
        Schema::create('delivery_alerts', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->foreignId('user_id')->constrained()->onDelete('cascade');
            $blueprint->foreignId('order_id')->nullable()->constrained()->onDelete('set null');
            $blueprint->string('type'); // breakdown, accident, medical, other
            $blueprint->string('status')->default('pending'); // pending, acknowledged, resolved
            $blueprint->text('notes')->nullable();
            $blueprint->json('location')->nullable(); // {lat, lng}
            $blueprint->timestamp('resolved_at')->nullable();
            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_alerts');
    }
};
