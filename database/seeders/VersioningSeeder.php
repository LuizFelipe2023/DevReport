<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Versioning;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Str;
use Carbon\Carbon;

class VersioningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $projects = Project::all();
        $users = User::all();

        if ($projects->isEmpty() || $users->isEmpty()) {
            $this->command->info('Não há projetos ou usuários para criar versionings.');
            return;
        }

        $statuses = ['Em desenvolvimento', 'Em teste', 'Produção'];

        foreach ($projects as $project) {
          
            $versionCount = rand(2, 5);

            for ($i = 1; $i <= $versionCount; $i++) {
                $versioning = Versioning::create([
                    'project_id' => $project->id,
                    'version_number' => $i,
                    'changelog' => 'Atualizações e melhorias da versão ' . $i . ' do projeto ' . $project->name,
                    'status' => $statuses[array_rand($statuses)],
                    'release_date' => Carbon::now()->subDays(rand(0, 100)),
                ]);

         
                $assignedUsers = $users->random(rand(1, min(3, $users->count())))->pluck('id');
                $versioning->users()->attach($assignedUsers);
            }
        }

        $this->command->info('Versionings criados com sucesso!');
    }
}
