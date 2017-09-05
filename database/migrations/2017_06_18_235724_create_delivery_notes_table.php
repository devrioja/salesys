<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDeliveryNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_notes', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->date('fecha');
            $table->integer('numero_remito');

            $table->integer('supplier_id')->unsigned()
                                          ->index();
            $table->integer('deposit_id')->unsigned()
                ->index();
            
            $table->text('descripcion')->nullable();
            $table->boolean('active')->default(1);
            $table->timestamps();


            $table->foreign('supplier_id')
                ->references('id')
                ->on('suppliers')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('deposit_id')
                ->references('id')
                ->on('suppliers')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $estados = [
                'ABIERTO' => "ABIERTO",
                'CERRADO' => "CERRADO",
            ];

            $table->enum('estado_remito',$estados);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('delivery_notes');
    }
}
