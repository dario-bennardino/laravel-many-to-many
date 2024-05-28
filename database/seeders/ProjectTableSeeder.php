<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Project;
use App\Models\Technology;
use App\Functions\Helper as Help;


class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 25; $i++) {
            $new_project = new Project();
            //associo randomicamente un ID della categoria a project
            $new_project->technology_id = Technology::inRandomOrder()->first()->id;
            $new_project->title = $faker->sentence();
            $new_project->slug = Help::generateSlug($new_project->title, Project::class);
            $new_project->description = $faker->paragraph(3, true);
            $new_project->image = $faker->sentence();
            $new_project->creation_date = $faker->date();
            // dump($new_project);
            $new_project->save();
        }
    }
}
