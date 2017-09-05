<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleDeliveryNoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_deliverynote', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('delivery_note_id')->unsigned()->nullable();
            $table->foreign('delivery_note_id')->references('id')
                                              ->on('delivery_notes')
                                              ->onDelete('cascade');
            
            $table->integer('article_id')->unsigned()->nullable();

            $table->foreign('article_id')->references('id')
                ->on('articles')->onDelete('cascade');
            $table->double('cantidad_ingresada');
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
        //
    }
}
