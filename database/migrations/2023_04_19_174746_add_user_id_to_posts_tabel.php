<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToPostsTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->foreignId('user_id')
            ->constrained()
            ->onUpdate('CASCADE')
            ->onDelete('CASCADE');
        });
    }


    public function down()
    {
        Schema::table('posts_tabel', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}
