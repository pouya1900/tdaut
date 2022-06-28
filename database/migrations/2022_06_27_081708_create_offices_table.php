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
        Schema::create('offices', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('admin_contact')->nullable()->comment('ایمیل با تلفن برای تماس مستقیم با ریاست');
            $table->unsignedInteger('department_id');
            $table->unsignedInteger('projects_count')->comment('تعداد پروژه های انجام شده با صنعت');
            $table->enum('status', ["verified", 'rejected', 'pending', 'rfd'])->comment('وضعیت دفتر rfd : request for document');
            $table->string('status_message')->comment('پیام وضعیت از طرف ادمین به دفتر در صورت قبول نشدن یا درخواست مدارک');
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
        Schema::dropIfExists('offices');
    }
};
