<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Template;

class TemplateSeeder extends Seeder
{
    public function run(): void
    {
        Template::insert([
            ['name' => 'programacao', 'description' => 'Template de programação com NPCs e inputs.'],
            ['name' => 'hardware', 'description' => 'Template de minijogos de hardware.'],
        ]);
    }
}
