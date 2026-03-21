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
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('delivery_boy_id')->nullable();
            $table->string('delivery_status')->default('pending')->comment('pending, assigned, picked_up, out_for_delivery, delivered, failed');
            $table->string('delivery_otp', 10)->nullable();
            $table->string('pod_image')->nullable();
            $table->timestamp('assigned_at')->nullable();
            $table->timestamp('picked_up_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->decimal('delivery_distance', 8, 2)->nullable();
            
            $table->foreign('delivery_boy_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['delivery_boy_id']);
            $table->dropColumn([
                'delivery_boy_id',
                'delivery_status',
                'delivery_otp',
                'pod_image',
                'assigned_at',
                'picked_up_at',
                'delivered_at',
                'delivery_distance',
            ]);
        });
    }
};
