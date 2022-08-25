<?php

namespace Database\Seeders;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@gg.com'
        ]);

        Listing::factory(6)->create([
            'user_id' => $user->id
        ]);

        // Listing::create([
        //     'title' => 'Laravel Senior Developer',
        //     'tags' => 'laravel, javascript',
        //     'company' => 'Snowpaw Studios',
        //     'location' => 'Gold Coast',
        //     'email' => 'snow@gmail.com',
        //     'website' => 'https://laravel.com/docs/9.x',
        //     'description' => 'Laravel strives to provide an amazing developer experience while providing powerful features such as thorough dependency injection, an expressive database abstraction layer, queues and scheduled jobs, unit and integration testing, and more.
        //     '
        // ]);
        // Listing::create([
        //     'title' => 'Full-Stack Developer',
        //     'tags' => 'laravel, javascript, api, backend',
        //     'company' => 'Elder Studios',
        //     'location' => 'Mexico',
        //     'email' => 'elder@gmail.com',
        //     'website' => 'https://laravel.com/docs/9.x',
        //     'description' => 'Laravel may serve as a full stack framework. By "full stack" framework we mean that you are going to use Laravel to route requests to your application and render your frontend via Blade templates or a single-page application hybrid technology like Inertia.js. This is the most common way to use the Laravel framework, and, in our opinion, the most productive way to use Laravel.
        //     '
        // ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
