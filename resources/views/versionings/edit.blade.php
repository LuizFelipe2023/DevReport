@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4 p-md-5">
                        <div class="mb-4">
                            <h3 class="fw-bold text-main mb-1">Editar Versionamento</h3>
                            <p class="text-muted small text-uppercase tracking-wider">Detalhamento técnico da release</p>
                        </div>

                        <form action="{{ route('versionings.update', $versioning->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Projeto Relacionado</label>
                                    <select name="project_id" class="form-select @error('project_id') is-invalid @enderror"
                                        required>
                                        @foreach($projects as $project)
                                            <option value="{{ $project->id }}" {{ old('project_id', $versioning->project_id) == $project->id ? 'selected' : '' }}>
                                                {{ $project->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3 mb-4">
                                    <label class="form-label">Versão</label>
                                    <input type="text" name="version_number"
                                        class="form-control @error('version_number') is-invalid @enderror"
                                        placeholder="ex: 1.0.4"
                                        value="{{ old('version_number', $versioning->version_number) }}" required>
                                </div>

                                <div class="col-md-3 mb-4">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select @error('status') is-invalid @enderror"
                                        required>
                                        <option value="development" {{ old('status', $versioning->status) == 'development' ? 'selected' : '' }}>Desenvolvimento</option>
                                        <option value="pending" {{ old('status', $versioning->status) == 'pending' ? 'selected' : '' }}>Pendente</option>
                                        <option value="completed" {{ old('status', $versioning->status) == 'completed' ? 'selected' : '' }}>Concluído</option>
                                        <option value="production" {{ old('status', $versioning->status) == 'production' ? 'selected' : '' }}>Produção</option>
                                        <option value="archived" {{ old('status', $versioning->status) == 'archived' ? 'selected' : '' }}>Arquivado</option>
                                    </select>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <label class="form-label">Data de Lançamento</label>
                                    <input type="text" name="release_date" id="release_date"
                                        class="form-control @error('release_date') is-invalid @enderror"
                                        placeholder="Selecione uma data"
                                        value="{{ old('release_date', $versioning->release_date ? Carbon\Carbon::parse($versioning->release_date)->format('Y-m-d') : '') }}"
                                        autocomplete="off">
                                </div>

                                <div class="col-md-8 mb-4">
                                    <label class="form-label">Responsáveis</label>
                                    <select name="users[]" id="users-select" class="form-control" multiple>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ $versioning->users->contains($user->id) ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 mb-4">
                                    <label class="form-label">Changelog (Notas da Versão)</label>
                                    <textarea name="changelog" class="form-control @error('changelog') is-invalid @enderror"
                                        rows="4"
                                        placeholder="Descreva as melhorias...">{{ old('changelog', $versioning->changelog) }}</textarea>
                                </div>
                            </div>

                            <div
                                class="d-flex align-items-center justify-content-between mt-4 pt-4 border-top border-secondary border-opacity-25">
                                <a href="{{ route('versionings.index') }}"
                                    class="btn btn-link text-decoration-none text-muted fw-semibold p-0">
                                    <i class="bi bi-arrow-left"></i> Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary px-5 fw-bold shadow-sm">
                                    Atualizar Versão
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/versionamentos/edit.js') }}"></script>
@endsection