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
        Schema::create('office_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('office_id')->comment('تعیین دفتر');
            $table->string('memberable_type')->comment('تعیین مدل عضو دفتر(استاد،دانشجو،کارمند)');
            $table->unsignedInteger('memberable_id')->comment('تعیین رکورد');
            $table->unsignedInteger('role_id')->comment('تعیین مسئولیت');
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
        Schema::dropIfExists('office_members');
    }
};
