<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client as TwilioClient;

class NotificationService
{
    protected $twilioClient;

    public function __construct()
    {
        $this->twilioClient = new TwilioClient(
            config('services.twilio.sid'),
            config('services.twilio.token')
        );
    }

    public function send(User $user, string $type, string $title, string $message, array $data = [], string $priority = 'medium')
    {
        $notification = Notification::create([
            'user_id' => $user->id,
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'data' => $data,
            'priority' => $priority,
            'status' => 'pending'
        ]);

        try {
            switch ($type) {
                case 'email':
                    $this->sendEmail($notification);
                    break;
                case 'sms':
                    $this->sendSMS($notification);
                    break;
                case 'system':
                    $this->sendSystemNotification($notification);
                    break;
            }

            $notification->update([
                'status' => 'sent',
                'sent_at' => now()
            ]);

        } catch (\Exception $e) {
            Log::error('Error sending notification: ' . $e->getMessage());
            $notification->update(['status' => 'failed']);
            throw $e;
        }

        return $notification;
    }

    protected function sendEmail(Notification $notification)
    {
        Mail::send(
            'emails.notification',
            ['notification' => $notification],
            function ($message) use ($notification) {
                $message->to($notification->user->email)
                        ->subject($notification->title);
            }
        );
    }

    protected function sendSMS(Notification $notification)
    {
        if (!$notification->user->phone) {
            throw new \Exception('Usuario sin número de teléfono registrado');
        }

        $this->twilioClient->messages->create(
            $notification->user->phone,
            [
                'from' => config('services.twilio.phone'),
                'body' => $notification->message
            ]
        );
    }

    protected function sendSystemNotification(Notification $notification)
    {
        event(new SystemNotification($notification));
    }
} 