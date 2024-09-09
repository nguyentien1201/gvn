<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Crypt;

class AlertMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $orderId = Crypt::encrypt($this->data->order_id);
        $alertId = Crypt::encrypt($this->data->id);
        return $this->subject('Alert Mail')
            ->from(env('MAIL_FROM_ADDRESS'))
            ->view('mails.alert')
            ->with(['url' => route('admin.alerts.update_status.mail',
                ['order_id' => $orderId, 'alert_id' => $alertId, 'is_mail' => 1])
            ]);
    }
}
