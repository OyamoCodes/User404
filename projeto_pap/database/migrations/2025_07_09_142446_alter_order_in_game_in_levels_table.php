<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterOrderInGameInLevelsTable extends Migration
{
    public function up()
    {
        Schema::table('levels', function (Blueprint $table) {
            $table->integer('order_in_game')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('levels', function (Blueprint $table) {
            $table->integer('order_in_game')->nullable(false)->change();
        });
    }
}
