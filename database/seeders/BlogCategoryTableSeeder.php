<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use Illuminate\Database\Seeder;

class BlogCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BlogCategory::create([
        	'title' => 'Tin mới',
	        'slug' => 'tin-moi-1',
	        'description' => 'Tin tức mới nhất về CPM',
	        'icon' => 'fa fa-book',
	        'is_active' => true

        ]);
    }
}
