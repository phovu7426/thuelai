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
        Log::channel('single')->info('[ProcessUnsentContacts] Job started at: ' . now());
        
        $adminEmail = ContactInfo::first()?->email;
        if (!$adminEmail) {
            Log::channel('single')->error('[ProcessUnsentContacts] No admin email found');
            return;
        }
        
        Log::channel('single')->info('[ProcessUnsentContacts] Admin email: ' . $adminEmail);

        $contacts = StoneContact::where('mail_sent', false)->get();
        Log::channel('single')->info('[ProcessUnsentContacts] Found ' . $contacts->count() . ' unsent contacts');
        
        if ($contacts->count() == 0) {
            Log::channel('single')->info('[ProcessUnsentContacts] No unsent contacts to process');
            return;
        }
        
        $successCount = 0;
        $errorCount = 0;
        
        foreach ($contacts as $contact) {
            try {
                Log::channel('single')->info('[ProcessUnsentContacts] Processing contact ID: ' . $contact->id);
                
                Mail::to($adminEmail)->send(new ContactNotification($contact->toArray()));
                $contact->update(['mail_sent' => true]);
                
                $successCount++;
                Log::channel('single')->info('[ProcessUnsentContacts] Successfully sent mail for contact ID: ' . $contact->id);
            } catch (\Throwable $e) {
                $errorCount++;
                Log::channel('single')->error('[ProcessUnsentContacts] Error for contact ID: ' . $contact->id . ' | ' . $e->getMessage());
            }
        }
        
        Log::channel('single')->info('[ProcessUnsentContacts] Job completed. Success: ' . $successCount . ', Errors: ' . $errorCount);
    }
} 