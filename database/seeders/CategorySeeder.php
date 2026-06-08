<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Fiksi', 'slug' => 'fiksi', 'description' => 'Buku yang berisi cerita hasil imajinasi penulis.'],
            ['name' => 'Non Fiksi', 'slug' => 'non-fiksi', 'description' => 'Buku berbasis fakta dan pengetahuan.'],
            ['name' => 'Teknologi', 'slug' => 'teknologi', 'description' => 'Buku seputar teknologi dan pemrograman.'],
            ['name' => 'Sains', 'slug' => 'sains', 'description' => 'Ilmu pengetahuan alam dan eksak.'],
            ['name' => 'Sejarah', 'slug' => 'sejarah', 'description' => 'Buku sejarah dan biografi.'],
            ['name' => 'Agama', 'slug' => 'agama', 'description' => 'Buku keagamaan dan spiritual.'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
