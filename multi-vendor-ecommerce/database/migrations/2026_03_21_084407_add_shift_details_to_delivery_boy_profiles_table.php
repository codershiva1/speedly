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
        Schema::table('delivery_boy_profiles', function (Blueprint $table) {
            $table->boolean('is_on_shift')->default(false)->after('is_online');
            $table->boolean('is_on_break')->default(false)->after('is_on_shift');
            $table->timestamp('last_shift_start')->nullable()->after('is_on_break');
            $table->timestamp('last_shift_end')->nullable()->after('last_shift_start');
            $table->timestamp('last_online_at')->nullable()->after('last_shift_end');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('delivery_boy_profiles', function (Blueprint $table) {
            //
        });
    }
};
