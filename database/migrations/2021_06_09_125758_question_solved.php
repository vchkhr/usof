<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class QuestionSolved extends Migration
{
    public function up()
    {
        if (Schema::hasTable('questions')) {
            Schema::table('questions', function (Blueprint $table)
            {
                $table->integer('solved');
            });
        }
    }

    public function down()
    {
        if (Schema::hasTable('questions')) {
            Schema::table('questions', function (Blueprint $table)
            {
                $table->dropColumn('solved');
            });
        }
    }
}
