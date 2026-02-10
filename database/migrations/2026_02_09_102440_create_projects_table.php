<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // GANTI Schema::table MENJADI Schema::create
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('image'); // Thumbnail utama
            $table->string('link')->nullable();
            $table->string('architecture')->nullable();
            $table->string('duration')->nullable();
            $table->json('gallery')->nullable(); // Untuk menyimpan banyak foto
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
