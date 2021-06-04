<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('questions')) {
            Schema::create('questions', function (Blueprint $table) {
                $table->id();

                $table->unsignedBigInteger('user_id');
                $table->string('title');
                $table->text('description')->nullable();
                $table->string('image')->nullable();

                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
