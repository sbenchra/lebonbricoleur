<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnonceUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annonce_user', function (Blueprint $table) {
            $table->integer('budget');
            $table->date('date_limite');
            $table->boolean('valide')->default(false);
             
            $table->integer('annonce_id');
            $table->integer('user_id');

            $table->primary(['annonce_id','user_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('annonce_user');
    }
}
