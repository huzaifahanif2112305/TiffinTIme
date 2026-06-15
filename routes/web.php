<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SellerServiceController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SellerVerificationController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\ChatController;




// Default route
Route::get('/', function () {
    return view('welcome');
});

// Home route
Route::get('/', [HomeController::class, 'showHomePage'])->name('home');

// Auth routes for users
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/verify-otp', [AuthController::class, 'showOtpForm'])->name('verify.otp');
Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);

// Auth routes for sellers
Route::get('/register-seller', [SellerController::class, 'showRegisterForm'])->name('register.seller');
Route::post('/register-seller', [SellerController::class, 'register']);
Route::get('/login-seller', [SellerController::class, 'showLoginForm'])->name('login.seller');
Route::post('/login-seller', [SellerController::class, 'login']);
Route::get('/seller-panel', [SellerController::class, 'sellerPanel'])->name('seller.panel')->middleware('auth:seller');
// Logout routes
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/seller/logout', [SellerController::class, 'logout'])->name('logout.seller');

// Seller service routes
Route::middleware(['auth:seller'])->group(function () {
    Route::put('/seller/services/{id}', [SellerServiceController::class, 'update'])->name('seller.updateService');
    Route::get('/seller/add-service', [SellerServiceController::class, 'showAddServiceForm'])->name('add.service')->middleware('auth:seller');
    Route::post('/seller/add-service', [SellerServiceController::class, 'storeService'])->name('store.service')->middleware('auth:seller');
    Route::get('/seller/edit-service/{id}', [SellerServiceController::class, 'edit'])->name('seller.editService');
    Route::delete('/seller/delete-service/{id}', [SellerServiceController::class, 'delete'])->name('seller.deleteService');
    Route::get('/search-services', [ServiceController::class, 'searchServices'])->name('search.services');
    Route::get('/seller/earnings', [SellerController::class, 'sellerEarnings'])->name('seller.earnings');
    Route::post('/seller/payment-settings', [SellerController::class, 'updatePaymentSettings'])->name('seller.payment.update');

    // Seller Verification Badge
    Route::get('/seller/verification', [SellerVerificationController::class, 'showForm'])->name('seller.verification.form');
    Route::post('/seller/verification', [SellerVerificationController::class, 'submit'])->name('seller.verification.submit');
    Route::get('/seller/verification/status', [SellerVerificationController::class, 'status'])->name('seller.verification.status');

    // Chat routes for Seller
    Route::get('/seller/orders/{order}/messages', [ChatController::class, 'fetchMessagesSeller'])->name('seller.orders.messages.index');
    Route::post('/seller/orders/{order}/messages', [ChatController::class, 'sendMessageSeller'])->name('seller.orders.messages.store');
});



// Admin routes

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/approve-seller/{id}', [AdminController::class, 'approveSeller'])->name('admin.approveSeller');
    Route::post('/admin/reject-seller/{id}', [AdminController::class, 'rejectSeller'])->name('admin.rejectSeller');
    Route::get('/admin/pending-services', [AdminController::class, 'viewPendingServices'])->name('admin.pending-services');
    Route::post('/admin/approve-service/{id}', [AdminController::class, 'approveService'])->name('admin.approveService');
    Route::post('/admin/reject-service/{id}', [AdminController::class, 'rejectService'])->name('admin.rejectService');
    Route::get('/admin/sellers', [AdminController::class, 'manageSellers'])->name('admin.sellers');
    Route::get('/admin/services', [AdminController::class, 'manageServices'])->name('admin.services');
    Route::get('/admin/settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::post('/admin/login-seller/{id}', [AdminController::class, 'loginAsSeller'])->name('admin.loginSeller');
    Route::post('/admin/return-to-admin', [AdminController::class, 'returnToAdmin'])->name('admin.returnToAdmin');

    // Admin Verification Badge Management
    Route::get('/admin/verifications', [AdminController::class, 'verificationRequests'])->name('admin.verifications');
    Route::post('/admin/verifications/{id}/approve', [AdminController::class, 'approveVerification'])->name('admin.verification.approve');
    Route::post('/admin/verifications/{id}/reject', [AdminController::class, 'rejectVerification'])->name('admin.verification.reject');

    // Admin User Suspension Management
    Route::get('/admin/users', [AdminController::class, 'manageUsers'])->name('admin.users');
    Route::post('/admin/users/{id}/toggle-suspend', [AdminController::class, 'toggleSuspendUser'])->name('admin.users.toggle-suspend');
});


Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('auth');
Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::get('notifications/{id}/redirect', [NotificationController::class, 'redirectToService'])->name('notifications.redirect');
    Route::post('notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
});

Route::get('/sellers/{seller}', [ServiceController::class, 'showSellerServices'])->name('sellers.services');
Route::get('sellers/{sellerId}/services', [ServiceController::class, 'showSellerServices'])->name('sellers.services');

Route::get('services/{id}', [ServiceController::class, 'showService'])->name('service.show');

// Notification route
Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');

// Routes for cart functionality
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

// Routes for order placement and tracking (protected by 'auth')
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [OrderController::class, 'showCheckout'])->name('checkout.show');
    Route::post('/checkout', [OrderController::class, 'placeOrder'])->name('checkout.place');
    Route::get('/orders/{order}/track', [OrderController::class, 'track'])->name('order.track');
    Route::get('/order/track/{order}', [OrderController::class, 'trackOrder'])->name('order.track');
    Route::post('/order/{order}/accept-reject', [OrderController::class, 'acceptRejectOrder'])->name('order.acceptReject');

    Route::get('/order/{id}', [OrderController::class, 'show'])->name('order.show');
    Route::post('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');

    // Chat routes for Buyer (User)
    Route::get('/orders/{order}/messages', [ChatController::class, 'fetchMessages'])->name('orders.messages.index');
    Route::post('/orders/{order}/messages', [ChatController::class, 'sendMessage'])->name('orders.messages.store');
});

// Remove this duplicate route that's causing confusion
// Route::get('/seller/order/{order}/handle', [OrderController::class, 'handleOrder'])->name('order.handle');
Route::post('/seller/order/{order}/update-status', [OrderController::class, 'updateOrderStatus'])->name('order.updateStatus');

Route::middleware(['auth'])->group(function () {
    Route::get('/orders', [OrderController::class, 'allOrders'])->name('order.all');
    Route::get('/order-history', [OrderController::class, 'orderHistory'])->name('order.history');
    Route::get('/orders/{order}/track', [OrderController::class, 'track'])->name('order.track');
    // Route::post('/orders/{order}/update-status', [OrderController::class, 'updateStatus'])->name('order.updateStatus');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/my-favourites', [FavouriteController::class, 'index'])->name('favourites.index');
    Route::post('/favourite/toggle', [FavouriteController::class, 'toggle'])->name('favourite.toggle');
});

Route::get('/sellers/{seller_id}/services', [SellerController::class, 'showServices'])->name('seller.services');










Route::get('/seller/order/{order}/handle', [OrderController::class, 'handleOrder'])
    ->name('seller.order.handle')
    ->middleware('auth:seller');

Route::post('/seller/order/{order}/cancel', [OrderController::class, 'sellerCancel'])
    ->name('seller.order.cancel')
    ->middleware('auth:seller');


