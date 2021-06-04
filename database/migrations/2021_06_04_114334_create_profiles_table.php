<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('profiles')) {
            Schema::create('profiles', function (Blueprint $table) {
                $table->id();

                $table->unsignedBigInteger('user_id');
                $table->string('real_name')->nullable();
                $table->text('description')->nullable();
                $table->string('url')->nullable();
                $table->string('profile_photo')->nullable();

                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
