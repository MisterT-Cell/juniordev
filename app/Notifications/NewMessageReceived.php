<?php
namespace App\Notifications;

use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewMessageReceived extends Notification
{
    use Queueable;

    public function __construct(public Message $message) {}

    public function via($notifiable): array { return ['mail']; }

    public function toMail($notifiable): MailMessage {
        return (new MailMessage)
            ->subject('Nieuw bericht: ' . $this->message->subject)
            ->greeting('Hallo ' . $notifiable->name . '!')
            ->line($this->message->sender->name . ' heeft je een bericht gestuurd.')
            ->line('Onderwerp: ' . $this->message->subject)
            ->action('Lees bericht', url('/messages'))
            ->line('Bedankt voor het gebruik van JuniorDev!');
    }
}
