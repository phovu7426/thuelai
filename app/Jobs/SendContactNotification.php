<?php

namespace App\Jobs;

use App\Mail\Stone\ContactNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendContactNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $adminEmail;
    protected $contactData;

    /**
     * Create a new job instance.
     */
    public function __construct($adminEmail, array $contactData)
    {
        $this->adminEmail = $adminEmail;
        $this->contactData = $contactData;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        Mail::to($this->adminEmail)->send(new ContactNotification($this->contactData));
    }
} 