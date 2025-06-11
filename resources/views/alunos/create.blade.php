@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Adicionar Novo Aluno</h1>
    <form action="{{ route('alunos.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nome_completo" class="form-label">Nome Completo</label>
            <input type="text" class="form-control @error('nome_completo') is-invalid @enderror" id="nome_completo" name="nome_completo" value="{{ old('nome_completo') }}" required>
            @error('nome_completo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="data_nascimento" class="form-label">Data de Nascimento</label>
            <input type="date" class="form-control @error('data_nascimento') is-invalid @enderror" id="data_nascimento" name="data_nascimento" value="{{ old('data_nascimento') }}" required> {{-- ALTERADO: adicionado 'required' --}}
            @error('data_nascimento')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="numero_telemovel" class="form-label">Número de Telemóvel</label>
            <input type="number" class="form-control @error('numero_telemovel') is-invalid @enderror" id="numero_telemovel" name="numero_telemovel" value="{{ old('numero_telemovel') }}" required> {{-- ALTERADO: type="number" e required --}}
            @error('numero_telemovel')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="curso" class="form-label">Curso</label>
            <input type="text" class="form-control @error('curso') is-invalid @enderror" id="curso" name="curso" value="{{ old('curso') }}" required>
            @error('curso')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="numero_matricula" class="form-label">Número de Matrícula</label>
            <input type="number" class="form-control @error('numero_matricula') is-invalid @enderror" id="numero_matricula" name="numero_matricula" value="{{ old('numero_matricula') }}" required> {{-- ALTERADO: type="number" --}}
            @error('numero_matricula')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="ano_inscricao" class="form-label">Ano de Inscrição</label>
            <input type="number" class="form-control @error('ano_inscricao') is-invalid @enderror" id="ano_inscricao" name="ano_inscricao" value="{{ old('ano_inscricao') }}" required>
            @error('ano_inscricao')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                <option value="">Selecione o Status</option>
                <option value="Ativo" {{ old('status') == 'Ativo' ? 'selected' : '' }}>Ativo</option>
                <option value="Inativo" {{ old('status') == 'Inativo' ? 'selected' : '' }}>Inativo</option>
                <option value="Graduado" {{ old('status') == 'Graduado' ? 'selected' : '' }}>Graduado</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Guardar Aluno</button>
        <a href="{{ route('alunos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection