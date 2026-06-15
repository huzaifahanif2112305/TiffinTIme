<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Order;

class OrderCancelledNotification extends Notification
{
    use Queueable;

    protected $order;
    protected $cancelledBy;
    protected $reason;
    protected $partyName;

    /**
     * Create a new notification instance.
     */
    public function __construct(Order $order, $cancelledBy, $reason, $partyName)
    {
        $this->order = $order;
        $this->cancelledBy = $cancelledBy;
        $this->reason = $reason;
        $this->partyName = $partyName;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    /**
     * Get the database/array representation of the notification.
     */
    public function toDatabase(object $notifiable): array
    {
        $message = $this->cancelledBy === 'user'
            ? "Order #{$this->order->id} has been cancelled by customer {$this->partyName}."
            : "Order #{$this->order->id} has been cancelled by kitchen {$this->partyName}. Reason: {$this->reason}";

        return [
            'order_id' => $this->order->id,
            'cancelled_by' => $this->cancelledBy,
            'reason' => $this->reason,
            'party_name' => $this->partyName,
            'message' => $message,
        ];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $mail = (new MailMessage)
            ->subject("Order #{$this->order->id} Cancelled");

        if ($this->cancelledBy === 'user') {
            $mail->line("Order #{$this->order->id} has been cancelled by customer {$this->partyName}.")
                 ->line("Reason for cancellation: {$this->reason}");
        } else {
            $mail->line("Order #{$this->order->id} has been cancelled by kitchen {$this->partyName}.")
                 ->line("Reason for cancellation: {$this->reason}");
        }

        // Generate URLs safely, fallback if CLI environment fails to generate route
        try {
            $url = $this->cancelledBy === 'user'
                ? route('seller.order.handle', $this->order->id)
                : route('order.track', $this->order->id);
            $mail->action('View Order Details', $url);
        } catch (\Exception $e) {
            $mail->line("You can view details in your dashboard.");
        }

        $mail->line('Thank you for using Tiffin Time!');

        return $mail;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return $this->toDatabase($notifiable);
    }
}
