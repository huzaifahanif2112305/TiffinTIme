<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerificationStatusNotification extends Notification
{
    use Queueable;

    public string $status;
    public ?string $adminNotes;

    public function __construct(string $status, ?string $adminNotes = null)
    {
        $this->status     = $status;
        $this->adminNotes = $adminNotes;
    }

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toArray($notifiable): array
    {
        if ($this->status === 'approved') {
            return [
                'message' => '🎉 Congratulations! Your verification request has been approved. Your account is now verified!',
                'type'    => 'verification_approved',
            ];
        }

        $msg = '❌ Your verification request has been rejected.';
        if ($this->adminNotes) {
            $msg .= ' Reason: ' . $this->adminNotes;
        }

        return [
            'message' => $msg,
            'type'    => 'verification_rejected',
        ];
    }
}
