<?php

namespace App\Http\Requests\Admin;

use App\Models\Game;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreGameRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'scheduled_at' => ['required', 'date'],
            'description' => ['nullable', 'string'],
            'status' => ['required', Rule::in(Game::statuses())],
            'member_slots' => ['required', 'integer', 'min:0'],
            'member_price' => ['required', 'numeric', 'min:0'],
            'guest_own_gear_slots' => ['required', 'integer', 'min:0'],
            'guest_own_gear_price' => ['required', 'numeric', 'min:0'],
            'guest_rental_slots' => ['required', 'integer', 'min:0'],
            'guest_rental_price' => ['required', 'numeric', 'min:0'],
            'is_published' => ['nullable', 'boolean'],
            'reservations_open' => ['nullable', 'boolean'],
            'admin_notes' => ['nullable', 'string'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_published' => $this->boolean('is_published'),
            'reservations_open' => $this->boolean('reservations_open'),
        ]);
    }
}
