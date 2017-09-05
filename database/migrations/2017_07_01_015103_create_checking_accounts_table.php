<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCheckingAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checking_accounts', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->date('fecha_alta');
            $table->date('fecha_vencimiento');

            $table->double('balance');
            $table->text('descripcion')->nullable();
            $table->integer('customer_id')->unsigned()->index();
            $table->foreign('customer_id')->references('id')
                                          ->on('customers')
                                          ->onDelete('cascade')
                                          ->onUpdate('cascade');

            $table->boolean('active')
                ->default(1);
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
        Schema::drop('checking_accounts');
    }
}
