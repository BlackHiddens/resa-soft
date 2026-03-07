<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class Game extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const STATUS_DRAFT = 'draft';
    public const STATUS_PUBLISHED = 'published';
    public const STATUS_FULL = 'full';
    public const STATUS_CLOSED = 'closed';
    public const STATUS_ARCHIVED = 'archived';

    public const SLOT_MEMBER = 'member';
    public const SLOT_GUEST_OWN_GEAR = 'guest_own_gear';
    public const SLOT_GUEST_RENTAL = 'guest_rental';

    protected $fillable = [
        'name',
        'slug',
        'scheduled_at',
        'description',
        'member_slots',
        'member_price',
        'guest_own_gear_slots',
        'guest_own_gear_price',
        'guest_rental_slots',
        'guest_rental_price',
        'status',
        'is_published',
        'reservations_open',
        'admin_notes',
    ];

    protected function casts(): array
    {
        return [
            'scheduled_at' => 'datetime',
            'member_price' => 'decimal:2',
            'guest_own_gear_price' => 'decimal:2',
            'guest_rental_price' => 'decimal:2',
            'is_published' => 'boolean',
            'reservations_open' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Game $game): void {
            if (! $game->slug) {
                $game->slug = self::generateUniqueSlug($game->name, $game->scheduled_at);
            }
        });

        static::updating(function (Game $game): void {
            if (($game->isDirty('name') || $game->isDirty('scheduled_at')) && ! $game->isDirty('slug')) {
                $game->slug = self::generateUniqueSlug($game->name, $game->scheduled_at, $game->id);
            }
        });
    }

    public static function statuses(): array
    {
        return [
            self::STATUS_DRAFT,
            self::STATUS_PUBLISHED,
            self::STATUS_FULL,
            self::STATUS_CLOSED,
            self::STATUS_ARCHIVED,
        ];
    }

    public static function slotTypes(): array
    {
        return [
            self::SLOT_MEMBER,
            self::SLOT_GUEST_OWN_GEAR,
            self::SLOT_GUEST_RENTAL,
        ];
    }

    public static function slotLabels(): array
    {
        return [
            self::SLOT_MEMBER => 'Adherent',
            self::SLOT_GUEST_OWN_GEAR => 'Invite avec materiel',
            self::SLOT_GUEST_RENTAL => 'Invite sans materiel',
        ];
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function totalCapacity(): int
    {
        return (int) $this->member_slots + (int) $this->guest_own_gear_slots + (int) $this->guest_rental_slots;
    }

    public function totalReserved(): int
    {
        return Reservation::query()
            ->where('game_id', $this->id)
            ->whereIn('status', Reservation::consumingStatuses())
            ->sum('quantity');
    }

    public function fillRate(): float
    {
        if ($this->totalCapacity() === 0) {
            return 0.0;
        }

        return min(100, round(($this->totalReserved() / $this->totalCapacity()) * 100, 2));
    }

    public function quotaForType(string $reservationType): int
    {
        return match ($reservationType) {
            self::SLOT_MEMBER => (int) $this->member_slots,
            self::SLOT_GUEST_OWN_GEAR => (int) $this->guest_own_gear_slots,
            self::SLOT_GUEST_RENTAL => (int) $this->guest_rental_slots,
            default => 0,
        };
    }

    public function priceForType(string $reservationType): float
    {
        return match ($reservationType) {
            self::SLOT_MEMBER => (float) $this->member_price,
            self::SLOT_GUEST_OWN_GEAR => (float) $this->guest_own_gear_price,
            self::SLOT_GUEST_RENTAL => (float) $this->guest_rental_price,
            default => 0,
        };
    }

    public function reservedForType(string $reservationType): int
    {
        return Reservation::query()
            ->where('game_id', $this->id)
            ->where('reservation_type', $reservationType)
            ->whereIn('status', Reservation::consumingStatuses())
            ->sum('quantity');
    }

    public function remainingForType(string $reservationType): int
    {
        $remaining = $this->quotaForType($reservationType) - $this->reservedForType($reservationType);

        return max(0, $remaining);
    }

    public function remainingSlotsByType(): array
    {
        $result = [];

        foreach (self::slotTypes() as $slotType) {
            $result[$slotType] = $this->remainingForType($slotType);
        }

        return $result;
    }

    public function isTypeAvailable(string $reservationType, int $quantity = 1): bool
    {
        if ($quantity <= 0) {
            return false;
        }

        return $this->remainingForType($reservationType) >= $quantity;
    }

    public function isReservable(): bool
    {
        if ($this->scheduled_at instanceof Carbon && $this->scheduled_at->isPast()) {
            return false;
        }

        if (! $this->is_published || ! $this->reservations_open) {
            return false;
        }

        return ! in_array($this->status, [self::STATUS_DRAFT, self::STATUS_FULL, self::STATUS_CLOSED, self::STATUS_ARCHIVED], true);
    }

    public function syncAvailabilityStatus(): void
    {
        $hasAnyRemaining = false;

        foreach (self::slotTypes() as $slotType) {
            if ($this->remainingForType($slotType) > 0) {
                $hasAnyRemaining = true;
                break;
            }
        }

        if (! $hasAnyRemaining) {
            $this->status = self::STATUS_FULL;
            $this->reservations_open = false;
            $this->save();
            return;
        }

        if ($this->status === self::STATUS_FULL && $this->is_published && $this->reservations_open) {
            $this->status = self::STATUS_PUBLISHED;
            $this->save();
        }
    }

    private static function generateUniqueSlug(string $name, mixed $scheduledAt, ?int $ignoreId = null): string
    {
        $base = Str::slug($name ?: 'partie').'-'.Carbon::parse($scheduledAt ?? now())->format('YmdHi');
        $slug = $base;
        $counter = 1;

        while (self::query()
            ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->where('slug', $slug)
            ->exists()) {
            $slug = $base.'-'.$counter;
            $counter++;
        }

        return $slug;
    }
}
