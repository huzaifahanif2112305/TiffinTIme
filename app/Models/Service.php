<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'seller_id',
        'service_name',
        'service_description',
        'seller_city',
        'seller_area',
        'availability',
        'service_delivery_time',
        'seller_contact_no',
        'service_price',
        'image',
        'availability_days',
        'start_time',
        'end_time',
        'is_recurring',
        'stock_quantity',
        'category_tag',
        'priority_score',
        'is_approved',
    ];

    protected $casts = [
        'availability_days' => 'array',
        'is_recurring' => 'boolean',
        'is_approved' => 'boolean',
    ];

    public function seller()
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }

    public function scopeAvailableNow($query)
    {
        $now = now();
        $currentDay = $now->format('D'); // Mon, Tue, etc.
        $currentTime = $now->format('H:i:s');

        return $query->where('is_approved', true)
            ->where(function ($q) use ($currentDay, $currentTime) {
                // Check if today is in availability_days
                $q->whereJsonContains('availability_days', $currentDay)
                    ->orWhereNull('availability_days');
            })
            ->where(function ($q) use ($currentTime) {
                // Check time window or if it's all day (null times)
                $q->where(function ($sub) use ($currentTime) {
                    $sub->where('start_time', '<=', $currentTime)
                        ->where('end_time', '>=', $currentTime);
                })->orWhere(function ($sub) {
                    $sub->whereNull('start_time')
                        ->whereNull('end_time');
                });
            })
            ->where(function ($q) {
                // Check stock if set
                $q->where('stock_quantity', '>', 0)
                    ->orWhereNull('stock_quantity');
            });
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favourites');
    }
}
