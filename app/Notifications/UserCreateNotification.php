<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserCreateNotification extends Notification
{
    use Queueable;

    private $user;

    /**
     * Create a new notification instance.
     * @param $user
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = (env('APP_ENV') == 'local' ? env('APP_URL') : 'https://devs.brancetech.com')
            . '/userVerification/'.$this->user->verification_token;
        return (new MailMessage())
            ->line(trans('global.verifyYourUser'))
            ->action(trans('global.clickHereToVerify'),
                $url)
            ->line(trans('global.thankYouForUsingOurApplication'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
