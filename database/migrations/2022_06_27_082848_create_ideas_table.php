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
        Schema::create('ideas', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger("inventor_id")->comment("تعیین خالق ایده");
            $table->string('title');
            $table->text('description');
            $table->enum('status', ['accepted', 'rejected', 'pending', 'rfd'])->default('pending')->comment('وضعیت ایده ، rfd : request for document');
            $table->string('status_message')->comment('پیام وضعیت از طرف ادمین در صورت قبول نشدن یا درخواست مدارک بیشتر');
            $table->timestamp('status_date')->nullable()->comment('تاریخ تغییر وضعیت');
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
        Schema::dropIfExists('ideas');
    }
};
