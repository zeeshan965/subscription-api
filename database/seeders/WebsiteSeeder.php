<?php

namespace Database\Seeders;

use App\Models\Website;
use Faker\Factory;
use Illuminate\Database\Seeder;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        for ($i = 0; $i < 5; $i++) {
            Website::create([
                'name' => $faker->company,
                'url' => $faker->url
            ]);
        }

        /*Website::create([
            'name' => 'Website 1',
            'url' => 'https://google.com/',
        ]);

        Website::create([
            'name' => 'Website 2',
            'url' => 'https://facebook.com/'
        ]);*/
    }
}
