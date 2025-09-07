<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendContactForm extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $mail = (new MailMessage)
            ->subject('🔬 New Inquiry – ' . $this->data['subject'])
            ->greeting('Dear Admin,')
            ->line('You have received a new inquiry from your AsiaMed laboratory.')
            ->line('Here are the details:')
            ->line('---');

        if (!empty($this->data['name'])) {
            $mail->line('**Name:** ' . $this->data['name']);
        }
        if (!empty($this->data['phone'])) {
            $mail->line('**Phone:** ' . $this->data['phone']);
        }

        $mail->line('**Email:** ' . $this->data['email'])
            ->line('**Subject:** ' . $this->data['subject'])
            ->line('**Message:**')
            ->line($this->data['message'])
            ->line('---')
            ->line('📩 Please follow up with the customer as soon as possible.')
            ->salutation('Kind regards,')
            ->line($this->data['name']);

        return $mail;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
