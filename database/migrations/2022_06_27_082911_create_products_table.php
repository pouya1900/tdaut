<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('عنوان');
            $table->string('description')->comment('توضیحات');
            $table->unsignedInteger('office_id')->comment('تعیین دفتر');
            $table->unsignedInteger('category_id')->comment('تعیین دسته');
            $table->enum('status', ['accepted', 'rejected', 'pending', 'rfd'])->comment('وضعیت تایید محضول توسط ادمین');
            $table->string('status_message')->nullable();
            $table->timestamp('status_date')->nullable()->comment('تاریخ تغییر وضعیت');
            $table->string('link')->comment('لینک دموی انلاین');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
