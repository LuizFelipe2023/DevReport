@extends('layouts.app')

@section('content')
    <div class="container py-5 mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="fw-bold text-dark">Detalhes do Usuário</h2>
                        <p class="text-muted">Informações detalhadas do perfil e permissões.</p>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary btn-sm dropdown-toggle shadow-sm" type="button"
                            data-bs-toggle="dropdown">
                            <i class="bi bi-gear me-1"></i> Ações
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                            <li>
                                <a class="dropdown-item py-2" href="{{ route('users.index') }}">
                                    <i class="bi bi-list-ul me-2 text-primary"></i> Voltar para Lista
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item py-2" href="{{ route('users.edit', $user) }}">
                                    <i class="bi bi-pencil me-2 text-warning"></i> Editar Dados
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card shadow-sm border-0 overflow-hidden">
                    <div class="bg-primary p-5 text-center">
                        <div class="avatar-lg bg-white text-primary rounded-circle d-inline-flex align-items-center justify-content-center shadow-lg"
                            style="width: 100px; height: 100px; font-size: 2.5rem; font-weight: bold;">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <h3 class="text-white mt-3 fw-bold mb-0">{{ $user->name }}</h3>
                        <span class="badge bg-white text-primary rounded-pill px-3 shadow-sm mt-2">
                            {{ $user->role->name ?? 'Sem Nível' }}
                        </span>
                    </div>

                    <div class="card-body p-4">
                        <div class="row g-4">

                            <div class="col-md-6">
                                <div class="p-3 border rounded bg-light">
                                    <label class="text-muted small fw-bold text-uppercase d-block mb-1">E-mail</label>
                                    <span class="text-dark fw-bold">{{ $user->email }}</span>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="p-3 border rounded bg-light">
                                    <label class="text-muted small fw-bold text-uppercase d-block mb-1">Data de
                                        Cadastro</label>
                                    <span class="text-dark fw-bold">{{ $user->created_at->format('d/m/Y \à\s H:i') }}</span>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="p-3 border rounded bg-light">
                                    <label class="text-muted small fw-bold text-uppercase d-block mb-2">Versionamentos
                                        Vinculados</label>

                                    @forelse($user->versionings as $versioning)
                                        <a href="{{ route('versionings.show', $versioning->id) }}"
                                            class="badge bg-secondary text-decoration-none me-1 mb-1"
                                            style="font-size: 0.875rem;">
                                            v{{ $versioning->version_number }} -
                                            {{ $versioning->project->name ?? 'Sem Projeto' }}
                                        </a>
                                    @empty
                                        <span class="text-muted fst-italic">Nenhum versionamento vinculado.</span>
                                    @endforelse
                                </div>
                            </div>

                        </div>

                        @if(auth()->id() === $user->id)
                            <div class="alert alert-info border-0 mt-4 mb-0 d-flex align-items-center">
                                <i class="bi bi-person-check-fill me-2 fs-4"></i>
                                <span>Este é o seu perfil de usuário logado no momento.</span>
                            </div>
                        @endif
                    </div>

                    <div class="card-footer bg-white text-end p-3 border-top-0">
                        <small class="text-muted small">Última atualização: {{ $user->updated_at->diffForHumans() }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection