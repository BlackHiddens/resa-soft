<?php

namespace Tests\Feature;

use App\Models\Game;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminReservationManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_login_and_access_dashboard(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@test.local',
            'password' => Hash::make('secret123'),
            'is_admin' => true,
        ]);

        $response = $this->post(route('admin.login.submit'), [
            'email' => $admin->email,
            'password' => 'secret123',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($admin);
    }

    public function test_non_admin_user_cannot_access_admin_dashboard(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $response = $this->actingAs($user)->get(route('admin.dashboard'));

        $response->assertForbidden();
    }

    public function test_admin_can_cancel_reservation_and_slot_becomes_available(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $game = $this->createGame([
            'member_slots' => 1,
            'guest_own_gear_slots' => 0,
            'guest_rental_slots' => 0,
            'status' => Game::STATUS_FULL,
            'reservations_open' => false,
        ]);

        $reservation = Reservation::query()->create([
            'game_id' => $game->id,
            'full_name' => 'Joueur Annule',
            'phone' => '0696444444',
            'reservation_type' => Game::SLOT_MEMBER,
            'unit_price' => 18,
            'quantity' => 1,
            'total_price' => 18,
            'status' => Reservation::STATUS_CONFIRMED,
            'confirmed_at' => now(),
        ]);

        $response = $this->actingAs($admin)->patch(route('admin.reservations.update-status', $reservation), [
            'status' => Reservation::STATUS_CANCELLED,
            'notes' => 'Annulation test',
        ]);

        $response->assertRedirect();
        $reservation->refresh();
        $game->refresh();

        $this->assertSame(Reservation::STATUS_CANCELLED, $reservation->status);
        $this->assertNotNull($reservation->cancelled_at);
        $this->assertSame(1, $game->remainingForType(Game::SLOT_MEMBER));
    }

    private function createGame(array $overrides = []): Game
    {
        return Game::query()->create(array_merge([
            'name' => 'Partie admin test',
            'scheduled_at' => now()->addDay(),
            'description' => 'Description test',
            'member_slots' => 1,
            'member_price' => 18,
            'guest_own_gear_slots' => 0,
            'guest_own_gear_price' => 24,
            'guest_rental_slots' => 0,
            'guest_rental_price' => 35,
            'status' => Game::STATUS_PUBLISHED,
            'is_published' => true,
            'reservations_open' => true,
        ], $overrides));
    }
}
