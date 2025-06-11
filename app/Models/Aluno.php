<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;

    protected $table = 'alunos';

    //Campos adicionar
    protected $fillable = [
        'nome_completo',
        'data_nascimento',
        'email',
        'numero_telemovel',
        'curso',
        'numero_matricula',
        'ano_inscricao',
        'status',
    ];
}
