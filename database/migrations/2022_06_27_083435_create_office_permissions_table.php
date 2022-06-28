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
        Schema::create('office_permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('نام دسترسی به انگلیسی که برنامه با آن کار می کند.');
            $table->string('title')->comment('عنوان دسترسی');
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
        Schema::dropIfExists('office_permissions');
    }
};
