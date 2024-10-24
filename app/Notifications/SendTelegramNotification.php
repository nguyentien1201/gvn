<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramMessage;

class SendTelegramNotification extends Notification
{
    protected $message;

    // Constructor to accept custom message
    public function __construct($message)
    {
        $this->message = $message;
    }

    // Define the channels the notification will be sent to
    public function via($notifiable)
    {
        return ['telegram'];
    }

    // Customize the Telegram message
    public function toTelegram($notifiable)
    {
        return TelegramMessage::create()
            ->to(env('TELEGRAM_GROUP_ID')) // The group chat ID
            ->content($this->message)->options(['parse_mode' => 'HTML']);; // Use the custom message passed via constructor
    }
}
