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
        Schema::create('office_permission_role', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('permission_id')->comment('ایدی دسترسی');
            $table->unsignedInteger('role_id')->comment('ایدی مسئولیت');
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
        Schema::dropIfExists('office_permission_role');
    }
};
