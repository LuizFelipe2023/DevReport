@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h2 class="fw-bold text-main mb-0">Logs de Versão</h2>
                <p class="text-muted small">Histórico de entregas e responsáveis por projeto.</p>
            </div>

            <div class="btn-group shadow-sm" role="group">
                <a href="{{ route('versionings.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg me-1"></i> Nova Versão
                </a>

                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="false">
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="btnGroupDrop1">
                        <li>
                            <h6 class="dropdown-header">Exportar Dados</h6>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('versionings.pdf') }}">
                                <i class="bi bi-file-earmark-pdf me-2 text-danger"></i> Gerar PDF Geral
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="#" onclick="window.print();">
                                <i class="bi bi-printer me-2"></i> Imprimir Tela
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                    <div>{{ session('success') }}</div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
                    <div>{{ session('error') }}</div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>n>
            </div>
        @endif

        <div class="mb-4 d-flex align-items-center gap-3 bg-white p-3 rounded shadow-sm">
            <div class="flex-grow-1" style="max-width: 250px;">
                <label for="userFilter" class="form-label small fw-bold text-muted text-uppercase">Responsável</label>
                <select id="userFilter" class="form-select form-select-sm">
                    <option value="">Todos</option>
                    @foreach($users as $user)
                        <option value="{{ $user->name }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex-grow-1" style="max-width: 250px;">
                <label for="statusFilter" class="form-label small fw-bold text-muted text-uppercase">Status</label>
                <select id="statusFilter" class="form-select form-select-sm">
                    <option value="">Todos</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status->name }}">{{ $status->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="align-self-end">
                <button id="resetFilter" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-arrow-counterclockwise"></i> Resetar
                </button>
            </div>
        </div>

        <div class="card border-0 shadow-sm p-3">
            <div class="table-responsive">
                <table id="versioningsTable" class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">Versão</th>
                            <th>Status</th>
                            <th>Projeto</th>
                            <th>Responsáveis</th>
                            <th>Data</th>
                            <th class="text-end pe-4">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($versionings as $v)
                            <tr>
                                <td class="ps-4">
                                    <span class="badge bg-primary px-3 py-2">v{{ $v->version_number }}</span>
                                </td>
                                <td class="fw-semibold">{{ $v->status->name}}</td>
                                <td class="fw-semibold">{{ $v->project->name }}</td>
                                <td>
                                    <div class="d-flex flex-wrap gap-1">
                                        @foreach($v->users as $user)
                                            <span class="badge bg-light text-dark border shadow-sm fw-normal px-2 py-1 rounded-pill"
                                                style="font-size: 0.75rem;">
                                                <i class="bi bi-person text-main me-1"></i>{{ $user->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="text-muted small">{{ $v->created_at->diffForHumans() }}</td>
                                <td class="text-end pe-4">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('versionings.show', $v->id) }}"
                                            class="btn btn-sm shadow-sm d-flex align-items-center justify-content-center"
                                            style="background-color: #38bdf8; color: #0f172a; width: 32px; height: 32px; border-radius: 8px;">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <a href="{{ route('versionings.edit', $v->id) }}"
                                            class="btn btn-sm shadow-sm d-flex align-items-center justify-content-center"
                                            style="background-color: #fbbf24; color: #0f172a; width: 32px; height: 32px; border-radius: 8px;">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <button type="button"
                                            class="btn btn-sm shadow-sm d-flex align-items-center justify-content-center border-0"
                                            style="background-color: #f87171; color: #ffffff; width: 32px; height: 32px; border-radius: 8px;"
                                            data-bs-toggle="modal" data-bs-target="#deleteModal{{ $v->id }}">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>
                                    </div>
                                </td>


                                <div class="modal fade" id="deleteModal{{ $v->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header border-0">
                                                <h5 class="modal-title text-danger">
                                                    <i class="bi bi-exclamation-triangle me-2"></i>Confirmar Exclusão
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body py-4">
                                                <p class="mb-0">
                                                    Tem certeza que deseja excluir a versão
                                                    <strong>v{{ $v->version_number }}</strong> do projeto
                                                    <strong>{{ $v->project->name }}</strong>?
                                                </p>
                                                <p class="text-muted small mt-2">
                                                    Esta ação não pode ser desfeita.
                                                </p>
                                            </div>
                                            <div class="modal-footer border-0">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    data-bs-dismiss="modal">Cancelar</button>
                                                <form action="{{ route('versionings.destroy', $v->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Excluir</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/jquery/jquery-3.6.0.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/dataTables.dataTables.min.css') }}">
    <script src="{{ asset('js/datatables/dataTables.min.js') }}"></script>
    <script src="{{ asset('js/tables/versionings.js') }}"></script>
@endsection