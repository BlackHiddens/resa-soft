<?php

namespace Tests\Feature;

use App\Models\Game;
use App\Models\Reservation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicReservationFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_reserve_an_available_slot(): void
    {
        $game = $this->createGame([
            'member_slots' => 2,
            'member_price' => 18,
        ]);

        $response = $this->post(route('public.reservations.store', ['game' => $game->slug]), [
            'full_name' => 'Alex Test',
            'reservation_type' => Game::SLOT_MEMBER,
            'quantity' => 1,
            'notes' => 'RAS',
        ]);

        $reservation = Reservation::query()->first();

        $response->assertRedirect(route('public.reservations.confirmation', ['reservation' => $reservation->reservation_code]));
        $this->assertNotNull($reservation);
        $this->assertSame(Reservation::STATUS_CONFIRMED, $reservation->status);
        $this->assertSame('18.00', $reservation->unit_price);
        $this->assertSame('18.00', $reservation->total_price);
        $this->assertSame(Game::SLOT_MEMBER, $reservation->reservation_type);
        $this->assertSame('-', $reservation->phone);
        $this->assertNull($reservation->email);
    }

    public function test_it_rejects_reservation_when_slot_is_full(): void
    {
        $game = $this->createGame([
            'member_slots' => 1,
            'guest_own_gear_slots' => 0,
            'guest_rental_slots' => 0,
        ]);

        Reservation::query()->create([
            'game_id' => $game->id,
            'full_name' => 'Premier Joueur',
            'phone' => '-',
            'email' => null,
            'reservation_type' => Game::SLOT_MEMBER,
            'unit_price' => 18,
            'quantity' => 1,
            'total_price' => 18,
            'status' => Reservation::STATUS_CONFIRMED,
            'confirmed_at' => now(),
        ]);

        $response = $this->from(route('public.games.show', ['game' => $game->slug]))
            ->post(route('public.reservations.store', ['game' => $game->slug]), [
                'full_name' => 'Deuxieme Joueur',
                'reservation_type' => Game::SLOT_MEMBER,
                'quantity' => 1,
            ]);

        $response->assertRedirect(route('public.games.show', ['game' => $game->slug]));
        $response->assertSessionHasErrors('reservation_type');
        $this->assertDatabaseCount('reservations', 1);
    }

    public function test_game_is_marked_full_after_last_slot_is_reserved(): void
    {
        $game = $this->createGame([
            'member_slots' => 1,
            'guest_own_gear_slots' => 0,
            'guest_rental_slots' => 0,
        ]);

        $this->post(route('public.reservations.store', ['game' => $game->slug]), [
            'full_name' => 'Dernier Joueur',
            'reservation_type' => Game::SLOT_MEMBER,
            'quantity' => 1,
        ]);

        $game->refresh();

        $this->assertSame(Game::STATUS_FULL, $game->status);
        $this->assertFalse($game->reservations_open);
    }

    private function createGame(array $overrides = []): Game
    {
        return Game::query()->create(array_merge([
            'name' => 'Partie test',
            'scheduled_at' => now()->addDay(),
            'description' => 'Description test',
            'member_slots' => 10,
            'member_price' => 18,
            'guest_own_gear_slots' => 5,
            'guest_own_gear_price' => 24,
            'guest_rental_slots' => 3,
            'guest_rental_price' => 35,
            'status' => Game::STATUS_PUBLISHED,
            'is_published' => true,
            'reservations_open' => true,
        ], $overrides));
    }
}
