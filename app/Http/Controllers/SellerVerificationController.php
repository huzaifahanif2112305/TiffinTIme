<?php

namespace App\Http\Controllers;

use App\Models\SellerVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SellerVerificationController extends Controller
{
    /**
     * Show the verification application form or current status.
     */
    public function showForm()
    {
        $seller       = auth()->guard('seller')->user();
        $verification = SellerVerification::where('seller_id', $seller->id)->first();

        return view('seller.verification', compact('seller', 'verification'));
    }

    /**
     * Handle the verification form submission.
     */
    public function submit(Request $request)
    {
        $seller = auth()->guard('seller')->user();

        // Prevent resubmission if a pending or approved request exists
        $existing = SellerVerification::where('seller_id', $seller->id)->first();

        if ($existing && in_array($existing->status, ['pending', 'approved'])) {
            return redirect()->route('seller.verification.status')
                ->with('info', 'You already have a ' . $existing->status . ' verification request.');
        }

        $request->validate([
            'full_name'        => 'required|string|max:255',
            'cnic_number'      => ['required', 'string', 'regex:/^\d{5}-\d{7}-\d{1}$/'],
            'address'          => 'required|string|max:500',
            'phone'            => 'required|string|max:20',
            'cnic_front_image' => 'required|image|mimes:jpeg,png,jpg|max:3072',
            'cnic_back_image'  => 'required|image|mimes:jpeg,png,jpg|max:3072',
            'profile_picture'  => 'required|image|mimes:jpeg,png,jpg|max:3072',
        ], [
            'cnic_number.regex'  => 'CNIC must be in the format: 12345-1234567-1',
            'cnic_front_image.max' => 'Each image must be less than 3MB.',
            'cnic_back_image.max'  => 'Each image must be less than 3MB.',
            'profile_picture.max'  => 'Profile picture must be less than 3MB.',
        ]);

        // Store images securely
        $frontPath   = $request->file('cnic_front_image')->store('verifications/cnic', 'public');
        $backPath    = $request->file('cnic_back_image')->store('verifications/cnic', 'public');
        $picturePath = $request->file('profile_picture')->store('verifications/profile', 'public');

        if ($existing) {
            // Resubmit after rejection: delete old images, update record
            Storage::disk('public')->delete([$existing->cnic_front_image, $existing->cnic_back_image, $existing->profile_picture]);
            $existing->update([
                'full_name'        => $request->full_name,
                'cnic_number'      => $request->cnic_number,
                'address'          => $request->address,
                'phone'            => $request->phone,
                'cnic_front_image' => $frontPath,
                'cnic_back_image'  => $backPath,
                'profile_picture'  => $picturePath,
                'status'           => 'pending',
                'admin_notes'      => null,
                'reviewed_at'      => null,
            ]);
        } else {
            SellerVerification::create([
                'seller_id'        => $seller->id,
                'full_name'        => $request->full_name,
                'cnic_number'      => $request->cnic_number,
                'address'          => $request->address,
                'phone'            => $request->phone,
                'cnic_front_image' => $frontPath,
                'cnic_back_image'  => $backPath,
                'profile_picture'  => $picturePath,
                'status'           => 'pending',
            ]);
        }

        return redirect()->route('seller.verification.status')
            ->with('success', 'Your verification request has been submitted successfully!');
    }

    /**
     * Show current verification status to seller.
     */
    public function status()
    {
        $seller       = auth()->guard('seller')->user();
        $verification = SellerVerification::where('seller_id', $seller->id)->first();

        return view('seller.verification-status', compact('seller', 'verification'));
    }
}
