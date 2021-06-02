<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProfilesNameDescriptionUrl extends Migration
{
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->renameColumn('title', 'real_name');
        });
    }

    public function down()
    {
        //
    }
}
