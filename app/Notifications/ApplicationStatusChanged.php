<?php
namespace App\Notifications;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApplicationStatusChanged extends Notification
{
    use Queueable;

    public function __construct(public Application $application) {}

    public function via($notifiable): array { return ['mail']; }

    public function toMail($notifiable): MailMessage {
        $status = $this->application->status === 'accepted' ? 'geaccepteerd' : 'afgewezen';
        return (new MailMessage)
            ->subject('Update over je sollicitatie')
            ->greeting('Hallo ' . $notifiable->name . '!')
            ->line('Je reactie op "' . $this->application->assignment->title . '" is ' . $status . '.')
            ->action('Bekijk je reacties', url('/student/applications'))
            ->line('Bedankt voor het gebruik van JuniorDev!');
    }
}
