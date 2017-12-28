<?php

namespace Candidatozz\Domains\Candidates\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Class UserNeedsConfirmation.
 *
 * @package \Candidatozz\Domains\Candidates\Notifications
 */
class UserNeedsConfirmation extends Notification
{
    use Queueable;

    /**
     * UserNeedsConfirmation constructor.
     *
     * @param $confirmation_code
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        \Log::info('Candidatozz: Send email confirmation');

        return (new MailMessage())
            ->subject('Candidatozz: Foi criado uma conta pra você')
            ->line('Clique para confirmar')
            ->action('Confirmar', 'http://localhost/confirm')
            ->line('Boa sorte!');
    }
}
