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

    <div class="card shadow-sm border-0">
        <div class="card-body p-3">
            <div class="table-responsive">
                <table id="projectsTable" class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Nome do Projeto</th>
                            <th>Descrição</th>
                            <th>Data de Criação</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($projects as $project)
                        <tr>
                            <td class="ps-4">
                                <span class="fw-bold">{{ $project->name }}</span>
                            </td>
                            <td>{{ Str::limit($project->description, 50) }}</td>
                            <td>{{ $project->created_at->format('d/m/Y') }}</td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Ações
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('projects.show', $project) }}">
                                                <i class="bi bi-eye me-2"></i> Visualizar
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('projects.edit', $project) }}">
                                                <i class="bi bi-pencil me-2"></i> Editar
                                            </a>
                                        </li>
                                        <li>
                                            <button type="button" class="dropdown-item text-danger"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal{{ $project->id }}">
                                                <i class="bi bi-trash me-2"></i> Excluir
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </td>

                        
                            <div class="modal fade" id="deleteModal{{ $project->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title fw-bold">Confirmação de Exclusão</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            Tem certeza que deseja excluir o projeto "{{ $project->name }}"?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <form action="{{ route('projects.destroy', $project) }}" method="POST">
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
</div>
<link rel="stylesheet" href="{{ asset('css/dataTables.dataTables.min.css') }}">
<script src="{{ asset('js/jquery/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('js/datatables/dataTables.min.js') }}"></script>
<script src="{{ asset('js/tables/projects.js') }}"></script>
@endsection

