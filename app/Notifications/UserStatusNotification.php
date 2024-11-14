<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserStatusNotification extends Notification
{
    use Queueable;

    protected $account_status;
    protected $reason;

    public function __construct($account_status, $reason = null)
    {
        $this->account_status = $account_status;
        $this->reason = $reason;
    }

    public function via($notifiable)
    {
        return ['mail']; // You can add other channels like 'database', 'sms', etc.
    }

    public function toMail($notifiable)
    {
        $mailMessage = (new MailMessage)
            ->subject('Your Registration Status')
            ->line('Your registration has been ' . $this->account_status . '.');

        if ($this->account_status == 'rejected' && $this->reason) {
            $mailMessage->line('Reason: ' . $this->reason);
        }

        $mailMessage->line('Thank you for using our application!');

        return $mailMessage;
    }
}