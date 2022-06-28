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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('text')->comment('متن گزارش');
            $table->string('reportable_type')->comment('تعیین مدل گزارش شده');
            $table->unsignedInteger('reportable_id')->comment('تعیین رکورد');
            $table->unsignedInteger('report_type_id')->comment('نعیین نوع گزارش');
            $table->timestamp('seen_at')->comment('زمان دیده شدن توسط ادمین');
            $table->unsignedInteger('seen_admin_id')->comment('تعیین ادمین بازدید کننده');
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
        Schema::dropIfExists('reports');
    }
};
