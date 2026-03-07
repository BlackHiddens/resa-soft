<?php

namespace Tests\Feature;

use App\Models\Game;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicGameListingTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_lists_only_published_future_games(): void
    {
        $visibleGame = $this->createGame([
            'name' => 'Partie visible',
            'is_published' => true,
            'status' => Game::STATUS_PUBLISHED,
            'scheduled_at' => now()->addDays(2),
        ]);

        $this->createGame([
            'name' => 'Partie brouillon',
            'is_published' => false,
            'status' => Game::STATUS_DRAFT,
            'scheduled_at' => now()->addDays(2),
        ]);

        $this->createGame([
            'name' => 'Partie passee',
            'is_published' => true,
            'status' => Game::STATUS_PUBLISHED,
            'scheduled_at' => now()->subDay(),
        ]);

        $response = $this->get(route('public.games.index'));

        $response->assertOk();
        $response->assertSee($visibleGame->name);
        $response->assertDontSee('Partie brouillon');
        $response->assertDontSee('Partie passee');
    }

    private function createGame(array $overrides = []): Game
    {
        return Game::query()->create(array_merge([
            'name' => 'Partie test',
            'scheduled_at' => now()->addDay(),
            'description' => 'Description test',
            'member_slots' => 10,
            'member_price' => 15,
            'guest_own_gear_slots' => 5,
            'guest_own_gear_price' => 20,
            'guest_rental_slots' => 3,
            'guest_rental_price' => 30,
            'status' => Game::STATUS_PUBLISHED,
            'is_published' => true,
            'reservations_open' => true,
        ], $overrides));
    }
}
