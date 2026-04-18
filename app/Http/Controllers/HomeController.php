<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Seller;
use Illuminate\Support\Facades\Log;


class HomeController extends Controller
{
    public function showHomePage()
    {
        $services = Service::where('is_approved', 1)->get();

        // Sort services: Available Now -> Upcoming (< 60 mins) -> Closed/Sold Out
        $services = $services->sortBy(function ($service) {
            $now = now();
            $currentDay = $now->format('D');
            $currentTime = $now->format('H:i:s');

            // Check stock
            if (!is_null($service->stock_quantity) && $service->stock_quantity <= 0) {
                return 3; // Sold Out (Bottom)
            }

            // Check Day Availability
            $days = $service->availability_days ?? [];
            if (!empty($days) && !in_array($currentDay, $days)) {
                return 2; // Closed Today
            }

            // Check Time Availability
            if ($service->start_time && $service->end_time) {
                if ($currentTime >= $service->start_time && $currentTime <= $service->end_time) {
                    return 0; // Available Now (Top)
                }

                // Check if upcoming in next 60 mins
                $startTime = \Carbon\Carbon::parse($service->start_time);
                $diffInMinutes = $now->diffInMinutes($startTime, false);

                if ($diffInMinutes > 0 && $diffInMinutes <= 60) {
                    return 1; // Upcoming Soon
                }

                return 2; // Closed (Time mismatch)
            }

            // All Day (if no times set)
            return 0; // Available Now
        });

        $sellers = Seller::where('is_deleted', false)->where('accountIsApproved', 1)->get();
        // $notifications = auth()->user()->notifications()->latest()->take(5)->get();

        return view('home', compact('services', 'sellers'));
    }


    public function index()
    {
        // PHP error log method
        Log::info('Session data:', session()->all());
        $sellers = Seller::where('is_deleted', false)->where('accountIsApproved', 1)->get();
        return view('home', compact('sellers'));
    }
}
