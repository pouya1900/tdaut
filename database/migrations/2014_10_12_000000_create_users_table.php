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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedTinyInteger('role_id')->comment('نوع کاربر که در جدول roles وجود دارد.');
            $table->enum('type', ['real', 'legal'])->comment('نوع کاربر ، حقیقی حقوقی');
            $table->enum('status', ["verified", 'rejected', 'pending', 'rfd'])->default('pending')->comment('وضعیت دفتر rfd : request for document');
            $table->string('status_message')->nullable()->comment('پیام وضعیت از طرف ادمین به کاربر در صورت قبول نشدن یا درخواست مدارک');
            $table->timestamp('status_date')->nullable()->comment('تاریخ تغییر وضعیت');
            $table->string('confirmation_token')->nullable()->comment('توکن برای وریفای کردن ایمیل');
            $table->string('reset_token')->nullable()->comment('توکن برای ریست کردن پسوورد');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
