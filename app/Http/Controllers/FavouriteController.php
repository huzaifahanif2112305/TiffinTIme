<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Service;
use App\Models\Favourite;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
    public function index()
    {
        $favourites = Auth::user()->favourites()->with('seller')->get();
        return view('favourites.index', compact('favourites'));
    }

    public function toggle(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id'
        ]);

        $user = Auth::user();
        $serviceId = $request->service_id;

        $existingFavourite = Favourite::where('user_id', $user->id)
                                      ->where('service_id', $serviceId)
                                      ->first();

        if ($existingFavourite) {
            $existingFavourite->delete();
            return response()->json([
                'status' => 'removed',
                'message' => 'Removed from favourites'
            ]);
        } else {
            Favourite::create([
                'user_id' => $user->id,
                'service_id' => $serviceId
            ]);
            return response()->json([
                'status' => 'added',
                'message' => 'Added to favourites'
            ]);
        }
    }
}
