<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Status; // Import essencial para o mapeamento

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = Status::all();

        if ($statuses->isEmpty()) {
            $this->command->error('Abortando: Nenhum Status encontrado. Rode o StatusSeeder primeiro!');
            return;
        }

        $projects = [
            [
                'name' => 'Sistema de Gestão',
                'description' => 'Aplicativo para gerenciamento interno da empresa.',
                'github_url' => 'https://github.com/geinf/sistema-gestao'
            ],
            [
                'name' => 'Portal do Cliente',
                'description' => 'Portal web para clientes acessarem informações e relatórios.',
                'github_url' => 'https://github.com/geinf/portal-cliente'
            ],
            [
                'name' => 'Aplicativo Mobile',
                'description' => 'Aplicativo para iOS e Android com notificações push e chat.',
                'github_url' => 'https://github.com/geinf/app-mobile'
            ],
            [
                'name' => 'Sistema de QA',
                'description' => 'Ferramenta interna para testes e controle de qualidade.',
                'github_url' => 'https://github.com/geinf/sistema-qa'
            ],
            [
                'name' => 'Dashboard Analytics',
                'description' => 'Painel de métricas para análise de performance e dados.',
                'github_url' => 'https://github.com/geinf/dashboard-analytics'
            ],
        ];

        foreach ($projects as $projectData) {
            $projectData['status_id'] = $statuses->random()->id;
            
            Project::create($projectData);
        }

        $this->command->info('ProjectSeeder: Projetos provisionados com sucesso!');
    }
}