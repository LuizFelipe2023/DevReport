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

     
        .report-title { text-align: center; margin-bottom: 20px; }
        .report-title h1 { margin: 0; color: #1a2a3a; font-size: 20px; }
        
       
        .project-header { 
            background-color: #f8f9fa; 
            padding: 8px 12px; 
            border-left: 4px solid #007bff;
            margin-top: 20px;
            margin-bottom: 10px;
         
        }
        .project-name { font-size: 14px; font-weight: bold; color: #1a2a3a; }

        /* Tabela */
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-bottom: 20px;
            table-layout: fixed; /
        }
        
        th { 
            text-align: left; 
            padding: 10px; 
            background-color: #ffffff;
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

        .badge {
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 9px;
            font-weight: bold;
            color: #fff;
        }
        .bg-stable { background-color: #28a745; }
        .bg-beta { background-color: #fd7e14; }
        .bg-dark { background-color: #6c757d; }

        .pagenum:before { content: counter(page); }
    </style>
</head>
<body>

<header>
    <span style="float: left;">Relatório de Versões - {{ date('Y') }}</span>
    <span style="float: right;">Sistema Interno</span>
</header>

<footer>
    Página <span class="pagenum"></span> | Gerado em {{ date('d/m/Y H:i') }}
</footer>

<main>
    <div class="report-title">
        <h1>Logs de Versão por Projeto</h1>
        <p style="color: #666;">Histórico consolidado de desenvolvimento</p>
    </div>

    @foreach($versioningsGrouped as $projectId => $versions)
        <div class="project-container">
            <div class="project-header">
                <span class="project-name">{{ $versions->first()->project->name }}</span>
                <small style="float: right; color: #777;">{{ $versions->count() }} versões</small>
            </div>

            <table>
                <thead>
                    <tr>
                        <th width="12%">Versão</th>
                        <th width="15%">Data</th>
                        <th width="13%">Status</th>
                        <th width="40%">Changelog</th>
                        <th width="20%">Equipe</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($versions as $version)
                        <tr>
                            <td><strong>v{{ $version->version_number }}</strong></td>
                            <td>{{ \Carbon\Carbon::parse($version->release_date)->format('d/m/Y') }}</td>
                            <td>
                                <span class="badge {{ $version->status == 'stable' ? 'bg-stable' : ($version->status == 'beta' ? 'bg-beta' : 'bg-dark') }}">
                                    {{ strtoupper($version->status) }}
                                </span>
                            </td>
                            <td>{{ $version->changelog }}</td>
                            <td style="color: #555; font-size: 10px;">
                                {{ $version->users->pluck('name')->implode(', ') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endforeach
</main>

</body>
</html>