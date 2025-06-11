<?php

namespace App\Exports;

use App\Models\Aluno;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings; // Importar para adicionar cabeçalhos
use Maatwebsite\Excel\Concerns\ShouldAutoSize; // Opcional: para que as colunas se ajustem automaticamente

class AlunosExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $alunos; // Propriedade para guardar a coleção de alunos filtrada

    public function __construct($alunos = null)
    {
        // Se uma coleção de alunos for passada, usa-a. Caso contrário, exporta todos os alunos.
        $this->alunos = $alunos ?? Aluno::all();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Retorna a coleção de alunos que será exportada
        return $this->alunos->map(function ($aluno) {
            // Formata a data de nascimento para um formato legível no Excel, se necessário
            $data_nascimento = $aluno->data_nascimento ? \Carbon\Carbon::parse($aluno->data_nascimento)->format('d/m/Y') : '';

            return [
                'ID' => $aluno->id,
                'Nome Completo' => $aluno->nome_completo,
                'Data de Nascimento' => $data_nascimento,
                'E-mail' => $aluno->email,
                'Número de Telemóvel' => $aluno->numero_telemovel,
                'Curso' => $aluno->curso,
                'Número de Matrícula' => $aluno->numero_matricula,
                'Ano de Inscrição' => $aluno->ano_inscricao,
                'Status' => $aluno->status,
                // Adiciona aqui outras colunas se tiveres
            ];
        });
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        // Define os cabeçalhos das colunas no ficheiro Excel
        return [
            'ID',
            'Nome Completo',
            'Data de Nascimento',
            'E-mail',
            'Número de Telemóvel',
            'Curso',
            'Número de Matrícula',
            'Ano de Inscrição',
            'Status',
        ];
    }
}
