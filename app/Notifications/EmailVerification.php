<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class EmailVerification extends Notification
{
    use Queueable;


    protected $user;


	/**
	 * EmailVerification constructor.
	 *
	 * @param $user
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
	    $image = '/images/icons/email.svg';
	    $imageAlt = 'Please verify your email address icon image';

        return (new MailMessage)
	        ->markdown('vendor.notifications.email', ['image' => $image, 'imageAlt' => $imageAlt])
	        ->action('Verify email address',  route('verify.email', $this->user->token))
	        ->line('Thanks for registering! In order to protect your account and verify who you are, please confirm your email.');
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
