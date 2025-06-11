<?php

namespace App\Http\Controllers;

use App\Models\Aluno; //.*
use Illuminate\Http\Request;
use Carbon\Carbon; //Classe Carbon para manipular as datas
use App\Exports\AlunosExport; //Classe de exportação
use Maatwebsite\Excel\Facades\Excel; //Facade do Excel
use Illuminate\Support\Facades\Gate;

class AlunoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) //Faz com que receba o objeto request
    {
        $query = Aluno::query(); //Começar por uma nova query Eloquent

        //Filtrar por Curso
        if ($request->filled('curso')) { //Verifica se o campo curso está presente e não vazio
            $query->where('curso', $request->input('curso'));
        }

        //Filtrar por Status
        if ($request->filled('status')) { //Verifica se o campo status está presente e não vazio
            $query->where('status', $request->input('status'));
        }

        //Filtrar por Idade
        if ($request->filled('min_age') || $request->filled('max_age')) {
            $minAge = $request->input('min_age');
            $maxAge = $request->input('max_age');

            if ($minAge) {
                $maxBirthDate = Carbon::now()->subYears($minAge)->endOfDay(); //Aluno mais jovem deve ter nascido antes desta data
                $query->where('data_nascimento', '<=', $maxBirthDate);
            }

            if ($maxAge) {
                $minBirthDate = Carbon::now()->subYears($maxAge + 1)->startOfDay(); //Aluno mais velho deve ter nascido depois desta data
                $query->where('data_nascimento', '>=', $minBirthDate);
            }
        }

        $alunos = $query->get(); //Executa a query e obtém os resultados

        //Para preencher o dropdown de cursos no filtro: Obtém todos os cursos únicos da base de dados
        $cursosDisponiveis = Aluno::select('curso')->distinct()->pluck('curso')->sort();

        //Passa os alunos e os cursos disponíveis para a view
        return view('alunos.index', compact('alunos', 'cursosDisponiveis'));
    }

    /**
     *Método para exportar para excel
     */
    public function exportExcel(Request $request)
    {
        Gate::authorize('isAdmin');

        $query = Aluno::query();

        if ($request->filled('curso')) {
            $query->where('curso', $request->input('curso'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('min_age') || $request->filled('max_age')) {
            $minAge = $request->input('min_age');
            $maxAge = $request->input('max_age');

            if ($minAge) {
                $maxBirthDate = Carbon::now()->subYears($minAge)->endOfDay();
                $query->where('data_nascimento', '<=', $maxBirthDate);
            }

            if ($maxAge) {
                $minBirthDate = Carbon::now()->subYears($maxAge + 1)->startOfDay();
                $query->where('data_nascimento', '>=', $minBirthDate);
            }
        }

        $alunosParaExportar = $query->get(); // Obtém a coleção de alunos FILTRADA

        // Cria uma nova instância da classe de exportação, passando os alunos filtrados
        return Excel::download(new AlunosExport($alunosParaExportar), 'alunos.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('alunos.create'); //Carrega a view do formulário de criação
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validar Os Dados
        //O método validate() do objeto Request vai automaticamente redirecionar de volta ao formulário com os erros e dados antigos se a validação falhar.
        $validatedData = $request->validate(
            [
                'nome_completo' => 'required|string|max:255', // Alterado
                'data_nascimento' => 'required|date|before_or_equal:today', // Nova regra
                'email' => 'required|string|email|max:255|unique:alunos,email',
                'numero_telemovel' => 'required|numeric|max:999999999999', // Nova regra
                'curso' => 'required|string|max:255',
                'numero_matricula' => 'required|numeric|max:999999999999|unique:alunos,numero_matricula', // Alterado
                'ano_inscricao' => 'required|integer|min:1900|max:' . (date('Y') + 1),
                'status' => 'required|string|in:Ativo,Inativo,Graduado',
            ],
            [
                'nome_completo.required' => 'O campo Nome Completo é obrigatório.',
                'data_nascimento.required' => 'O campo Data de Nascimento é obrigatório.',
                'data_nascimento.date' => 'O campo Data de Nascimento deve ser uma data válida.',
                'data_nascimento.before_or_equal' => 'O campo Data de Nascimento não pode ser uma data futura.',
                'email.required' => 'O campo email é obrigatório.',
                'email.email' => 'O campo email deve ser um endereço de email válido.',
                'email.unique' => 'Este email já está registado.',
                'numero_telemovel.required' => 'O campo Número de Telemóvel é obrigatório.',
                'numero_telemovel.numeric' => 'O campo Número de Telemóvel deve conter apenas números.',
                'numero_telemovel.digits' => 'O campo Número de Telemóvel deve ter 9 dígitos.',
                'curso.required' => 'O campo curso é obrigatório.',
                'numero_matricula.required' => 'O campo Número de Matrícula é obrigatório.',
                'numero_matricula.numeric' => 'O campo Número de Matrícula deve conter apenas números.',
                'numero_matricula.unique' => 'Este Número de Matrícula já está registado.',
                'ano_inscricao.required' => 'O campo ano de inscrição é obrigatório.',
                'ano_inscricao.integer' => 'O campo ano de inscrição deve ser um número inteiro.',
                'ano_inscricao.min' => 'O ano de inscrição deve ser igual ou posterior a 1900.',
                'ano_inscricao.max' => 'O ano de inscrição não pode ser no futuro distante.',
                'status.required' => 'O campo status é obrigatório.',
                'status.in' => 'O status selecionado não é válido.',
            ]
        );

        //O método create() do Eloquent pode ser usado se o modelo tiver o $fillable ou $guarded configurado
        Aluno::create($validatedData);

        //Redirecionar com Mensagem de Sucesso
        return redirect()->route('alunos.index')->with('success', 'Aluno criado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Aluno $aluno) //.*
    {
        return view('alunos.show', compact('aluno'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aluno $aluno) //.*
    {
        Gate::authorize('isAdmin');
        return view('alunos.edit', compact('aluno')); //Vai passar o objeto aluno para a view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aluno $aluno) //.*
    {
        Gate::authorize('isAdmin');
        //Validar Dados
        $validatedData = $request->validate(
            [
                'nome_completo' => 'required|string|max:255',
                'data_nascimento' => 'required|date|before_or_equal:today',
                'email' => 'required|string|email|max:255|unique:alunos,email,' . $aluno->id,
                'numero_telemovel' => 'required|numeric|max:999999999999',
                'curso' => 'required|string|max:255',
                'numero_matricula' => 'required|numeric|max:999999999999|unique:alunos,numero_matricula,' . $aluno->id, // Alterado
                'ano_inscricao' => 'required|integer|min:1900|max:' . (date('Y') + 1),
                'status' => 'required|string|in:Ativo,Inativo,Graduado',
            ],
            [
                'nome_completo.required' => 'O campo Nome Completo é obrigatório.',
                'data_nascimento.required' => 'O campo Data de Nascimento é obrigatório.',
                'data_nascimento.date' => 'O campo Data de Nascimento deve ser uma data válida.',
                'data_nascimento.before_or_equal' => 'O campo Data de Nascimento não pode ser uma data futura.',
                'email.required' => 'O campo email é obrigatório.',
                'email.email' => 'O campo email deve ser um endereço de email válido.',
                'email.unique' => 'Este email já está registado.',
                'numero_telemovel.required' => 'O campo Número de Telemóvel é obrigatório.',
                'numero_telemovel.numeric' => 'O campo Número de Telemóvel deve conter apenas números.',
                'numero_telemovel.digits' => 'O campo Número de Telemóvel deve ter 9 dígitos.',
                'curso.required' => 'O campo curso é obrigatório.',
                'numero_matricula.required' => 'O campo Número de Matrícula é obrigatório.',
                'numero_matricula.numeric' => 'O campo Número de Matrícula deve conter apenas números.',
                'numero_matricula.unique' => 'Este Número de Matrícula já está registado.',
                'ano_inscricao.required' => 'O campo ano de inscrição é obrigatório.',
                'ano_inscricao.integer' => 'O campo ano de inscrição deve ser um número inteiro.',
                'ano_inscricao.min' => 'O ano de inscrição deve ser igual ou posterior a 1900.',
                'ano_inscricao.max' => 'O ano de inscrição não pode ser no futuro distante.',
                'status.required' => 'O campo status é obrigatório.',
                'status.in' => 'O status selecionado não é válido.',
            ]
        );

        //Atualiza o Aluno na Base de Dados
        $aluno->update($validatedData);

        //Vai redirecionar com Mensagem de Sucesso
        return redirect()->route('alunos.index')->with('success', 'Aluno atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aluno $aluno) //.*
    {
        Gate::authorize('isAdmin');
        $aluno->delete(); //Isto vai apagar o aluno da base de dados

        //Vai redirecionar de volta para a lista de alunos com uma mensagem de sucesso
        return redirect()->route('alunos.index')->with('success', 'Aluno apagado com sucesso.');
    }
}
