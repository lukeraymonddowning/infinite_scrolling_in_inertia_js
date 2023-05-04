<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory()->forEachSequence(
            ['name' => 'Jeffrey Way'],
            ['name' => 'Luke Downing'],
            ['name' => 'Adrian'],
            ['name' => 'Mohamed Said']
        )->create();

        [$jeffrey, $luke, $adrian, $mohamed] = $users;

        Comment::factory()->forEachSequence(
            ['user_id' => $jeffrey, 'body' => 'Hey Luke, welcome to Laracasts!'],
            ['user_id' => $luke, 'body' => 'Thanks Jeffrey, great to be here.'],
            ['user_id' => $adrian, 'body' => "Yo! I'm the designer around these parts 😎"],
            ['user_id' => $jeffrey, 'body' => "@mohamed, how's the series on queues coming along?"],
            ['user_id' => $mohamed, 'body' => "Queues? Where we're going, we don't need queues."],
            ...Collection::times(250, fn () => ['user_id' => $users->random()]),
        )->create();
    }
}
