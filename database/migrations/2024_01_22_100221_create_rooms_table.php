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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->comment('Mã chủ bài đăng');
            $table->string('title')->comment('Tiêu đề bài đăng');
            $table->string('slug')->unique();
            $table->text('description')->comment('Mô tả bài đăng');
            $table->tinyInteger('subject_id')->default(0)->comment('0:Tất cả - 1:Nam - 2:Nữ');
            $table->bigInteger('price')->comment('Giá cho thuê');
            $table->bigInteger('area')->comment('Diện tích');
            $table->bigInteger('category_id')->comment('Mã chuyên mục');
            $table->bigInteger('city_id')->comment('Mã tỉnh/thành phố');
            $table->bigInteger('district_id')->comment('Mã quận/huyện');
            $table->bigInteger('ward_id')->comment('Mã phường/xã');
            $table->bigInteger('street_id')->comment('Mã đường phố');
            $table->string('apartment_number')->comment('Số nhà');
            $table->string('exact_address')->comment('Địa chỉ nhà đầy đủ');
            // $table->string('map')->nullable();
            $table->mediumText('map')->nullable();
            $table->string('picture')->nullable()->comment('Hình bài đăng');
            $table->string('video_url')->nullable()->comment('Đường dẫn video trên youtube');
            $table->date('expiration_date')->comment('Ngày hết hạn tin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
