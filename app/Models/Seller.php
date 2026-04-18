<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Hash;

class Seller extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_image',
        'city',
        'area',
        'accountIsApproved',
        'is_deleted',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Mutator to hash passwords only if they aren't already hashed
    public function setPasswordAttribute($password)
    {
        // Only hash if the password isn't already hashed (Hash::needsRehash)
        if (Hash::needsRehash($password)) {
            $this->attributes['password'] = Hash::make($password);
        } else {
            $this->attributes['password'] = $password;
        }
    }

    // Relationship with the Service model
    public function services()
    {
        return $this->hasMany(Service::class, 'seller_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function notifications()
    {
        return $this->morphMany(DatabaseNotification::class, 'notifiable');
    }

    // Verification relationship
    public function verification()
    {
        return $this->hasOne(SellerVerification::class);
    }

    /**
     * Check if the seller is verified (approved badge).
     */
    public function isVerified(): bool
    {
        return $this->verification !== null && $this->verification->status === 'approved';
    }
}
