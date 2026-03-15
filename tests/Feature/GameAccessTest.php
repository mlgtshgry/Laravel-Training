<?php

use App\Models\Game;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;

uses(RefreshDatabase::class);

test('a non-creator can access and play a game', function () {
    Http::fake([
        'random-words-api.kushcreates.com/*' => Http::response([['word' => 'TESTWORD']], 200),
    ]);

    $creator = User::factory()->create(['email_verified_at' => now()]);
    $player = User::factory()->create(['email_verified_at' => now()]);
    
    $game = Game::factory()->create(['user_id' => $creator->id]);

    $response = $this->actingAs($player)
        ->get(route('games.show', $game));

    $response->assertStatus(200);
    $this->assertDatabaseHas('players', [
        'game_id' => $game->id,
        'user_id' => $player->id,
    ]);
});
