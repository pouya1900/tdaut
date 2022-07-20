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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['professor', 'student', 'staff'])->comment('موجودیت عضو (استاد،دانشجو،کارمند)');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedInteger('rank_id')->nullable()->comment('مرتبه علمی در صورت استاد بودن ، موجود در جدول rank');
            $table->unsignedInteger('department_id')->nullable()->comment('دانشکده ، موجود در جدول department');
            $table->string('group')->nullable()->comment('گروه درسی');
            $table->unsignedInteger('degree_id')->nullable()->comment('مقطع تحصیلی');
            $table->string('student_number')->nullable()->comment('شماره دانشجویی در صورت دانشجو بودن');
            $table->string('confirmation_token')->nullable();
            $table->string('reset_token')->nullable();
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
        Schema::dropIfExists('members');
    }
};
