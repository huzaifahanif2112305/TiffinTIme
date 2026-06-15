<?php

namespace App\Http\Controllers;
use App\Models\Service;
use App\Models\Seller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Notifications\NewOrderNotification;


use App\Models\User;



class OrderController extends Controller
{








    public function show($id)
    {
        $order = Order::where('user_id', Auth::id())->findOrFail($id);
        $order->load(['seller', 'items.service']);
        return view('orders.show', compact('order'));
    }


    public function allOrders()
    {
        $user = auth()->user();

        // Fetch all orders except those with status 'completed' for the authenticated user
        $orders = $user->orders->where('status', '!=', 'completed') ?? collect();

        return view('order.all-orders', compact('orders'));
    }

    public function orderHistory()
    {
        $user = auth()->user();

        // Fetch only completed orders for the authenticated user, latest first
        $orders = $user->orders()
            ->where('status', 'completed')
            ->with(['seller', 'orderItems'])
            ->latest('updated_at')
            ->get();

        return view('order.order-history', compact('orders'));
    }


    public function showCheckout()
    {
        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.view')->with('error', 'Your cart is empty.');
        }

        // Get the first service to determine seller (assuming all services are from same seller)
        $firstServiceId = array_keys($cart)[0];
        $firstService = $this->getService($firstServiceId);
        $seller = null;
        if ($firstService) {
            $seller = Seller::find($firstService->seller_id);
        }

