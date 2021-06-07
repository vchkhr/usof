<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTagsTable extends Migration
{
    public function up()
    {
        if (Schema::hasTable('questions')) {
            Schema::table('questions', function (Blueprint $table) {
                $table->string('tags')->nullable();
            });
        }
    }

    public function down()
    {
        if (Schema::hasTable('questions')) {
            Schema::table('questions', function (Blueprint $table) {
                $table->dropColumn('tags');
            });
        }
    }
}
