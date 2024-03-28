<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contatos', function (Blueprint $table) {            
            $table->id('contato_id');
            $table->foreignId('endereco_id')->references('endereco_id')->on('enderecos');
            $table->string('contatos_nome');
            $table->string('contatos_email');
            $table->string('contatos_telefone');
            $table->string('contatos_celular');
            $table->string('contatos_imagem');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contatos');
    }
};
