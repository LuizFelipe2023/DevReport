<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Versioning;
use App\Models\Project;
use App\Models\User;
use App\Models\Status; // Import essencial
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
        $statuses = Status::all();

        
        if ($projects->isEmpty() || $users->isEmpty() || $statuses->isEmpty()) {
            $this->command->error('Faltam dependências (Projetos, Usuários ou Status) para o seeding.');
            return;
        }

        foreach ($projects as $project) {
           
            $versionCount = rand(2, 5);

            for ($i = 1; $i <= $versionCount; $i++) {
                $randomStatus = $statuses->random();

                $versioning = Versioning::create([
                    'project_id'     => $project->id,
                    'status_id'      => $randomStatus->id, 
                    'version_number' => "1.{$i}.0", 
                    'changelog'      => "Deployment da versão {$i}.0: Patch de segurança e melhorias no core do " . $project->name,
                    'release_date'   => Carbon::now()->subDays(rand(1, 180)),
                ]);

                $assignedUsers = $users->random(rand(1, min(3, $users->count())))->pluck('id');
                $versioning->users()->attach($assignedUsers);
            }
        }

        $this->command->info('Pipeline de Seeding finalizado: Versionings vinculados a Objetos Status.');
    }
}