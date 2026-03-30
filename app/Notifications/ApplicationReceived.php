<?php
namespace App\Notifications;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApplicationReceived extends Notification
{
    use Queueable;

    public function __construct(public Application $application) {}

    public function via($notifiable): array { return ['mail']; }

    public function toMail($notifiable): MailMessage {
        return (new MailMessage)
            ->subject('Nieuwe reactie op uw opdracht')
            ->greeting('Hallo ' . $notifiable->name . '!')
            ->line($this->application->student->name . ' heeft gereageerd op: ' . $this->application->job->title)
            ->action('Bekijk reactie', url('/company/jobs/' . $this->application->job_id . '/applications'))
            ->line('Bedankt voor het gebruik van JuniorDev!');
    }
}
