<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PostIdToQuestionId extends Migration
{
    public function up()
    {
        Schema::table('question_id', function (Blueprint $table) {
            $table->renameColumn('post_id', 'question_id');
        });
    }

    public function down()
    {
        Schema::table('question_id', function (Blueprint $table) {
            //
        });
    }
}
