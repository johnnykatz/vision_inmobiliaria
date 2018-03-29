<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMediaTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medias', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('url');
            $table->string('descripcion');
            $table->boolean('slide');
            $table->integer('tipo_media_id')->unsigned()->nullable();
            $table->integer('propiedad_id')->unsigned()->nullable();

            $table->timestamps();


        });

        Schema::table('medias', function (Blueprint $table) {

            $table->foreign('propiedad_id')->references('id')->on('propiedades');
            $table->foreign('tipo_media_id')->references('id')->on('tipos_medias');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('medias');
    }
}
