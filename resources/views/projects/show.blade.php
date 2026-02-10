@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-9">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-1">
                            <li class="breadcrumb-item"><a href="{{ route('projects.index') }}" class="text-decoration-none">Projetos</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Detalhes</li>
                        </ol>
                    </nav>
                    <h2 class="fw-bold text-dark mb-0">{{ $project->name }}</h2>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-white border shadow-sm px-3">
                        <i class="bi bi-pencil me-1"></i> Editar
                    </a>
                    <a href="{{ route('projects.index') }}" class="btn btn-light border px-3">
                        <i class="bi bi-arrow-left me-1"></i> Voltar
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="card border-0 shadow-sm rounded-3 mb-4">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3">Sobre o Projeto</h5>
                            <p class="text-muted leading-relaxed">
                                {{ $project->description ?: 'Nenhuma descrição fornecida para este projeto.' }}
                            </p>
                            
                            @if($project->github_url)
                                <div class="mt-4 p-3 bg-light rounded-3 d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-github fs-4 me-3"></i>
                                        <div>
                                            <div class="small fw-bold text-dark">Repositório GitHub</div>
                                            <div class="small text-muted text-truncate" style="max-width: 250px;">{{ $project->github_url }}</div>
                                        </div>
                                    </div>
                                    <a href="{{ $project->github_url }}" target="_blank" class="btn btn-sm btn-dark px-3 rounded-pill">Ver Código</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-body p-4">
                            <div class="mb-4">
                                <label class="small fw-bold text-muted text-uppercase d-block mb-2">Status do Projeto</label>
                                
                                @php
                                    // Pega o estilo do banco (ex: success, warning) ou define secondary como padrão
                                    $style = $project->status->style ?? 'secondary';
                                @endphp

                                <span class="badge bg-{{ $style }} bg-opacity-10 text-{{ $style }} w-100 py-2 fs-6 border border-opacity-25 border-{{ $style }}">
                                    <i class="bi bi-circle-fill me-2 small" style="font-size: 0.5rem; vertical-align: middle;"></i>
                                    {{ $project->status->name ?? 'Indefinido' }}
                                </span>
                            </div>

                            <div class="mb-4">
                                <label class="small fw-bold text-muted text-uppercase d-block mb-1">Data de Criação</label>
                                <div class="text-dark fw-medium">
                                    <i class="bi bi-calendar3 me-2 text-muted"></i>{{ $project->created_at->format('d/m/Y') }}
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="small fw-bold text-muted text-uppercase d-block mb-1">Última Atualização</label>
                                <div class="text-dark fw-medium">
                                    <i class="bi bi-clock-history me-2 text-muted"></i>{{ $project->updated_at->diffForHumans() }}
                                </div>
                            </div>

                            <hr class="my-4 text-muted opacity-25">
                            <div class="d-grid">
                                <a href="{{ route('projects.pdf_individual', $project->id) }}" class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-file-earmark-pdf me-1"></i> Gerar Relatório de Logs
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection