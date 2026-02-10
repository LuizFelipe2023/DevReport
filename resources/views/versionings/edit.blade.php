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

                 
                    @if ($errors->any())
                        <div class="alert alert-danger border-0 shadow-sm mb-4">
                            <div class="fw-bold mb-2"><i class="bi bi-x-circle-fill me-2"></i> Ops! Verifique os erros abaixo:</div>
                            <ul class="mb-0 small">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('versionings.update', $versioning->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-semibold">Projeto Relacionado</label>
                                <select name="project_id" class="form-select @error('project_id') is-invalid @enderror" required>
                                    @foreach($projects as $project)
                                        <option value="{{ $project->id }}" {{ old('project_id', $versioning->project_id) == $project->id ? 'selected' : '' }}>
                                            {{ $project->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                         
                            <div class="col-md-3 mb-4">
                                <label class="form-label fw-semibold">Versão</label>
                                <input type="text" name="version_number" class="form-control @error('version_number') is-invalid @enderror" 
                                       value="{{ old('version_number', $versioning->version_number) }}" required>
                            </div>

                          
                            <div class="col-md-3 mb-4">
                                <label class="form-label fw-semibold">Status</label>
                                <select name="status_id" class="form-select @error('status_id') is-invalid @enderror" required>
                                    @foreach($statuses as $status)
                                        <option value="{{ $status->id }}" {{ old('status_id', $versioning->status_id) == $status->id ? 'selected' : '' }}>
                                            {{ $status->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                           
                            <div class="col-md-4 mb-4">
                                <label class="form-label fw-semibold">Data de Lançamento</label>
                                <input type="text" name="release_date" id="release_date" class="form-control" 
                                       value="{{ old('release_date', $versioning->release_date) }}">
                            </div>

                          
                            <div class="col-md-8 mb-4">
                                <label class="form-label fw-semibold">Responsáveis</label>
                                <select name="users[]" id="users-select" class="form-control" multiple>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ $versioning->users->contains($user->id) ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                          
                            <div class="col-12 mb-4">
                                <label class="form-label fw-semibold">Changelog (Notas da Versão)</label>
                                <textarea name="changelog" class="form-control" rows="4">{{ old('changelog', $versioning->changelog) }}</textarea>
                            </div>

                            <hr class="my-4 opacity-25">

                           
                            <div class="col-12 mb-4">
                                <label class="form-label fw-bold text-dark"><i class="bi bi-files me-2"></i>Documentos Atuais</label>
                                
                                @if($versioning->documents->count() > 0)
                                    <div class="row g-3">
                                        @foreach($versioning->documents as $doc)
                                            <div class="col-md-6">
                                                <div class="d-flex align-items-center p-3 border rounded-3 bg-light position-relative">
                                                    <div class="flex-shrink-0">
                                                        @php
                                                            $icon = match(strtolower($doc->file_ext)) {
                                                                'pdf' => 'bi-file-earmark-pdf text-danger',
                                                                'doc', 'docx' => 'bi-file-earmark-word text-primary',
                                                                'zip', 'rar' => 'bi-file-earmark-zip text-warning',
                                                                'png', 'jpg', 'jpeg' => 'bi-file-earmark-image text-success',
                                                                default => 'bi-file-earmark-text text-secondary'
                                                            };
                                                        @endphp
                                                        <i class="bi {{ $icon }} fs-3"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3 overflow-hidden">
                                                        <div class="text-truncate small fw-bold" title="{{ $doc->original_name }}">
                                                            {{ $doc->original_name }}
                                                        </div>
                                                        <div class="form-check form-switch mt-1">
                                                            <input class="form-check-input" type="checkbox" name="remove_documents[]" value="{{ $doc->id }}" id="del-{{ $doc->id }}">
                                                            <label class="form-check-label small text-danger fw-semibold" for="del-{{ $doc->id }}">
                                                                Remover arquivo
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-muted small italic p-3 border border-dashed rounded-3 text-center">
                                        Nenhum documento anexado a esta versão.
                                    </div>
                                @endif
                            </div>

                           
                            <div class="col-12 mb-4">
                                <label class="form-label fw-bold text-primary"><i class="bi bi-plus-circle me-2"></i>Adicionar Novos Documentos</label>
                                <input type="file" name="documents[]" id="documents" multiple>
                                <div class="form-text">Os arquivos selecionados serão adicionados à lista atual após salvar.</div>
                            </div>
                        </div>

                       
                        <div class="d-flex align-items-center justify-content-between mt-4 pt-4 border-top border-secondary border-opacity-25">
                            <a href="{{ route('versionings.index') }}" class="btn btn-link text-decoration-none text-muted fw-semibold p-0">
                                <i class="bi bi-arrow-left"></i> Voltar
                            </a>
                            <button type="submit" class="btn btn-primary px-5 fw-bold shadow-sm">
                                <i class="bi bi-check2-circle me-2"></i>Salvar Alterações
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/versionamentos/edit.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputElement = document.querySelector('#documents');
        if (inputElement && window.FilePond) {
            window.FilePond.create(inputElement, {
                allowMultiple: true,
                storeAsFile: true,
                name: 'documents[]',
                labelIdle: 'Arraste novos arquivos ou <span class="filepond--label-action">Procure no computador</span>',
                credits: false,
                labelFileProcessing: 'Carregando...',
                labelFileProcessingComplete: 'Pronto',
            });
        }
    });
</script>
@endsection