<?php

namespace App\Mail\Stone;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $contactData;

    /**
     * Create a new message instance.
     */
    public function __construct(array $contactData)
    {
        $this->contactData = $contactData;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Thông báo liên hệ mới từ khách hàng')
            ->view('emails.stone.contact_notification')
            ->with(['contactData' => $this->contactData]);
    }
} 