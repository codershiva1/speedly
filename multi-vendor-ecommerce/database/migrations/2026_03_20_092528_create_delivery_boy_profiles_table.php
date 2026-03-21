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
        Schema::create('delivery_boy_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('vehicle_type')->nullable(); // e.g., bike, scooty
            $table->string('vehicle_number')->nullable();
            $table->string('dl_number')->nullable();
            $table->string('dl_image')->nullable();
            $table->string('rc_number')->nullable();
            $table->string('rc_image')->nullable();
            $table->string('aadhaar_number')->nullable();
            $table->string('aadhaar_image')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('bank_ifsc')->nullable();
            $table->boolean('is_online')->default(false);
            $table->decimal('current_lat', 10, 8)->nullable();
            $table->decimal('current_lng', 11, 8)->nullable();
            $table->string('delivery_zone')->nullable();
            $table->decimal('rating', 3, 2)->default(5.00);
            $table->integer('total_deliveries')->default(0);
            $table->decimal('cash_in_hand', 10, 2)->default(0.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_boy_profiles');
    }
};
