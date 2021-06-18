<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('answers')) {
            Schema::create('answers', function (Blueprint $table) {
                $table->id();

                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('question_id');
                $table->text('description')->nullable();
                $table->string('image')->nullable();

                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('answers');
    }
}
