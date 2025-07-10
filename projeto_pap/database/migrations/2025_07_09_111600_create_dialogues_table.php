<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('dialogues', function (Blueprint $table) {
            $table->id();

            // Liga ao nível
            $table->foreignId('level_id')->constrained()->onDelete('cascade');

            // Nome do personagem (ex: Guia, NPC)
            $table->string('speaker');

            // Texto que será mostrado
            $table->text('text');

            // Se deve esperar input do jogador
            $table->boolean('wait_for_input')->default(false);

            // Se espera input, qual é o valor correto
            $table->string('expected_input')->nullable();

            // O que o NPC deve responder se o input for correto
            $table->text('correct_response_text')->nullable();
            $table->string('correct_response_speaker')->nullable();

            // O que o guia deve dizer se o input estiver errado
            $table->text('wrong_response_text')->nullable();
            $table->string('wrong_response_speaker')->nullable();

            // Ordem do diálogo
            $table->integer('order')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('dialogues');
    }
};
