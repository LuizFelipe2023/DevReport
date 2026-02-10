@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            
                <div class="card-header bg-main py-3 px-4 border-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="text-white mb-0 fw-bold">Detalhes do Versionamento</h5>
                        <span class="badge bg-white text-main rounded-pill px-3">v{{ $versioning->version_number }}</span>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5">
                  
                    <div class="mb-5">
                        <h3 class="fw-bold text-main mb-1">{{ $versioning->project->name }}</h3>
                        <p class="text-muted small text-uppercase tracking-wider">Publicado em {{ \Carbon\Carbon::parse($versioning->created_at)->format('d/m/Y \à\s H:i') }}</p>
                    </div>

                    <div class="row">
                      
                        <div class="col-md-4 mb-4">
                            <label class="form-label fw-bold text-muted small text-uppercase">Status da Release</label>
                            @php $style = $versioning->status->style ?? 'secondary'; @endphp
                            <div class="d-flex align-items-center">
                                <span class="badge bg-{{ $style }} px-3 py-2 fs-6 shadow-sm w-100">
                                    {{ $versioning->status->name ?? 'Indefinido' }}
                                </span>
                            </div>
                        </div>

                        <div class="col-md-4 mb-4">
                            <label class="form-label fw-bold text-muted small text-uppercase">Data de Lançamento</label>
                            <div class="form-control bg-light border-0 py-2 shadow-sm">
                                <i class="bi bi-calendar3 text-main me-2"></i>
                                {{ $versioning->release_date ? \Carbon\Carbon::parse($versioning->release_date)->format('d/m/Y') : "Não definida" }}
                            </div>
                        </div>

                        
                        <div class="col-md-12 mb-4">
                            <label class="form-label fw-bold text-muted small text-uppercase">Responsáveis Técnicos</label>
                            <div class="d-flex flex-wrap gap-2">
                                @forelse($versioning->users as $user)
                                    <span class="badge bg-white text-dark border shadow-sm d-flex align-items-center px-3 py-2 rounded-pill">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=0ea5e9&color=fff" 
                                             class="rounded-circle me-2" width="20">
                                        {{ $user->name }}
                                    </span>
                                @empty
                                    <span class="text-muted italic">Nenhum responsável vinculado</span>
                                @endforelse
                            </div>
                        </div>

                       
                        <div class="col-12 mb-5">
                            <label class="form-label fw-bold text-muted small text-uppercase">Notas da Versão (Changelog)</label>
                            <div class="bg-light border-0 p-4 rounded-4 shadow-inner" style="white-space: pre-wrap; min-height: 100px; border-left: 4px solid #0ea5e9 !important;">{!! e($versioning->changelog) ?: '<i class="text-muted">Nenhuma nota registrada.</i>' !!}</div>
                        </div>

                        <hr class="mb-5 opacity-25">

                       
                        <div class="col-12 mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="fw-bold text-main mb-0">
                                    <i class="bi bi-paperclip me-2"></i>Documentos e Anexos
                                </h5>
                                <span class="badge bg-light text-dark border">{{ $versioning->documents->count() }} arquivo(s)</span>
                            </div>

                            <div class="row g-3">
                                @forelse($versioning->documents as $doc)
                                    <div class="col-md-6 col-lg-4">
                                        <div class="card h-100 border border-light shadow-sm hover-shadow transition-all rounded-3">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0">
                                                        @php
                                                            $icon = match(strtolower($doc->file_ext)) {
                                                                'pdf' => 'bi-file-earmark-pdf-fill text-danger',
                                                                'doc', 'docx' => 'bi-file-earmark-word-fill text-primary',
                                                                'zip', 'rar' => 'bi-file-earmark-zip-fill text-warning',
                                                                'png', 'jpg', 'jpeg' => 'bi-file-earmark-image-fill text-success',
                                                                default => 'bi-file-earmark-text-fill text-secondary'
                                                            };
                                                        @endphp
                                                        <i class="bi {{ $icon }} fs-1"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3 overflow-hidden">
                                                        <div class="text-truncate fw-bold small mb-0" title="{{ $doc->original_name }}">
                                                            {{ $doc->original_name }}
                                                        </div>
                                                        <small class="text-muted text-uppercase" style="font-size: 0.65rem;">
                                                            Arquivo {{ $doc->file_ext }}
                                                        </small>
                                                    </div>
                                                </div>
                                                
                                                <div class="btn-group w-100 shadow-sm rounded-2 overflow-hidden">
                                                   
                                                    <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" 
                                                       class="btn btn-white btn-sm border-end text-main fw-semibold">
                                                        <i class="bi bi-eye me-1"></i> Ver
                                                    </a>
                                                   
                                                    <a href="{{ route('documents.download', $doc->id) }}" 
                                                       class="btn btn-white btn-sm text-main fw-semibold">
                                                        <i class="bi bi-download me-1"></i> Baixar
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12">
                                        <div class="text-center py-5 bg-light rounded-4 border border-dashed">
                                            <i class="bi bi-folder2-open fs-1 text-muted opacity-50"></i>
                                            <p class="text-muted mt-2 mb-0">Nenhum anexo disponível para esta versão.</p>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center justify-content-between mt-5 pt-4 border-top">
                        <a href="{{ route('versionings.index') }}" class="btn btn-link text-decoration-none text-muted fw-semibold p-0">
                            <i class="bi bi-arrow-left me-1"></i> Voltar para a lista
                        </a>
                        <div class="d-flex gap-2">
                            <a href="{{ route('versionings.edit', $versioning->id) }}" class="btn btn-primary px-4 fw-bold shadow-sm">
                                <i class="bi bi-pencil-square me-2"></i>Editar Versão
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-shadow:hover {
        transform: translateY(-3px);
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.08)!important;
    }
    .transition-all {
        transition: all 0.25s ease-in-out;
    }
    .shadow-inner {
        box-shadow: inset 0 2px 4px 0 rgba(0, 0, 0, 0.05);
    }
</style>
@endsection