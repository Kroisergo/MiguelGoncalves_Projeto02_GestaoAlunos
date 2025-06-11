@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Lista de Alunos</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Formulário de Filtro --}}
    <div class="card mb-4">
        <div class="card-header">
            Filtros
        </div>
        <div class="card-body">
            <form action="{{ route('alunos.index') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="curso_filter" class="form-label">Filtrar por Curso</label>
                    <select class="form-select" id="curso_filter" name="curso">
                        <option value="">Todos os Cursos</option>
                        {{-- Criar opções de curso dinamicamente (ver AlunoController) --}}
                        @foreach($cursosDisponiveis as $curso)
                            <option value="{{ $curso }}" {{ request('curso') == $curso ? 'selected' : '' }}>{{ $curso }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="status_filter" class="form-label">Filtrar por Status</label>
                    <select class="form-select" id="status_filter" name="status">
                        <option value="">Todos os Status</option>
                        <option value="Ativo" {{ request('status') == 'Ativo' ? 'selected' : '' }}>Ativo</option>
                        <option value="Inativo" {{ request('status') == 'Inativo' ? 'selected' : '' }}>Inativo</option>
                        <option value="Graduado" {{ request('status') == 'Graduado' ? 'selected' : '' }}>Graduado</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="min_age" class="form-label">Idade Mínima</label>
                    <input type="number" class="form-control" id="min_age" name="min_age" value="{{ request('min_age') }}" min="0">
                </div>
                <div class="col-md-2">
                    <label for="max_age" class="form-label">Idade Máxima</label>
                    <input type="number" class="form-control" id="max_age" name="max_age" value="{{ request('max_age') }}" min="0">
                </div>
                <div class="col-md-auto">
                    <button type="submit" class="btn btn-primary w-100">Aplicar Filtros</button>
                </div>
                <div class="col-md-auto">
                    <a href="{{ route('alunos.index') }}" class="btn btn-secondary w-100">Limpar Filtros</a>
                </div>
                <div class="col-md-auto">
                    {{-- Botão de Exportar para Excel --}}
                    @can('isAdmin')
                    <a href="{{ route('alunos.exportExcel', request()->query()) }}" class="btn btn-success w-100">
                        Exportar para Excel
                    </a>
                    @endcan
                </div>
            </form>
        </div>
    </div>

    <div class="mb-3">
        <a href="{{ route('alunos.create') }}" class="btn btn-success">Adicionar Novo Aluno</a>
    </div>

    {{-- Tabela de Alunos --}}
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome Completo</th>
                <th>Data de Nascimento</th>
                <th>E-mail</th>
                <th>Número de Telefone</th>
                <th>Curso</th>
                <th>Número de Matrícula</th>
                <th>Ano de Inscrição</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            {{--Aqui é onde vamos iterar sobre os alunos --}}
            @foreach ($alunos as $aluno)
                <tr>
                    <td>{{ $aluno->id }}</td>
                    <td>{{ $aluno->nome_completo }}</td>
                    <td>{{ $aluno->data_nascimento }}</td>
                    <td>{{ $aluno->email }}</td>
                    <td>{{ $aluno->numero_telemovel }}</td>
                    <td>{{ $aluno->curso }}</td>
                    <td>{{ $aluno->numero_matricula }}</td>
                    <td>{{ $aluno->ano_inscricao }}</td>
                    <td>{{ $aluno->status }}</td>
                    <td>
                        
                        @can('isAdmin')
                        <a href="{{ route('alunos.edit', $aluno->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        @endcan
                        
                        @can('isAdmin')
                        <form action="{{ route('alunos.destroy', $aluno->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja apagar este aluno?');">Apagar</button>
                        </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
            @if ($alunos->isEmpty())
            <tr>
                <td colspan="10" class="text-center">Nenhum aluno registado ainda.</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection