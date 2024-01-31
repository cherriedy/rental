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
        Schema::create('charge_histories', function (Blueprint $table) {
            $table->id();
            $table->string('code', 100)->unique();
            $table->bigInteger('user_id')->default(0);
            $table->tinyInteger('type')->comment('Phương thức thanh toán');
            $table->integer('amount')->default(0);
            $table->integer('discount')->default(0);
            $table->integer('total')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('charge_histories');
    }
};
