<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historics', function (Blueprint $table) {
            $table->increments('id');
            //id do usuário que fez uma transação
            $table->integer('user_id')->unsigned();
            //onDelete('cascade') deleta todos os registros do usuário
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            //tipo de movimentação: saida (o), entrada(I) e transferência (T)
            $table->enum('type', ['I', 'O', 'T']);
            //amount é o total movimentado
            $table->double('amount', 10, 2);
            //total de antes da transação
            $table->double('total_before', 10, 2);
            //total de depois da transação
            $table->double('total_after', 10, 2);
            //id do usuário que fez a transação
            $table->integer('user_id_transaction')->nullable();
            //data da transação
            $table->date('date');
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
        Schema::dropIfExists('historics');
    }
}
