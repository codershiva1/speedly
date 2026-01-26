<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();          // SPEEDLY50
            $table->enum('type', ['fixed', 'percent']);
            $table->decimal('value', 10, 2);           // 100 or 10%
            $table->decimal('min_cart_value', 10, 2)->nullable();
            $table->integer('max_uses')->nullable();   // overall limit
            $table->integer('used_count')->default(0);
            $table->timestamp('expires_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('coupons');
    }
};
