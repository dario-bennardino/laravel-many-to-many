<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Type;

class ProjectTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        for ($i = 0; $i < 100; $i++) {

            // estraggo un post random
            $project = Project::inRandomOrder()->first();

            // estraggo un id random dai type
            $type_id = Type::inRandomOrder()->first()->id;

            // aggiungo la relazione nella tabella pivot
            $project->types()->attach($type_id);
        }
    }
}
