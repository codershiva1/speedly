<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First change to string to allow data migration
        Schema::table('categories', function (Blueprint $table) {
            $table->string('status')->default('active')->change();
        });
        
        \Illuminate\Support\Facades\DB::table('categories')->where('status', '1')->update(['status' => 'active']);
        \Illuminate\Support\Facades\DB::table('categories')->where('status', '0')->update(['status' => 'inactive']);

        Schema::table('brands', function (Blueprint $table) {
            $table->string('status')->default('active')->change();
        });

        \Illuminate\Support\Facades\DB::table('brands')->where('status', '1')->update(['status' => 'active']);
        \Illuminate\Support\Facades\DB::table('brands')->where('status', '0')->update(['status' => 'inactive']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->boolean('status')->default(true)->change();
        });

        Schema::table('brands', function (Blueprint $table) {
            $table->boolean('status')->default(true)->change();
        });
    }
};
