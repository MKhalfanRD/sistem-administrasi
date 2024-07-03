<?php

namespace App\Services;

use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;

class TwilioService
{
    protected $twilio;

    public function __construct()
    {
        $sid = config('services.twilio.sid');
        $token = config('services.twilio.token');
        $this->twilio = new Client($sid, $token);
    }

    public function sendWhatsAppMessage($to, $message)
    {
        try {
            $from = config('services.twilio.whatsapp_from');

            $this->twilio->messages->create(
                "whatsapp:$to",
                [
                    'from' => $from,
                    'body' => $message,
                ]
            );

            Log::info("Sent WhatsApp message to $to: $message");

            return true;
        } catch (\Exception $e) {
            Log::error("Failed to send WhatsApp message to $to: " . $e->getMessage());
            return false;
        }
    }
}
