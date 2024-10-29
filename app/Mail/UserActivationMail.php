<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserActivationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        $url = route('user.activate', $this->user->activation_token);

        return $this->view('front.common.activate')
                    ->with(['url' => $url])
                    ->subject('Activate Your Account');
    }
}
