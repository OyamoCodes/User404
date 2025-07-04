<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('levels', function (Blueprint $table) {
            $table->foreignId('template_id')->constrained()->after('game_id');
        });
    }

    public function down()
    {
        Schema::table('levels', function (Blueprint $table) {
            $table->dropForeign(['template_id']);
            $table->dropColumn('template_id');
        });
    }
};
