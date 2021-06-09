<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CorrectAnswer extends Migration
{
    public function up()
    {
        if (Schema::hasTable('questions')) {
            Schema::table('questions', function (Blueprint $table)
            {
                $table->unsignedBigInteger('correct_answer_id')->nullable();
            });
        }
    }

    public function down()
    {
        if (Schema::hasTable('questions')) {
            Schema::table('questions', function (Blueprint $table)
            {
                $table->dropColumn('correct_answer_id');
            });
        }
    }
}
