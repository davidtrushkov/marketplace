<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class PasswordChanged extends Notification {


    protected $user;


	/**
	 * PasswordChanged constructor.
	 *
	 * @param $user
	 */
    public function __construct($user) {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable) {
        return ['mail'];
    }


	public function toMail($notifiable) {

		$image = '/images/icons/password.svg';
		$imageAlt = 'Your password has been changed';

		return (new MailMessage)
			->markdown('vendor.notifications.email', ['image' => $image, 'imageAlt' => $imageAlt])
			->line('Your password has been changed successfully');
	}
}
