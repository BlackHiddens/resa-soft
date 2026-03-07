<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Reservation extends Model
{
    use HasFactory;

    public const STATUS_PENDING = 'pending';
    public const STATUS_CONFIRMED = 'confirmed';
    public const STATUS_CANCELLED = 'cancelled';
    public const STATUS_PRESENT = 'present';
    public const STATUS_ABSENT = 'absent';

    protected $fillable = [
        'reservation_code',
        'game_id',
        'full_name',
        'phone',
        'email',
        'reservation_type',
        'unit_price',
        'quantity',
        'total_price',
        'status',
        'notes',
        'confirmed_at',
        'cancelled_at',
    ];

    protected function casts(): array
    {
        return [
            'unit_price' => 'decimal:2',
            'total_price' => 'decimal:2',
            'confirmed_at' => 'datetime',
            'cancelled_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Reservation $reservation): void {
            if (! $reservation->reservation_code) {
                $reservation->reservation_code = self::generateCode();
            }
        });
    }

    public static function statuses(): array
    {
        return [
            self::STATUS_PENDING,
            self::STATUS_CONFIRMED,
            self::STATUS_CANCELLED,
            self::STATUS_PRESENT,
            self::STATUS_ABSENT,
        ];
    }

    public static function statusLabels(): array
    {
        return [
            self::STATUS_PENDING => 'En attente',
            self::STATUS_CONFIRMED => 'Confirmee',
            self::STATUS_CANCELLED => 'Annulee',
            self::STATUS_PRESENT => 'Present',
            self::STATUS_ABSENT => 'Absent',
        ];
    }

    public static function typeLabels(): array
    {
        return [
            Game::SLOT_MEMBER => 'Adherent',
            Game::SLOT_GUEST_OWN_GEAR => 'Invite avec materiel',
            Game::SLOT_GUEST_RENTAL => 'Invite sans materiel',
        ];
    }

    public static function consumingStatuses(): array
    {
        return [
            self::STATUS_PENDING,
            self::STATUS_CONFIRMED,
            self::STATUS_PRESENT,
            self::STATUS_ABSENT,
        ];
    }

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    public function getTypeLabelAttribute(): string
    {
        return self::typeLabels()[$this->reservation_type] ?? $this->reservation_type;
    }

    public function getStatusLabelAttribute(): string
    {
        return self::statusLabels()[$this->status] ?? $this->status;
    }

    private static function generateCode(): string
    {
        do {
            $code = 'RES-'.now()->format('Y').'-'.Str::upper(Str::random(6));
        } while (self::query()->where('reservation_code', $code)->exists());

        return $code;
    }
}
