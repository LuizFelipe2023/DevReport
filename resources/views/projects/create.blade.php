@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card border-0 shadow-sm rounded-3">
                
                <div class="card-body p-4 p-md-5">
                    <div class="mb-4">
                        <h3 class="fw-bold text-dark mb-1">Criar Novo Projeto</h3>
                        <p class="text-muted small">Preencha as informações abaixo para iniciar um novo projeto no seu painel.</p>
                    </div>

                    <form action="{{ route('projects.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-12 mb-4">
                                <label for="name" class="form-label fw-semibold small text-uppercase">Nome do Projeto</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-briefcase"></i></span>
                                    <input type="text" name="name" id="name" 
                                           class="form-control border-start-0 bg-light @error('name') is-invalid @enderror"
                                           placeholder="Ex: E-commerce Refatoração"
                                           value="{{ old('name') }}" required>
                                </div>
                                @error('name')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 mb-4">
                                <label for="github_url" class="form-label fw-semibold small text-uppercase">Repositório GitHub</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-github"></i></span>
                                    <input type="url" name="github_url" id="github_url" 
                                           class="form-control border-start-0 bg-light @error('github_url') is-invalid @enderror"
                                           placeholder="https://github.com/usuario/projeto"
                                           value="{{ old('github_url') }}">
                                </div>
                                @error('github_url')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="status_id" class="form-label fw-semibold small text-uppercase text-muted">Status do Projeto</label>
                                <select name="status_id" id="status_id" class="form-select bg-light @error('status_id') is-invalid @enderror" required>
                                    <option value="" selected disabled>Escolha um status...</option>
                                    
                                    @foreach($statuses as $status)
                                        <option value="{{ $status->id }}" 
                                            {{ (old('status_id') ?? ($project->status_id ?? '')) == $status->id ? 'selected' : '' }}>
                                            {{ $status->name }}
                                        </option>
                                    @endforeach
                                </select>
                                
                                @error('status_id')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 mb-4">
                                <label for="description" class="form-label fw-semibold small text-uppercase">Descrição do Projeto</label>
                                <textarea name="description" id="description" 
                                          class="form-control bg-light @error('description') is-invalid @enderror"
                                          rows="4" placeholder="Descreva brevemente os objetivos e tecnologias...">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-between mt-2 pt-4 border-top">
                            <a href="{{ route('projects.index') }}" class="btn btn-link text-decoration-none text-muted fw-semibold">
                                <i class="bi bi-arrow-left"></i> Voltar
                            </a>
                            <button type="submit" class="btn btn-primary px-5 fw-bold shadow-sm">
                                Criar Projeto
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection