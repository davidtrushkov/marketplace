<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class FileRejected extends Notification {

	protected $user;
	protected $file;
	protected $data;


	/**
	 * FileApproved constructor.
	 *
	 * @param $user
	 * @param $file
	 */
	public function __construct($user, $file, $data) {
		$this->user = $user;
		$this->file = $file;
		$this->data = $data;
	}


	/**
	 * Get the notification's delivery channels.
	 *
	 * @param  mixed  $notifiable
	 * @return array
	 */
	public function via($notifiable) {
		return ['mail', 'database'];
	}


	/**
	 * Get the mail representation of the notification.
	 *
	 * @param  mixed  $notifiable
	 * @return \Illuminate\Notifications\Messages\MailMessage
	 */
	public function toMail($notifiable) {

		$image = '/images/icons/rejected.svg';
		$imageAlt = 'Your file has been rejected';

		return (new MailMessage)
			->markdown('vendor.notifications.email', ['image' => $image, 'imageAlt' => $imageAlt])
			->line('File name: ' . $this->file->title)
			->line('Your file has been rejected')
			->line('You can check your notifications on Marketplace to see if the admin gave a reason on why your file was rejected');
	}

	/**
	 * Get the array representation of the notification.
	 *
	 * @param  mixed  $notifiable
	 * @return array
	 */
	public function toArray($notifiable) {
		return [
			'header' => 'File: "'.$this->file->title.'" has been rejected by admin',
			'data'   => isset($this->data) ? $this->data : 'Admin gave no reason for file rejection.',
			'file'   => $this->file->title,
		];
	}
}
