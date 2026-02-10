@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 p-md-5">
                    
                    <div class="mb-4">
                        <h3 class="fw-bold text-main mb-1">Visualizar Versionamento</h3>
                        <p class="text-muted small text-uppercase tracking-wider">Detalhamento técnico da release v{{ $versioning->version_number }}</p>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold">Projeto Relacionado</label>
                            <div class="form-control bg-light border-0 py-2 shadow-sm">
                                <i class="bi bi-stack text-main me-2"></i> {{ $versioning->project->name }}
                            </div>
                        </div>

                        <div class="col-md-3 mb-4">
                            <label class="form-label fw-bold">Versão</label>
                            <div class="form-control bg-light border-0 py-2 shadow-sm fw-bold text-main">
                                {{ $versioning->version_number }}
                            </div>
                        </div>

                        <div class="col-md-3 mb-4">
                            <label class="form-label fw-bold">Status</label>
                            <div class="form-control bg-light border-0 py-2 shadow-sm d-flex align-items-center">
                                {{-- Lógica Dinâmica baseada no relacionamento --}}
                                @php $style = $versioning->status->style ?? 'secondary'; @endphp
                                <span class="badge bg-{{ $style }} w-100 py-1">
                                    {{ $versioning->status->name ?? 'Indefinido' }}
                                </span>
                            </div>
                        </div>

                        <div class="col-md-4 mb-4">
                            <label class="form-label fw-bold">Data de Lançamento</label>
                            <div class="form-control bg-light border-0 py-2 shadow-sm">
                                <i class="bi bi-calendar3 text-muted me-2"></i>
                                {{ $versioning->release_date ? \Carbon\Carbon::parse($versioning->release_date)->format('d/m/Y') : "Não definida" }}
                            </div>
                        </div>

                        <div class="col-md-8 mb-4">
                            <label class="form-label fw-bold">Responsáveis</label>
                            <div class="form-control bg-light border-0 py-2 shadow-sm d-flex flex-wrap gap-2 h-auto">
                                @forelse($versioning->users as $user)
                                    <span class="badge bg-white text-dark border shadow-sm d-flex align-items-center px-2 py-1 rounded-pill">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=0ea5e9&color=fff" 
                                             class="rounded-circle me-2" width="18">
                                        {{ $user->name }}
                                    </span>
                                @empty
                                    <span class="text-muted small">Nenhum responsável vinculado</span>
                                @endforelse
                            </div>
                        </div>

                        <div class="col-12 mb-4">
                            <label class="form-label fw-bold">Changelog (Notas da Versão)</label>
                            <div class="form-control bg-light border-0 p-3 shadow-sm" style="min-height: 120px; white-space: pre-wrap;">{{ $versioning->changelog ?: 'Nenhuma nota registrada.' }}</div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center justify-content-between mt-4 pt-4 border-top border-secondary border-opacity-25">
                        <a href="{{ route('versionings.index') }}" class="btn btn-link text-decoration-none text-muted fw-semibold p-0">
                            <i class="bi bi-arrow-left"></i> Voltar para a lista
                        </a>
                        <div class="d-flex gap-2">
                            <a href="{{ route('versionings.edit', $versioning->id) }}" class="btn btn-primary px-5 fw-bold shadow-sm">
                                <i class="bi bi-pencil-square me-2"></i> Editar Dados
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection