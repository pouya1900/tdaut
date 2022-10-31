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
        Schema::create('support_messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('support_id')->comment('تعیین تیکت پشتیبانی');
            $table->unsignedInteger('admin_id')->nullable()->comment('ادمین مشاهده کننده یا ارسال کننده پیام');
            $table->enum('sender', ['user', 'admin'])->comment('تعیین ارسال کننده پیام');
            $table->text('text')->comment('متن پیام');
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
        Schema::dropIfExists('support_messages');
    }
};
