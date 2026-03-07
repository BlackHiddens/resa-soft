<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->dateTime('scheduled_at')->index();
            $table->text('description')->nullable();

            $table->unsignedInteger('member_slots')->default(0);
            $table->decimal('member_price', 10, 2)->default(0);
            $table->unsignedInteger('guest_own_gear_slots')->default(0);
            $table->decimal('guest_own_gear_price', 10, 2)->default(0);
            $table->unsignedInteger('guest_rental_slots')->default(0);
            $table->decimal('guest_rental_price', 10, 2)->default(0);

            $table->string('status')->default('draft')->index();
            $table->boolean('is_published')->default(false)->index();
            $table->boolean('reservations_open')->default(true)->index();
            $table->text('admin_notes')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
