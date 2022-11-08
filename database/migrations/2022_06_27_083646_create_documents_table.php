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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->unsignedInteger('office_id')->comment('تعیین دفتر');
            $table->unsignedInteger('user_id')->comment('تعیین کاربر');
            $table->unsignedInteger('parent_id')->nullable()->comment('تعیین rfp برای پروپوزال');
            $table->enum('type', ['rfp', 'proposal'])->comment('تعیین نوع سند');
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
        Schema::dropIfExists('documents');
    }
};
