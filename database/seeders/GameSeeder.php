<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Reservation;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    public function run(): void
    {
        $game = Game::query()->updateOrCreate(
            ['slug' => 'airsoft-dimanche-demo'],
            [
                'name' => 'Airsoft Dimanche Demo',
                'scheduled_at' => now()->addDays(5)->setTime(9, 0),
                'description' => 'Session ouverte aux adherents et invites. Rendez-vous au terrain principal.',
                'member_slots' => 20,
                'member_price' => 15,
                'guest_own_gear_slots' => 10,
                'guest_own_gear_price' => 25,
                'guest_rental_slots' => 8,
                'guest_rental_price' => 35,
                'status' => Game::STATUS_PUBLISHED,
                'is_published' => true,
                'reservations_open' => true,
            ]
        );

        Reservation::query()->firstOrCreate(
            ['reservation_code' => 'RES-'.now()->format('Y').'-DEMO01'],
            [
                'game_id' => $game->id,
                'full_name' => 'Jean Martin',
                'phone' => '0696123456',
                'email' => 'jean@example.com',
                'reservation_type' => Game::SLOT_MEMBER,
                'unit_price' => 15,
                'quantity' => 1,
                'total_price' => 15,
                'status' => Reservation::STATUS_CONFIRMED,
                'confirmed_at' => now(),
            ]
        );

        $game->syncAvailabilityStatus();
    }
}
