@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4 p-md-5">
                        <div class="mb-4">
                            <h3 class="fw-bold text-main mb-1">Novo Versionamento</h3>
                            <p class="text-muted small text-uppercase tracking-wider">Detalhamento técnico da release</p>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger border-0 shadow-sm mb-4">
                                <div class="fw-bold mb-2"><i class="bi bi-x-circle-fill me-2"></i> Verifique os erros:</div>
                                <ul class="mb-0 small">
                                    @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('versionings.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Projeto Relacionado</label>
                                    <select name="project_id" class="form-select @error('project_id') is-invalid @enderror"
                                        required>
                                        <option value="" selected disabled>Selecione...</option>
                                        @foreach($projects as $project)
                                            <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>{{ $project->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3 mb-4">
                                    <label class="form-label">Versão</label>
                                    <input type="text" name="version_number"
                                        class="form-control @error('version_number') is-invalid @enderror"
                                        placeholder="ex: 1.0.4" value="{{ old('version_number') }}" required>
                                </div>

                                <div class="col-md-3 mb-4">
                                    <label class="form-label">Status da Release</label>
                                    <select name="status_id" class="form-select @error('status_id') is-invalid @enderror"
                                        required>
                                        <option value="" selected disabled>Selecione...</option>
                                        @foreach($statuses as $status)
                                            <option value="{{ $status->id }}" {{ old('status_id') == $status->id ? 'selected' : '' }}>{{ $status->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <label class="form-label">Data de Lançamento</label>
                                    <input type="text" name="release_date" id="release_date"
                                        class="form-control @error('release_date') is-invalid @enderror"
                                        value="{{ old('release_date') }}">
                                </div>

                                <div class="col-md-8 mb-4">
                                    <label class="form-label">Responsáveis</label>
                                    <select name="users[]" id="users-select" class="form-control" multiple>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 mb-4">
                                    <label class="form-label">Changelog</label>
                                    <textarea name="changelog" class="form-control @error('changelog') is-invalid @enderror"
                                        rows="4">{{ old('changelog') }}</textarea>
                                </div>

                                <div class="col-12 mb-4">
                                    <label class="form-label fw-bold">Documentos e Anexos</label>
                                    <input type="file" name="documents[]" id="documents" multiple>
                                    <div id="file-help" class="form-text">Selecione PDFs, imagens ou arquivos compactados.
                                    </div>
                                </div>
                            </div>

                            <div
                                class="d-flex align-items-center justify-content-between mt-4 pt-4 border-top border-light">
                                <a href="{{ route('versionings.index') }}"
                                    class="btn btn-link text-muted fw-semibold">Cancelar</a>
                                <button type="submit" class="btn btn-primary px-5 shadow-sm">Publicar Versão</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const inputElement = document.querySelector('input[name="documents[]"]');

            if (inputElement) {
                const pond = FilePond.create(inputElement, {

                    allowMultiple: true,
                    storeAsFile: true,
                    name: 'documents[]',


                    labelIdle: 'Arraste e solte seus arquivos ou <span class="filepond--label-action">Procure</span>',
                    credits: false,

                    maxFiles: 10,

                    imagePreviewHeight: 170,
                    imageCropAspectRatio: '1:1',
                    imageResizeTargetWidth: 200,
                    imageResizeTargetHeight: 200,
                });

                console.log('FilePond pronto para múltiplos arquivos!');
            }
        });
    </script>
    <script src="{{ asset('js/versionamentos/create.js') }}"></script>
@endsection