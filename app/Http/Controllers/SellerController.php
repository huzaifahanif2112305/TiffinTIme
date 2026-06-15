<?php
namespace App\Http\Controllers;

use App\Models\Seller;
use App\Models\User;
use App\Models\Service;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;



class SellerController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register-seller');
    }
    public function register(Request $request)
    {
        // Custom validation messages
        $customMessages = [
            'email.required' => 'Email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already registered. Please use a different email.',
            'email.max' => 'Email cannot exceed 255 characters.',
        ];

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email:rfc,dns|max:255|unique:sellers',
            'password' => 'required|string|min:8|confirmed',
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'city' => 'required|string|max:255',
            'area' => 'required|string|max:255',
            'terms' => 'required',
        ], $customMessages);

        try {
            // Additional custom email validation
            $email = $request->email;
            $errors = [];

            // Check for suspicious domains
            $suspiciousDomains = ['example.com', 'test.com', 'sample.com', 'temp-mail.org', 'fakeemail.com'];
            foreach ($suspiciousDomains as $domain) {
                if (strpos($email, $domain) !== false) {
                    $errors['email'] = 'Please use a real email address, not a temporary or test email.';
                    break;
                }
            }

            // Check for valid email format beyond Laravel's validation
            $parts = explode('@', $email);
            if (count($parts) == 2) {
                $domain = $parts[1];
                // Check domain has at least one dot
                if (!str_contains($domain, '.') || substr_count($domain, '.') > 3) {
                    $errors['email'] = 'Please provide an email with a valid domain format.';
                }
            }

            // Return with errors if any additional validations fail
            if (!empty($errors)) {
                return back()->withInput()->withErrors($errors);
            }

            if ($request->hasFile('profile_image')) {
                $imagePath = $request->file('profile_image')->store('profile_images', 'public');
            } else {
                $imagePath = null;
            }

            $seller = Seller::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password, // Don't use bcrypt here - the model's mutator will handle it
                'profile_image' => $imagePath,
                'city' => $request->city,
                'area' => $request->area,
                'accountIsApproved' => 0,
            ]);

            // Return to registration page with success parameter
            return redirect()->route('register.seller', ['registration' => 'success']);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Registration failed: ' . $e->getMessage()]);
        }
    }

    public function showLoginForm()
    {
        return view('auth.login-seller');
    }

    public function login(Request $request)
    {
        // Custom validation messages for login
        $customMessages = [
            'email.required' => 'Email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'Password is required.',
        ];

        $request->validate([
            'email' => 'required|string|email:rfc',
            'password' => 'required|string',
        ], $customMessages);

        // Additional email validation for common mistakes
        $email = $request->email;
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return back()->withInput()->withErrors(['email' => 'The email format is invalid. Please check for typos.']);
        }

        $seller = Seller::where('email', $request->email)->first();

        if (!$seller) {
            return back()->withErrors(['email' => 'No account found with this email. Please register first.']);
        }

        if ($seller->accountIsApproved == 0) {
            return back()->withErrors(['email' => 'Your account is pending approval. Please wait for admin approval.']);
        }

        // First, try normal authentication
        $credentials = $request->only('email', 'password');
        if (Auth::guard('seller')->attempt($credentials, $request->filled('remember'))) {
            return redirect()->intended(route('seller.panel'));
        }

        // If regular auth fails, try manually checking for double-hashed legacy passwords
        $plainPassword = $request->password;
        $hashedOnce = bcrypt($plainPassword);

        // Check if the stored password might be a legacy double-hashed password
        if (password_verify($hashedOnce, $seller->password)) {
            // If legacy password matches, log the user in manually
            Auth::guard('seller')->login($seller, $request->filled('remember'));

            // Update the password to the new hashing method
            $seller->password = $plainPassword; // This will use the model's mutator
            $seller->save();

            return redirect()->intended(route('seller.panel'));
        }

        // If both auth methods fail, return an error
        return back()->withInput()->withErrors(['email' => 'The password you entered is incorrect. Please try again.']);
    }


    public function showServices($seller_id)
    {
        $seller = Seller::findOrFail($seller_id);
        $services = Service::where('seller_id', $seller_id)->get();



        return view('seller-services', compact('seller', 'services'));
    }







    public function sellerPanel()
    {
        $seller = auth()->guard('seller')->user();

        $services = $seller->services;
        $orders = Order::where('seller_id', $seller->id)->with(['user', 'items.service'])->get();

        // Count completed and delivered orders for the dashboard
        $completedOrdersCount = Order::where('seller_id', $seller->id)
            ->where(function ($query) {
                $query->where('status', 'completed')
                    ->orWhere('status', 'delivered');
            })
            ->count();

        $notifications = $seller->notifications;

        return view('seller.panel', compact('services', 'orders', 'notifications', 'completedOrdersCount'));
    }



    public function sellerEarnings()
    {
        $seller   = auth()->guard('seller')->user();
        $sellerId = $seller->id;

        // Base query: only completed orders
        $baseQuery = Order::where('seller_id', $sellerId)
            ->where('status', 'completed')
            ->with(['user', 'orderItems']);

        $completedOrders = (clone $baseQuery)->latest('updated_at')->get();

        // ---- KPI totals ----
        $totalEarnings  = $completedOrders->sum('total_amount');
        $todayEarnings  = (clone $baseQuery)->whereDate('updated_at', today())->sum('total_amount');
        $weekEarnings   = (clone $baseQuery)->whereBetween('updated_at', [now()->startOfWeek(), now()->endOfWeek()])->sum('total_amount');
        $monthEarnings  = (clone $baseQuery)->whereMonth('updated_at', now()->month)->whereYear('updated_at', now()->year)->sum('total_amount');
        $completedOrdersCount = $completedOrders->count();

        // ---- Daily (last 30 days) ----
        $dailyData = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $amt  = (clone $baseQuery)->whereDate('updated_at', $date)->sum('total_amount');
            $dailyData[] = ['label' => now()->subDays($i)->format('d M'), 'amount' => (float)$amt];
        }

        // ---- Weekly (last 12 weeks) ----
        $weeklyData = [];
        for ($i = 11; $i >= 0; $i--) {
            $start = now()->startOfWeek()->subWeeks($i);
            $end   = (clone $start)->endOfWeek();
            $amt   = (clone $baseQuery)->whereBetween('updated_at', [$start, $end])->sum('total_amount');
            $weeklyData[] = ['label' => 'W' . $start->weekOfYear . ' ' . $start->format('M'), 'amount' => (float)$amt];
        }

        // ---- Monthly (current year, 12 months) ----
        $monthlyData = [];
        for ($m = 1; $m <= 12; $m++) {
            $amt = (clone $baseQuery)->whereMonth('updated_at', $m)->whereYear('updated_at', now()->year)->sum('total_amount');
            $monthlyData[] = ['label' => Carbon::create(null, $m)->format('M'), 'amount' => (float)$amt];
        }

        // ---- Quarterly (current year) ----
        $quarters = ['Q1' => [1,3], 'Q2' => [4,6], 'Q3' => [7,9], 'Q4' => [10,12]];
        $quarterlyEarnings = [];
        $quarterlyOrders   = [];
        foreach ($quarters as $qLabel => [$startM, $endM]) {
            $q = (clone $baseQuery)
                ->whereYear('updated_at', now()->year)
                ->whereMonth('updated_at', '>=', $startM)
                ->whereMonth('updated_at', '<=', $endM);
            $quarterlyEarnings[$qLabel] = (float)$q->sum('total_amount');
            $quarterlyOrders[$qLabel]   = (clone $baseQuery)
                ->whereYear('updated_at', now()->year)
                ->whereMonth('updated_at', '>=', $startM)
                ->whereMonth('updated_at', '<=', $endM)
                ->count();
        }

        // ---- Yearly (last 5 years) ----
        $yearlyData = [];
        for ($y = now()->year - 4; $y <= now()->year; $y++) {
            $amt = (clone $baseQuery)->whereYear('updated_at', $y)->sum('total_amount');
            $yearlyData[] = ['label' => (string)$y, 'amount' => (float)$amt];
        }

        // ---- Payment split ----
        $cashEarnings   = (clone $baseQuery)->whereNull('transaction_id')->sum('total_amount');
        $onlineEarnings = (clone $baseQuery)->whereNotNull('transaction_id')->sum('total_amount');

        return view('seller.earnings', compact(
            'completedOrders', 'totalEarnings', 'todayEarnings', 'weekEarnings',
            'monthEarnings', 'completedOrdersCount', 'dailyData', 'weeklyData',
            'monthlyData', 'quarterlyEarnings', 'quarterlyOrders', 'yearlyData',
            'cashEarnings', 'onlineEarnings'
        ));
    }

    public function updatePaymentSettings(Request $request)
    {
        $seller = auth()->guard('seller')->user();

        $request->validate([
            'easypaisa_title' => 'nullable|string|max:255',
            'easypaisa_number' => 'nullable|string|max:20',
            'jazzcash_title' => 'nullable|string|max:255',
            'jazzcash_number' => 'nullable|string|max:20',
        ]);

        $seller->update([
            'easypaisa_title' => $request->easypaisa_title,
            'easypaisa_number' => $request->easypaisa_number,
            'jazzcash_title' => $request->jazzcash_title,
            'jazzcash_number' => $request->jazzcash_number,
        ]);

        return redirect()->back()->with('success', 'Payment settings updated successfully!');
    }

    public function logout(Request $request)
    {
        Auth::guard('seller')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login.seller');
    }

}