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
            $table->text('text');
            $table->unsignedInteger('rfp_id')->comment('تعیین rfp');
            $table->enum('type', ['rfp', 'proposal'])->comment('تعیین نوع سند');
            $table->enum('status', ['pending', 'sent'])->nullable()->comment('تعیین نوع سند');
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
