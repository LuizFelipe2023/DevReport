@extends('layouts.app')

@section('content')

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0 text-dark">Projetos</h5>
                        <a href="{{ route('projects.create') }}" class="btn btn-primary btn-sm rounded-2 px-3">
                            <i class="bi bi-plus"></i> Novo Projeto
                        </a>
                    </div>

                    <div class="card-body p-0"> @if(session('success') || session('error'))
                            <div class="p-3 pb-0">
                                @if(session('success'))
                                    <div class="alert alert-success border-0 small mb-0" role="alert">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if(session('error'))
                                    <div class="alert alert-danger border-0 small mb-0" role="alert">
                                        {{ session('error') }}
                                    </div>
                                @endif
                            </div>
                        @endif

                        @if($projects->count())
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="border-0 ps-4 text-muted small uppercase" style="width: 80px;">ID</th>
                                            <th class="border-0 text-muted small uppercase">NOME DO PROJETO</th>
                                            <th class="border-0 text-muted small uppercase">DESCRIÇÃO</th>
                                            <th class="border-0 text-muted small uppercase">CRIADO EM</th>
                                            <th class="border-0 text-end pe-4 text-muted small uppercase">AÇÕES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($projects as $project)
                                            <tr>
                                                <td class="ps-4 fw-bold text-muted">#{{ $project->id }}</td>
                                                <td>
                                                    <span class="fw-semibold text-dark">{{ $project->name }}</span>
                                                </td>
                                                <td>
                                                    <span class="text-muted small text-truncate d-inline-block" style="max-width: 250px;">
                                                        {{ $project->description }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-light text-dark fw-normal border">
                                                        {{ $project->created_at->format('d/m/Y') }}
                                                    </span>
                                                </td>
                                                <td class="text-end pe-4">
                                                    <div class="btn-group shadow-sm border rounded">
                                                        <a href="{{ route('projects.show', $project->id) }}" class="btn btn-white btn-sm" title="Ver">
                                                            <i class="bi bi-eye text-primary"></i>
                                                        </a>
                                                        <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-white btn-sm" title="Editar">
                                                            <i class="bi bi-pencil text-secondary"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $project->id }}" title="Excluir">
                                                            <i class="bi bi-trash text-danger"></i>
                                                        </button>
                                                    </div>

                                                    <div class="modal fade" id="deleteModal{{ $project->id }}" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-sm">
                                                            <div class="modal-content border-0 shadow">
                                                                <div class="modal-header border-0 pb-0">
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body text-center p-4">
                                                                    <h6 class="fw-bold">Excluir projeto?</h6>
                                                                    <p class="text-muted small mb-0">Esta ação não pode ser desfeita.</p>
                                                                </div>
                                                                <div class="modal-footer border-0 pt-0 justify-content-center pb-4">
                                                                    <button type="button" class="btn btn-light btn-sm px-3" data-bs-dismiss="modal">Não</button>
                                                                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST">
                                                                        @csrf @method('DELETE')
                                                                        <button type="submit" class="btn btn-danger btn-sm px-3">Sim, Excluir</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="py-5 text-center">
                                <p class="text-muted">Nenhum projeto encontrado.</p>
                                <a href="{{ route('projects.create') }}" class="btn btn-outline-primary btn-sm">Criar meu primeiro projeto</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection