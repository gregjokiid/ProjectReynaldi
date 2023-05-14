<?php

namespace Database\Seeders;

use App\Models\Master\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'id'            => 1,
            'name'          => 'Kabel',
            'slug'          => 'kabel',
            'thumbnails'    => 'file/category/kabel.png'
        ]);

        Category::create([
            'id'            => 2,
            'name'          => 'Saklar',
            'slug'          => 'saklar',
            'thumbnails'    => 'file/category/saklar.png'
        ]);

        Category::create([
            'id'            => 3,
            'name'          => 'Lampu',
            'slug'          => 'lampu',
            'thumbnails'    => 'file/category/lampu.png'
        ]);

        Category::create([
            'id'            => 4,
            'name'          => 'Lainnya',
            'slug'          => 'lainnya',
            'thumbnails'    => 'file/category/lainnya.png'
        ]);
    }
}
