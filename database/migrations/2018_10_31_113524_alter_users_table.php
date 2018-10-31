<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //emailを作るときにユニークにしていなかったので、一緒にユニークにしておく。
    public function up()
    {
        Schema::table('users', function(Blueprint $table){
            $table->unique('name');
            $table->unique('email'); 
          });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
