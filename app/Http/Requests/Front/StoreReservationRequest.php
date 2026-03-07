<?php

namespace App\Http\Requests\Front;

use App\Models\Game;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'max:150'],
            'reservation_type' => ['required', Rule::in(Game::slotTypes())],
            'quantity' => ['required', 'integer', 'min:1', 'max:1'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'quantity.max' => 'La version actuelle autorise une seule place par reservation.',
        ];
    }
}
