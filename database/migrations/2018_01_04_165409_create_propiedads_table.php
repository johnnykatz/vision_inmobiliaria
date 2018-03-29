<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePropiedadsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propiedades', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('nombre');
            $table->string('direccion');
            $table->integer('tipo_propiedad_id')->unsigned();
            $table->integer('tipo_operacion_id')->unsigned();
            $table->integer('estado_propiedad_id')->unsigned();
            $table->decimal('precio', 9);
            $table->text('descripcion');
            $table->string('latitud')->nullable();
            $table->string('longitud')->nullable();
            $table->integer('cant_habitaciones');
            $table->integer('cant_banios');
            $table->integer('cant_living');
            $table->integer('cant_garage');
            $table->integer('cant_cocina');
            $table->integer('orden')->nullable();
            $table->boolean('destacada')->default(false);
            $table->boolean('slide')->default(false);
            $table->timestamps();

            $table->foreign('tipo_propiedad_id')->references('id')->on('tipos_propiedades');
            $table->foreign('tipo_operacion_id')->references('id')->on('tipos_operaciones');
            $table->foreign('estado_propiedad_id')->references('id')->on('estados_propiedades');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('propiedades');
    }
}
