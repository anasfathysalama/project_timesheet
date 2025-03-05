<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Timesheet;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimesheetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Timesheet::create([
            'user_id' => User::first()->id,
            'project_id' => Project::first()->id,
            'task_name' => 'Task A',
            'date' => '2025-03-01',
            'hours' => 2,
        ]);
    }
}
