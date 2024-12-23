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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('pekerjaan');
            $table->string('whatsapp')->nullable();
            $table->string('email')->nullable();
            $table->string('usia');
            $table->foreignId('daerah_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('category_id') // Use foreignId for Laravel 11
                ->constrained('categories')  // Automatically references the 'id' column
                ->cascadeOnDelete()          // ON DELETE CASCADE
                ->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
