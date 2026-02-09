@extends('layouts.app')

@section('content')
<div class="container py-5 mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark">Gerenciamento de Usuários</h2>
            <p class="text-muted">Lista de usuários cadastrados no sistema e seus níveis de acesso.</p>
        </div>
        <a href="{{ route('users.create') }}" class="btn btn-primary shadow-sm">
            <i class="bi bi-person-plus-fill me-1"></i> Novo Usuário
        </a>
    </div>

    <!-- Filtro de Roles -->
    <div class="mb-3">
        <label for="roleFilter" class="form-label fw-bold">Filtrar por Nível de Acesso</label>
        <select id="roleFilter" class="form-select" style="max-width: 300px;">
            <option value="">Todos</option>
            @foreach($roles as $role)
                <option value="{{ $role->name }}">{{ $role->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-3">
            <div class="table-responsive">
                <table id="usersTable" class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Nome</th>
                            <th>E-mail</th>
                            <th>Nível de Acesso</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm me-3 bg-soft-primary text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: #eef2ff;">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <span class="fw-bold">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge rounded-pill bg-info text-dark">
                                    {{ $user->role->name ?? 'Sem Nível' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Ações
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('users.show', $user) }}">
                                                <i class="bi bi-eye me-2"></i> Visualizar
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('users.edit', $user) }}">
                                                <i class="bi bi-pencil me-2"></i> Editar
                                            </a>
                                        </li>
                                        <li>
                                            <button type="button" class="dropdown-item text-danger"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->id }}"
                                                {{ auth()->id() === $user->id ? 'disabled' : '' }}>
                                                <i class="bi bi-trash me-2"></i> Excluir
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </td>

                            <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title fw-bold">Confirmação de Exclusão</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            Tem certeza que deseja excluir o usuário "{{ $user->name }}"?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <form action="{{ route('users.destroy', $user) }}" method="POST">
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
<script src="{{ asset('js/jquery/jquery-3.6.0.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/dataTables.dataTables.min.css') }}">
<script src="{{ asset('js/datatables/dataTables.min.js') }}"></script>
<script src="{{ asset('js/tables/users.js') }}"></script>
@endsection


