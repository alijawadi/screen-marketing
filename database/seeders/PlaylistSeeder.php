<?php

namespace Database\Seeders;

use App\Domain\Media\Models\Playlist;
use App\Domain\Media\Models\PlaylistItem;
use Domain\User\Models\Organization;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class PlaylistSeeder extends Seeder
{
    public function run()
    {
        if (Auth::user()) {
            Playlist::factory()
                ->for(Auth::user()->organization)
                ->create();
        } else {
            Playlist::factory()
                ->for(Organization::factory()->create())
                ->has(PlaylistItem::factory()->state([
                    "order_colum" => fake()->randomNumber()
                ])->count(5))
                ->create();
        }

    }
}
