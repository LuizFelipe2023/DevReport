<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = [
            ['name' => 'Desenvolvimento'],
            ['name' => 'Teste'],
            ['name' => 'Produção'],
            ['name' => 'Concluído'],
            ['name' => 'Arquivado'],
            ['name' => 'Estável'],
            ['name' => 'Beta'],
        ];

        foreach ($statuses as $status) {
            Status::updateOrCreate(['name' => $status['name']], $status);
        }
    }
}