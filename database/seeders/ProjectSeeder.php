<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'name' => 'Sistema de Gestão',
                'description' => 'Aplicativo para gerenciamento interno da empresa.',
                'status' => 'Em desenvolvimento',
                'github_url' => 'https://github.com/geinf/sistema-gestao'
            ],
            [
                'name' => 'Portal do Cliente',
                'description' => 'Portal web para clientes acessarem informações e relatórios.',
                'status' => 'Produção',
                'github_url' => 'https://github.com/geinf/portal-cliente'
            ],
            [
                'name' => 'Aplicativo Mobile',
                'description' => 'Aplicativo para iOS e Android com notificações push e chat.',
                'status' => 'Em desenvolvimento',
                'github_url' => 'https://github.com/geinf/app-mobile'
            ],
            [
                'name' => 'Sistema de QA',
                'description' => 'Ferramenta interna para testes e controle de qualidade.',
                'status' => 'Em teste',
                'github_url' => 'https://github.com/geinf/sistema-qa'
            ],
            [
                'name' => 'Dashboard Analytics',
                'description' => 'Painel de métricas para análise de performance e dados.',
                'status' => 'Produção',
                'github_url' => 'https://github.com/geinf/dashboard-analytics'
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
    }
}
