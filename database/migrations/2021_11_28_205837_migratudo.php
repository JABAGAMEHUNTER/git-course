<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Migratudo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->id("id");
            $table->string("logradouro");
            $table->string("numero");
            $table->string("cidade");
            $table->string("cep");
            $table->string("complemento");

        //    $table->unsignedBigInteger("usuario_id");
            $table->timestamps();
/*
           $table->foreign("usuario_id")
                ->references("id")->on("users")
                ->onDelete("cascade");*/
            });

Schema::create('users', function (Blueprint $table) {
            $table->id("id");
            $table->string('nome');
            $table->string('cpf')->unique();
            $table->string('email')->unique();
            $table->enum('usertipo',['admin','produtor','feirante'])->default('feirante');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->unsignedBigInteger("endereco");
            $table->timestamps();
            


           $table->foreign("endereco")
                ->references("id")->on("enderecos")
                ->onDelete("cascade");
        });
Schema::create('categorias', function (Blueprint $table) {
            $table->id("id");
            $table->string("categoria",100);
            $table->timestamps();
        });
Schema::create('produto', function (Blueprint $table) {//Cria tabela de produtos
            $table->increments("id");
            $table->string("title", 100);
            $table->string("image")->nullable();
            $table->enum('categoria',['hortifruti','peixes','carnes','naturais'])->default('hortifruti');
            $table->unsignedBigInteger("categoria_id");
            $table->text("content", 255)->nullable();
            $table->decimal("valor",10,2)->nullable();
            $table->string('procedencia',100)->nullable(); 
            $table->timestamps();
            
            $table->foreign("categoria_id")
                ->references("id")->on("categorias")
                ->onDelete("cascade");
        });
Schema::create('pedidos', function (Blueprint $table) {
            $table->increments("id");

            $table->string("status",4);
            $table->unsignedBigInteger("usuario_id");

            $table->timestamps();
            
            $table->foreign("usuario_id")
                ->references("id")->on("users")
                ->onDelete("cascade");
        });
Schema::create('itens_pedidos', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("quantidade");
            $table->decimal("valor",10,2);
            $table->datetime("dt_item");
            $table->timestamps();
            $table->integer("produto_id")->unsigned();
            $table->integer("pedido_id")->unsigned();

            $table->foreign("produto_id")
                ->references("id")->on("produto")
                ->onDelete("cascade");

                $table->foreign("pedido_id")
                ->references("id")->on("pedidos")
                ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enderecos');
        Schema::dropIfExists('users');
        Schema::dropIfExists('categorias');
        Schema::dropIfExists('produto');
        Schema::dropIfExists('pedidos');
        Schema::dropIfExists('itens_pedidos');
    }
}
