<?php

namespace Database\Seeders;

use App\Enums\ProjectStatusEnum;
use App\Models\Attribute;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $project = Project::create([
            'name' => 'Project A',
            'status' => ProjectStatusEnum::OPEN
        ]);

        $project->users()->attach(User::first());

        $project->attributeValues()->createMany([
            [
                'attribute_id' => Attribute::where('name', 'department')->first()->id,
                'value' => 'IT'
            ],
            [
                'attribute_id' => Attribute::where('name', 'start_date')->first()->id,
                'value' => '2025-03-01'
            ],
        ]);
    }
}
