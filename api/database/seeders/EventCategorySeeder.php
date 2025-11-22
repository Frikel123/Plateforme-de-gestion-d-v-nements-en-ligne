<?php

namespace Database\Seeders;

use App\Models\EventCategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EventCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Conférence', 'description' => 'Événements liés à des conférences et présentations.'],
            ['name' => 'Atelier', 'description' => 'Événements interactifs où les participants apprennent en faisant.'],
            ['name' => 'Séminaire', 'description' => 'Petites réunions formelles pour discuter d’un sujet spécifique.'],
            ['name' => 'Webinaire', 'description' => 'Événements en ligne diffusés sur le web.'],
            ['name' => 'Concert', 'description' => 'Événements musicaux avec des performances live.'],
            ['name' => 'Festival', 'description' => 'Grand événement avec des activités et des performances variées.'],
        ];

        foreach ($categories as $category) {
            EventCategory::create($category);
        }
    }
}
