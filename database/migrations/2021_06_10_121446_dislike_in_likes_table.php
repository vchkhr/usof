<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DislikeInLikesTable extends Migration
{
    public function up()
    {
        if (Schema::hasTable('likes')) {
            Schema::table('likes', function (Blueprint $table) {
                $table->unsignedBigInteger('question_id')->nullable();
                $table->integer('is_like')->nullable();
                $table->unsignedBigInteger('recipient_id');
            });
        }
    }

    public function down()
    {
        if (Schema::hasTable('likes')) {
            Schema::table('likes', function (Blueprint $table) {
                $table->dropColumn('question_id');
                $table->dropColumn('is_like');
                $table->dropColumn('recipient_id');
            });
        }
    }
}