        return view('checkout.show', compact('cart', 'seller'));
    }
    public function placeOrder(Request $request)
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            Log::error('Unauthenticated user attempting to place order');
            return redirect()->route('login')->with('error', 'Please login to place an order.');
        }

        // Check if cart exists and has items
        $cart = session('cart');
        if (!$cart || empty($cart)) {
            Log::error('Cart data is invalid or empty for order placement');
            return redirect()->route('home')->with('error', 'Invalid cart data.');
        }

        // Calculate total amount
        $totalAmount = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        // Get the first service to determine seller (assuming all services are from same seller)
        $firstServiceId = array_keys($cart)[0];
        $firstService = $this->getService($firstServiceId);

        if (!$firstService) {
            Log::error('Invalid service in cart for order placement', ['service_id' => $firstServiceId]);
            return redirect()->route('home')->with('error', 'Invalid service.');
        }

        // Get seller from the first service
        $seller = Seller::find($cart[$firstServiceId]['seller_id']);
        if (!$seller) {
            Log::error('Invalid seller_id for order placement', ['seller_id' => $cart[$firstServiceId]['seller_id']]);
            return redirect()->route('home')->with('error', 'Invalid seller.');
        }

        // Check if all services in cart are from the same seller
        $sellerIds = collect($cart)->pluck('seller_id')->unique();
        if ($sellerIds->count() > 1) {
            Log::error('Multiple sellers in cart not supported', ['seller_ids' => $sellerIds->toArray()]);
            return redirect()->route('home')->with('error', 'All services must be from the same seller.');
        }

        // Check if any cart item is missing seller_id
        $itemsWithoutSeller = collect($cart)->filter(function ($item) {
            return empty($item['seller_id']);
        });

        if ($itemsWithoutSeller->count() > 0) {
            Log::error('Cart items missing seller_id', ['items' => $itemsWithoutSeller->keys()->toArray()]);
            return redirect()->route('home')->with('error', 'Some cart items are invalid. Please refresh your cart.');
        }

        try {
            Log::info('Attempting to place an order', [
                'user_id' => auth()->id(),
                'cart_count' => count($cart),
                'total_amount' => $totalAmount,
                'seller_id' => $seller->id,
                'seller_name' => $seller->name,
            ]);

            // Validate inputs
            $request->validate([
                'address' => 'required|string|max:255',
                'phone' => 'required|string|max:15',
                'payment_method' => 'required|in:cod,online',
                'online_payment_platform' => 'required_if:payment_method,online|nullable|in:easypaisa,jazzcash',
                'transaction_id' => 'required_if:payment_method,online|nullable|string|max:255',
            ]);


            // This will create the order with seller_id
            $order = Order::create([
                'user_id' => Auth::id(),
                'seller_id' => $cart[$firstServiceId]['seller_id'],
                'address' => $request->address,
                'phone' => $request->phone,
                'status' => 'pending',
                'total_amount' => $totalAmount,
                'transaction_id' => $request->payment_method === 'online' ? $request->transaction_id : null,
                'online_payment_platform' => $request->payment_method === 'online' ? $request->online_payment_platform : null,
                'updated_at' => now(),
                'created_at' => now(),
            ]);

            if (!$order) {
                Log::error('Failed to create order', ['data' => $request->all()]);
                throw new \Exception('Order creation failed.');
            }

            // Add order items
            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'service_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            // Clear the cart
            session()->forget('cart');
            Log::info('Order Details:', ['details' => json_encode($order->details)]);
            Log::info('Order Items:', ['items' => $order->items]);
            $seller->notify(new \App\Notifications\NewOrderNotification($seller->name, $order->id, json_encode($order->items)));

            return redirect()->route('home')->with('success', 'Order placed successfully.');

        } catch (\Exception $e) {
            Log::error('Error occurred during order placement', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return redirect()->route('home')->with('error', 'Order placement failed.');
        }
    }


    private function getService($service_id)
    {
        return Service::find($service_id);
    }

    public function trackOrder(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access');
        }

        return view('order.track', compact('order'));
    }

    public function track(Order $order)
    {
        $user = auth()->user();

        if ($order->user_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        $order->load('orderItems');
        $order->load(['user', 'seller', 'items.service']);


        return view('order.track', compact('order'));
    }


    public function acceptRejectOrder(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|string|in:accepted,rejected',
            'cancellation_reason' => 'required_if:status,rejected|nullable|string|max:1000',
        ]);

        $status = $request->input('status');
        $updateData = ['status' => $status];

        if ($status === 'rejected') {
            $updateData['cancelled_by'] = 'seller';
            $updateData['cancellation_reason'] = $request->input('cancellation_reason') ?? 'Kitchen rejected the order.';
            $updateData['cancelled_at'] = now();
            if ($order->transaction_id) {
                $updateData['refund_status'] = 'pending';
            }
        }

        $order->update($updateData);

        if ($status === 'rejected') {
            // Notify buyer
            try {
                $order->user->notify(new \App\Notifications\OrderCancelledNotification(
                    $order,
                    'seller',
                    $order->cancellation_reason,
                    $order->seller->name
                ));
            } catch (\Exception $e) {
                Log::error('Failed to send rejection notification: ' . $e->getMessage());
            }
        }

        return redirect()->route('seller.panel')->with('success', 'Order status updated successfully.');
    }

    public function cancel(Request $request, Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        if (!$order->isCancellableByBuyer()) {
            return redirect()->back()->with('error', 'This order cannot be cancelled anymore.');
        }

        $request->validate([
            'cancellation_reason' => 'required|string|max:1000',
        ]);

        $order->update([
            'status' => 'cancelled',
            'cancelled_by' => 'user',
            'cancellation_reason' => $request->input('cancellation_reason'),
            'cancelled_at' => now(),
            'refund_status' => $order->transaction_id ? 'pending' : 'none',
        ]);

        // Notify seller
        try {
            $order->seller->notify(new \App\Notifications\OrderCancelledNotification(
                $order,
                'user',
                $order->cancellation_reason,
                auth()->user()->name
            ));
        } catch (\Exception $e) {
            Log::error('Failed to send cancellation notification to seller: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Order cancelled successfully.');
    }

    public function sellerCancel(Request $request, Order $order)
    {
        $sellerId = auth()->guard('seller')->id();
        if ($order->seller_id !== $sellerId) {
            abort(403, 'Unauthorized action.');
        }

        if (!$order->isCancellableBySeller()) {
            return redirect()->back()->with('error', 'This order cannot be cancelled anymore.');
        }

        $request->validate([
            'cancellation_reason' => 'required|string|max:1000',
        ]);

        $order->update([
            'status' => 'cancelled',
            'cancelled_by' => 'seller',
            'cancellation_reason' => $request->input('cancellation_reason'),
            'cancelled_at' => now(),
            'refund_status' => $order->transaction_id ? 'pending' : 'none',
        ]);

        // Notify buyer
        try {
            $order->user->notify(new \App\Notifications\OrderCancelledNotification(
                $order,
                'seller',
                $order->cancellation_reason,
                auth()->guard('seller')->user()->name
            ));
        } catch (\Exception $e) {
            Log::error('Failed to send cancellation notification to buyer: ' . $e->getMessage());
        }

        return redirect()->route('seller.panel')->with('success', 'Order cancelled successfully.');
    }

    public function handleOrder(Order $order)
    {
        $sellerId = auth()->guard('seller')->id();
        if ($order->seller_id !== $sellerId) {
            return redirect()->route('seller.panel')->with('error', 'You do not have permission to manage this order.');
        }

        return view('seller.order-handle', compact('order'));
    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|string|in:accepted,cooking,packed,out_for_delivery,delivered,completed',
        ]);

        $sellerId = auth()->guard('seller')->id();
        if ($order->seller_id !== $sellerId) {
            return redirect()->route('seller.panel')->with('error', 'You do not have permission to update this order.');
        }

        $order->update(['status' => $request->status]);

        // If the order is marked as completed
        if ($request->status === 'completed') {
            // You could add any additional logic here if needed
            // For example, sending a notification to the customer
        }

        return redirect()->route('seller.order.handle', $order)->with('success', 'Order status updated successfully!');
    }

    public function showOrderHandling(Order $order)
    {
        return view('seller.order-handle', compact('order'));
    }
}
