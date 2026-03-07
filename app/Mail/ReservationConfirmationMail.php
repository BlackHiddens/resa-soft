<?php

namespace App\Mail;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationConfirmationMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(public Reservation $reservation)
    {
    }

    public function build(): self
    {
        return $this
            ->subject('Confirmation de reservation - '.$this->reservation->reservation_code)
            ->view('emails.reservation_confirmation');
    }
}
