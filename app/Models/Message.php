<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'sender_id',
        'sender_type',
        'message',
        'is_read',
    ];

    protected $appends = ['sender_name'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function getSenderNameAttribute()
    {
        if ($this->sender_type === 'user') {
            return optional($this->order->user)->name ?? 'Buyer';
        } else {
            return optional($this->order->seller)->name ?? 'Seller';
        }
    }
}
