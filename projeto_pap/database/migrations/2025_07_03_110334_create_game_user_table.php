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
        Schema::create('game_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('game_id')->constrained()->onDelete('cascade');

            $table->boolean('is_favorite')->default(false);
            $table->text('note')->nullable();
            $table->unsignedTinyInteger('progress')->nullable(); // 0-100
            $table->dateTime('last_played_at')->nullable();
            $table->integer('played_times')->default(0);
            $table->unsignedTinyInteger('rating')->nullable(); // 1 a 5
            $table->boolean('hidden')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_user');
    }
};
