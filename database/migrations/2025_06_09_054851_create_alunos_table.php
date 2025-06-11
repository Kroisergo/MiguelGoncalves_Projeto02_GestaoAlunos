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
        Schema::create('alunos', function (Blueprint $table) {
            $table->id(); //Cria uma coluna 'id' (chave primária, auto-incremento)
            $table->string('nome_completo'); //String
            $table->date('data_nascimento')->nullable();
            $table->string('email')->unique(); //String único - O email deve ser único
            $table->string('numero_telemovel')->nullable();
            $table->string('curso'); //String
            $table->string('numero_matricula')->unique();
            $table->integer('ano_inscricao'); //Int - Pode ser um ano (2023)
            $table->string('status')->default('Ativo'); //String - 'ativo', 'inativo'
            $table->timestamps(); //Cria as colunas 'created_at' e 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alunos');
    }
};
