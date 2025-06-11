<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Aluno;

class AlunoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Aluno::create([
            'nome_completo' => 'Manuel Costa', // NOVO CAMPO
            'data_nascimento' => '1990-05-15', // NOVO CAMPO (data válida, no passado)
            'email' => 'manuel.costa@example.com',
            'numero_telemovel' => '912345678', // NOVO CAMPO (9 dígitos, numérico)
            'curso' => 'Engenharia Civil',
            'numero_matricula' => '20230001', // NOVO CAMPO (numérico, único)
            'ano_inscricao' => 2023,
            'status' => 'Ativo',
        ]);

        Aluno::create([
            'nome_completo' => 'Ana Pereira',
            'data_nascimento' => '1995-11-20',
            'email' => 'ana.pereira@example.com',
            'numero_telemovel' => '934567890',
            'curso' => 'Medicina Veterinária',
            'numero_matricula' => '20220005',
            'ano_inscricao' => 2022,
            'status' => 'Ativo',
        ]);

        Aluno::create([
            'nome_completo' => 'Pedro Afonso',
            'data_nascimento' => '1988-02-01',
            'email' => 'pedro.afonso@example.com',
            'numero_telemovel' => '960123456',
            'curso' => 'Direito',
            'numero_matricula' => '20210010',
            'ano_inscricao' => 2021,
            'status' => 'Inativo',
        ]);

        Aluno::create([
            'nome_completo' => 'Sofia Almeida',
            'data_nascimento' => '1992-07-25',
            'email' => 'sofia.almeida@example.com',
            'numero_telemovel' => '927890123',
            'curso' => 'Psicologia',
            'numero_matricula' => '20200020',
            'ano_inscricao' => 2020,
            'status' => 'Graduado',
        ]);
    }
}
