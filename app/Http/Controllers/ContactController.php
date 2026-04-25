<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160'],
            'phone' => ['nullable', 'string', 'max:40'],
            'service' => ['required', 'string', 'max:120'],
            'message' => ['required', 'string', 'max:3000'],
        ]);

        $recipient = (string) config('services.contact.email');
        $subject = 'Nouveau message - 28 Degrés My Life';
        $body = implode(PHP_EOL, [
            'Nom: ' . $data['name'],
            'Email: ' . $data['email'],
            'Téléphone: ' . ($data['phone'] ?: 'Non renseigné'),
            'Service: ' . $data['service'],
            '',
            'Message:',
            $data['message'],
        ]);

        Mail::raw($body, function ($message) use ($recipient, $subject, $data): void {
            $message->to($recipient)
                ->replyTo($data['email'], $data['name'])
                ->subject($subject);
        });

        $redirectUrl = app()->getLocale() === 'en'
            ? route('root.en') . '#contact'
            : route('root') . '#contact';

        return redirect()
            ->to($redirectUrl)
            ->with('contact_success', __('home.contact.success'));
    }
}
