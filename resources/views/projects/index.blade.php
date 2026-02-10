@extends('layouts.app')

@section('content')
<div class="container py-5 mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark">Gerenciamento de Projetos</h2>
            <p class="text-muted">Lista de projetos cadastrados no sistema.</p>
        </div>
        <a href="{{ route('projects.create') }}" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-lg me-1"></i> Novo Projeto
        </a>
    </div>

    <div class="row mb-3">
        <div class="col-md-3">
            <div class="input-group input-group-sm">
                <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-filter"></i></span>
                <select id="statusFilter" class="form-select border-start-0 shadow-none fw-medium">
                    <option value="">Todos os Status</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status->name }}">{{ $status->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-3">
            <div class="table-responsive">
                <table id="projectsTable" class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Nome do Projeto</th>
                            <th>Descrição</th>
                            <th>Status</th> <th>Data de Criação</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($projects as $project)
                        <tr>
                            <td class="ps-4">
                                <span class="fw-bold text-primary">{{ $project->name }}</span>
                            </td>
                            <td>{{ Str::limit($project->description, 40) }}</td>
                            <td>
                                <span class="badge rounded-pill bg-{{ $project->status->style ?? 'secondary' }}">
                                    {{ $project->status->name }}
                                </span>
                            </td>
                            <td>{{ $project->created_at->format('d/m/Y') }}</td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        Ações
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                                        <li><a class="dropdown-item" href="{{ route('projects.show', $project) }}"><i class="bi bi-eye me-2"></i>Visualizar</a></li>
                                        <li><a class="dropdown-item" href="{{ route('projects.edit', $project) }}"><i class="bi bi-pencil me-2"></i>Editar</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <button type="button" class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $project->id }}">
                                                <i class="bi bi-trash me-2"></i>Excluir
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="{{ asset('css/dataTables.dataTables.min.css') }}">
<script src="{{ asset('js/jquery/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('js/datatables/dataTables.min.js') }}"></script>
<script src="{{ asset('js/tables/projects.js') }}"></script>
@endsection