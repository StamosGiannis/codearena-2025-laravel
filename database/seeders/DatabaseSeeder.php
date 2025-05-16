<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        User::factory(10)->create()->each(function ($user) {
            $user->posts()->saveMany(Post::factory(rand(1, 5))->make());
        });


        $user = User::factory()->create([
            'name' => 'Demo User',
            'email' => 'demo@example.com',
        ]);


        Post::create([
            'title' => 'Πρώτο μου άρθρο',
            'description' => 'Μια σύντομη περιγραφή...',
            'body' => 'Αυτό είναι το πλήρες κείμενο του άρθρου.',
            'image' => 'https://picsum.photos/800/400',
            'slug' => 'proto-mou-arthro',
            'user_id' => $user->id,
            'published_at' => null,
            'promoted' => true,
        ]);
    }
}
