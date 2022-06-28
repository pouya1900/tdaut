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
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('نام کامل فایل با پسوند');
            $table->string('model_type')->nullable()->comment('تعیین اینکه فایل مربوز به کدام بخش می باشد.');
            $table->string('ext');
            $table->unsignedInteger('size');
            $table->unsignedInteger('width')->nullable()->comment('عرض در صورتی که فایل عکس باشد.');
            $table->unsignedInteger('height')->nullable()->comment('طول در صورتی که فایل عکس باشد.');
            $table->unsignedInteger('duration')->nullable()->comment('زمان در صورتی که فایل فیلم باشد.');
            $table->string('mediable_type')->nullable()->comment('تعیین مدل مورد نظر');
            $table->unsignedInteger('mediable_id')->nullable()->comment('تعیین رکورد مورد نظر');
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
        Schema::dropIfExists('media');
    }
};
