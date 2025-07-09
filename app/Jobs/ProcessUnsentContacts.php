<?php

namespace App\Jobs;

use App\Models\StoneContact;
use App\Models\ContactInfo;
use App\Mail\Stone\ContactNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ProcessUnsentContacts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $adminEmail = ContactInfo::first()?->email;
        if (!$adminEmail) return;

        $contacts = StoneContact::where('mail_sent', false)->get();
        Log::channel('single')->info('[ProcessUnsentContacts] Run at: ' . now() . ' | Found: ' . $contacts->count() . ' contacts');
        foreach ($contacts as $contact) {
            try {
                Mail::to($adminEmail)->send(new ContactNotification($contact->toArray()));
                $contact->update(['mail_sent' => true]);
                Log::channel('single')->info('[ProcessUnsentContacts] Sent mail for contact ID: ' . $contact->id);
            } catch (\Throwable $e) {
                Log::channel('single')->error('[ProcessUnsentContacts] Error for contact ID: ' . $contact->id . ' | ' . $e->getMessage());
            }
        }
    }
} 