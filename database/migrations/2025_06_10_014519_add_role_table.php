<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     *Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //Irá adicionar a coluna role com um valor padrão de user
            //A coluna vai ser adicionada após a coluna email
            $table->string('role')->default('user')->after('email');
        });
    }

    /**
     *Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //Isto vai remover a coluna role se a migration for revertida
            $table->dropColumn('role');
        });
    }
};
