<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <style>
        @page { margin: 70px 40px 50px 40px; }
        
        body { 
            font-family: 'Helvetica', Arial, sans-serif; 
            color: #333; 
            font-size: 11px;
            line-height: 1.4;
            margin: 0;
        }

        header { 
            position: fixed; 
            top: -50px; 
            left: 0; 
            right: 0; 
            height: 40px; 
            border-bottom: 1px solid #eee;
            color: #777;
        }

        footer { 
            position: fixed; 
            bottom: -30px; 
            left: 0; 
            right: 0; 
            height: 20px; 
            text-align: center;
            border-top: 1px solid #eee;
            font-size: 9px;
            padding-top: 5px;
        }

        .report-title { text-align: center; margin-bottom: 25px; }
        .report-title h1 { margin: 0; color: #1a2a3a; font-size: 18px; text-transform: uppercase; }
        .report-title p { margin: 5px 0 0; color: #666; font-size: 12px; }
        
        .project-info-box { 
            background-color: #f8f9fa; 
            padding: 12px; 
            border-left: 4px solid #0d6efd;
            margin-bottom: 20px;
        }
        .project-label { font-size: 9px; color: #777; text-transform: uppercase; display: block; }
        .project-value { font-size: 15px; font-weight: bold; color: #1a2a3a; }

        table { 
            width: 100%; 
            border-collapse: collapse; 
            table-layout: fixed;
        }
        
        th { 
            text-align: left; 
            padding: 10px; 
            background-color: #f1f1f1;
            border-bottom: 2px solid #333;
            font-size: 10px;
            text-transform: uppercase;
        }

        td { 
            padding: 10px; 
            border-bottom: 1px solid #eee; 
            vertical-align: top;
            word-wrap: break-word; 
        }

        /* Status Badges */
        .badge {
            padding: 3px 7px;
            border-radius: 3px;
            font-size: 8px;
            font-weight: bold;
            color: #fff;
            display: inline-block;
            text-transform: uppercase;
        }

        .bg-primary   { background-color: #0d6efd; }
        .bg-success   { background-color: #198754; }
        .bg-warning   { background-color: #ffc107; color: #000; }
        .bg-danger    { background-color: #dc3545; }
        .bg-info      { background-color: #0dcaf0; color: #000; }
        .bg-secondary { background-color: #6c757d; }

        .pagenum:before { content: counter(page); }
    </style>
</head>
<body>

<header>
    <span style="float: left;">Relatório Individual de Projeto - {{ date('Y') }}</span>
    <span style="float: right;">Sistema Geinf</span>
</header>

<footer>
    Página <span class="pagenum"></span> | Gerado em {{ date('d/m/Y H:i') }}
</footer>

<main>
    <div class="report-title">
        <h1>Histórico de Versões</h1>
        <p>Documentação técnica de evolução do software</p>
    </div>

    <div class="project-info-box">
        <span class="project-label">Projeto</span>
        <span class="project-value">{{ $project->name }}</span>
        <div style="margin-top: 5px; font-size: 10px; color: #555;">
            Total de versões lançadas: <strong>{{ $project->versionings->count() }}</strong>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th width="12%">Versão</th>
                <th width="15%">Data</th>
                <th width="15%">Status</th>
                <th width="38%">Changelog / Descrição</th>
                <th width="20%">Responsáveis</th>
            </tr>
        </thead>
        <tbody>
            @forelse($project->versionings->sortByDesc('created_at') as $version)
                <tr>
                    <td><strong>v{{ $version->version_number }}</strong></td>
                    <td>{{ \Carbon\Carbon::parse($version->release_date)->format('d/m/Y') }}</td>
                    <td>
                        <span class="badge bg-{{ $version->status->style ?? 'secondary' }}">
                            {{ $version->status->name ?? 'N/A' }}
                        </span>
                    </td>
                    <td>{{ $version->changelog }}</td>
                    <td style="color: #555; font-size: 9px;">
                        @if($version->users->isNotEmpty())
                            {{ $version->users->pluck('name')->implode(', ') }}
                        @else
                            <span style="color: #999;">Não informado</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 20px; color: #999;">
                        Nenhum registro de versão encontrado para este projeto.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</main>

</body>
</html>