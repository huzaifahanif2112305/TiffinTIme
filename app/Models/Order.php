<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\SellerController;


class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'seller_id',
        'address',
        'phone',
        'status',
        'total_amount',
        'transaction_id',
        'cancelled_by',
        'cancellation_reason',
        'cancelled_at',
        'refund_status'
    ];

    public function isCancellableByBuyer()
    {
        return in_array($this->status, ['pending', 'accepted']);
    }

    public function isCancellableBySeller()
    {
        return !in_array($this->status, ['completed', 'delivered', 'cancelled', 'rejected']);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }
    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with Message
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
