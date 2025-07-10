<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeOutputExplanationNullableInLevelsTable extends Migration
{
    public function up()
    {
        Schema::table('levels', function (Blueprint $table) {
            $table->text('output_explanation')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('levels', function (Blueprint $table) {
            $table->text('output_explanation')->nullable(false)->change();
        });
    }
}
