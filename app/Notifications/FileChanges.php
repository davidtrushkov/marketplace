<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class FileChanges extends Notification {


	protected $data;
	protected $header;
	protected $owner;
	protected $file;


	/**
	 * FileChanges constructor.
	 *
	 * @param $data
	 * @param $header
	 * @param $owner
	 * @param $file
	 */
    public function __construct($data, $header, $owner, $file) {
	    $this->data = $data;
	    $this->header = $header;
	    $this->owner = $owner;
	    $this->file = $file;
    }


    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable) {
        return ['database'];
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable) {
        return [
        	'header' => isset($this->header) ? $this->header : 'File updated for: '.$this->file->title,
            'data'   => $this->data,
	        'file'   => $this->file->title,
	        'slug'   => $this->file->identifier,
	        'owner_avatar'  => $this->owner->avatar,
	        'owner_name'    => $this->owner->name
        ];
    }
}
