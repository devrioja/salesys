<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleDepositTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_deposit', function (Blueprint $table) {
           
            $table->engine = 'InnoDB';
            
            $table->increments('id');
           
            $table->integer('article_id')->unsigned()->nullable();
            $table->foreign('article_id')->references('id')
                ->on('articles')->onDelete('cascade');
           
            $table->integer('deposit_id')->unsigned()->nullable();
            $table->foreign('deposit_id')->references('id')
                ->on('deposits')->onDelete('cascade');

            $table->double('stock');
            
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
        Schema::dropIfExists('article_deposit');
    }
}
