<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmAccount extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $subject = 'Account Activation';
    /**
     * Create a new message instance.
     * @param $user
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url = (env('APP_ENV') == 'local' ? env('APP_URL') : 'https://devs.brancetech.com')
            . '/userVerification/'.$this->user->verification_token;

        return $this->subject($this->subject)
            ->view('mail.confirm-account')
            ->with(['user' => $this->user, 'url' => $url]);
    }
}
