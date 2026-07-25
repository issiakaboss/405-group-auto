<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewAdminWelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $admin;
    public string $password;

    /**
     * Injecter l'utilisateur admin et son mot de passe temporaire
     */
    public function __construct(User $admin, string $password)
    {
        $this->admin = $admin;
        $this->password = $password;
    }

    /**
     * En-tête et Sujet du mail
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Vos accès Administrateur - 405 Group Auto',
        );
    }

    /**
     * Définition de la vue Markdown et des données transmises
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.admin-welcome',
            with: [
                'admin' => $this->admin,
                'password' => $this->password,
            ],
        );
    }

    /**
     * Pièces jointes (optionnel)
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}