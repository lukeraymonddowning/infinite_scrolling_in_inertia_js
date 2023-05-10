<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        Video::factory()->forEachSequence(
            ['user_id' => $users->random(), 'title' => 'Building Goat Simulator in PHP'],
            ['user_id' => $users->random(), 'title' => 'From Zero to Hero with Packages'],
            ['user_id' => $users->random(), 'title' => 'How Many Times Per Day Should You Change Your IDE Theme?'],
            ['user_id' => $users->random(), 'title' => 'Why SOAP is the Greatest Protocol Ever Built'],
            ...Collection::times(300, fn () => ['user_id' => $users->random()]),
        )->create();
    }
}
