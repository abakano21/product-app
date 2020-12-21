<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Product::factory(1)->create();

        \App\Models\Language::factory(1)->create(['title' => 'en']);
        \App\Models\Language::factory(1)->create(['title' => 'ar']);

        \App\Models\Region::factory(1)->create();
        \App\Models\Region::factory(1)->create(['title' => 'sa']);

        \App\Models\LanguageProduct::factory()->create([
            'title' => 'Google Pixel',
            'language_id' => 1,
            'product_id' => 1,
        ]);

        \App\Models\LanguageProduct::factory()->create([
            'title' => 'جوجل بيكسل',
            'language_id' => 2,
            'product_id' => 1,
        ]);

        \App\Models\ProductRegion::factory()->create([
            'product_id' => 1,
            'region_id' => 1,
            'quantity' => 11,
            'price' => 100,
            'currency' => 'AED'
        ]);

        \App\Models\ProductRegion::factory()->create([
            'product_id' => 1,
            'region_id' => 2,
            'quantity' => 15,
            'price' => 120,
            'currency' => 'SAD'
        ]);
        
    }
}
