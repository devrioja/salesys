<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nombre');
            $table->text('descripcion')
                  ->nullable();
            $table->integer('category_id')
                  ->unsigned()->index();
            $table->integer('brand_id')
                  ->unsigned()->index();
            $table->integer('unit_measure_id')
                ->unsigned()->index();
            $table->double('stockMin');
            $table->double('stockMax')
                  ->nullable();

            $table->double('precio');
            $table->timestamps();
            $table->boolean('active')
                  ->default(1);

            $table->foreign('category_id')
                ->references('id')
                ->on('categories');

            $table->foreign('unit_measure_id')
                ->references('id')
                ->on('unit_measures');

            $table->foreign('brand_id')
                ->references('id')
                ->on('brands');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('articles');
    }
}
