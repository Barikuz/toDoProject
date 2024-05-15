<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('Title');
            $table->string('Content')->nullable();
            $table->tinyInteger('Status')->nullable()->default(0)->comment("0-Durum Seçilmedi 1-Yapılmadı 2-Yapılıyor 3-Yapıldı 4-Ertelendi");
            $table->dateTime('Deadline')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('category_id')->on('categories')->references('id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
