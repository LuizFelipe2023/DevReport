@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card border-0 shadow-sm rounded-3">
                
                <div class="card-body p-4 p-md-5">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <h3 class="fw-bold text-dark mb-1">Editar Projeto</h3>
                            <p class="text-muted small mb-0">Atualize as informações do projeto <span class="text-primary fw-bold">#{{ $project->id }}</span></p>
                        </div>
                        <span class="badge bg-light text-primary border px-3 py-2 rounded-pill small">
                            Criado em: {{ $project->created_at->format('d/m/Y') }}
                        </span>
                    </div>

                    <hr class="text-muted opacity-25 mb-4">

                    <form action="{{ route('projects.update', $project->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-12 mb-4">
                                <label for="name" class="form-label fw-semibold small text-uppercase text-muted">Nome do Projeto</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-pencil-square text-muted"></i></span>
                                    <input type="text" name="name" id="name" 
                                           class="form-control border-start-0 ps-0 @error('name') is-invalid @enderror"
                                           value="{{ old('name', $project->name) }}" required>
                                </div>
                                @error('name')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-7 mb-4">
                                <label for="github_url" class="form-label fw-semibold small text-uppercase text-muted">Repositório GitHub</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-github text-muted"></i></span>
                                    <input type="url" name="github_url" id="github_url" 
                                           class="form-control border-start-0 ps-0 @error('github_url') is-invalid @enderror"
                                           value="{{ old('github_url', $project->github_url) }}">
                                </div>
                                @error('github_url')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-5 mb-4">
                                <label for="status_id" class="form-label fw-semibold small text-uppercase text-muted">Status Atual</label>
                                <select name="status_id" id="status_id" class="form-select bg-light fw-medium @error('status_id') is-invalid @enderror" required>
                                    <option value="" disabled>Selecione o status...</option>
                                    
                                    @foreach($statuses as $status)
                                        <option value="{{ $status->id }}" 
                                            {{ (old('status_id', $project->status_id) == $status->id) ? 'selected' : '' }}>
                                            {{ $status->name }}
                                        </option>
                                    @endforeach
                                </select>
                                
                                @error('status_id')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 mb-4">
                                <label for="description" class="form-label fw-semibold small text-uppercase text-muted">Descrição</label>
                                <textarea name="description" id="description" 
                                          class="form-control @error('description') is-invalid @enderror"
                                          rows="5">{{ old('description', $project->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-between mt-4 pt-4 border-top">
                            <a href="{{ route('projects.index') }}" class="btn btn-link text-decoration-none text-secondary fw-semibold p-0">
                                <i class="bi bi-x-circle"></i> Descartar Alterações
                            </a>
                            <button type="submit" class="btn btn-dark px-5 py-2 fw-bold shadow-sm">
                                Salvar Alterações
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="text-center mt-4">
                <p class="text-muted small">Deseja remover este projeto? Vá para a <a href="{{ route('projects.index') }}" class="text-danger">lista geral</a>.</p>
            </div>
        </div>
    </div>
</div>
@endsection