<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Order Tracking - Tiffin Time</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="{{ asset('css/orderTrack.css') }}">
    <link rel="stylesheet" href="{{ asset('css/logo.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .status-tracker {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            position: relative;
        }

        .status-tracker::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 3px;
            background-color: #dee2e6;
            z-index: 1;
        }

        .status-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            flex-grow: 1;
            z-index: 2;
        }

        .status-icon {
            width: 40px;
            height: 40px;
            margin-bottom: 10px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #dee2e6;
            color: #6c757d;
            transition: all 0.3s ease;
        }

        .status-icon.completed {
            background-color: #28a745;
            color: white;
        }

        .status-text {
            text-align: center;
            font-size: 0.8rem;
        }
    </style>
</head>

<body>
    <header class="bg-white shadow-sm py-3">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                @include('components.logo')
                <div>
                    <a href="{{ url('/') }}" class="btn-contact btn-sm">
                        <i class="fas fa-home"></i> Home
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="container py-5">
        <!-- Session Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4 animate__animated animate__fadeIn" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4 animate__animated animate__fadeIn" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row justify-content-center g-4">
            <!-- Left Side: Order Progress & Details -->
            <div class="col-lg-7">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-white border-0 p-4 pb-0 d-flex justify-content-between align-items-center">
                        <h2 class="section-title mb-0">Order Tracking</h2>
                        @if($order->isCancellableByBuyer())
                            <button type="button" class="btn btn-outline-danger btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#cancelOrderModal">
                                <i class="fas fa-times me-1"></i> Cancel Order
                            </button>
                        @endif
                    </div>
                    <div class="card-body p-4">
                        <!-- Order Status Alert -->
                        @if($order->status == 'pending')
                            <div class="alert alert-warning animate__animated animate__fadeIn">
                                <i class="bi bi-hourglass-split me-2"></i> Your order is pending confirmation.
                            </div>
                        @elseif($order->status == 'rejected')
                            <div class="alert alert-danger animate__animated animate__fadeIn p-4 border-0 shadow-sm rounded-4">
                                <h5 class="fw-bold mb-2"><i class="bi bi-x-circle me-2"></i> Order Rejected by Kitchen</h5>
                                <p class="mb-2">We are sorry, but the kitchen could not fulfill your order.</p>
                                @if($order->cancellation_reason)
                                    <div class="bg-white bg-opacity-75 p-3 rounded-3 mb-2 text-dark text-sm">
                                        <strong>Reason:</strong> {{ $order->cancellation_reason }}
                                    </div>
                                @endif
                                @if($order->refund_status && $order->refund_status !== 'none')
                                    <div class="alert alert-info py-2 px-3 mb-2 border-0 small d-flex align-items-center gap-2 text-dark">
                                        <i class="bi bi-credit-card"></i>
                                        <span><strong>Refund Status:</strong> {{ ucwords($order->refund_status) }}</span>
                                    </div>
                                @endif
                                @if($order->cancelled_at)
                                    <small class="d-block text-muted-50">Rejected on {{ \Carbon\Carbon::parse($order->cancelled_at)->format('M d, Y \a\t h:i A') }}</small>
                                @endif
                            </div>
                        @elseif($order->status == 'cancelled')
                            <div class="alert alert-danger animate__animated animate__fadeIn p-4 border-0 shadow-sm rounded-4">
                                <h5 class="fw-bold mb-2"><i class="bi bi-slash-circle me-2"></i> Order Cancelled</h5>
                                <p class="mb-2">This order has been cancelled.</p>
                                <div class="bg-white bg-opacity-75 p-3 rounded-3 mb-2 text-dark text-sm">
                                    <span class="d-block mb-1"><strong>Cancelled By:</strong> {{ $order->cancelled_by === 'user' ? 'You (Customer)' : 'Kitchen (Seller)' }}</span>
                                    @if($order->cancellation_reason)
                                        <span class="d-block"><strong>Reason:</strong> {{ $order->cancellation_reason }}</span>
                                    @endif
                                </div>
                                @if($order->refund_status && $order->refund_status !== 'none')
                                    <div class="alert alert-info py-2 px-3 mb-2 border-0 small d-flex align-items-center gap-2">
                                        <i class="bi bi-credit-card"></i>
                                        <span><strong>Refund Status:</strong> {{ ucwords($order->refund_status) }}</span>
                                    </div>
                                @endif
                                @if($order->cancelled_at)
                                    <small class="d-block text-muted-50">Cancelled on {{ \Carbon\Carbon::parse($order->cancelled_at)->format('M d, Y \a\t h:i A') }}</small>
                                @endif
                            </div>
                        @elseif($order->status == 'cooking')
                            <div class="alert alert-info animate__animated animate__fadeIn">
                                <i class="bi bi-fire me-2"></i> Your food is being prepared.
                            </div>
                        @elseif($order->status == 'packed')
                            <div class="alert alert-info animate__animated animate__fadeIn">
                                <i class="bi bi-box-seam me-2"></i> Your food is being packed.
                            </div>
                        @elseif($order->status == 'out_for_delivery')
                            <div class="alert alert-info animate__animated animate__fadeIn">
                                <i class="bi bi-bicycle me-2"></i> Your order is out for delivery.
                            </div>
                        @elseif($order->status == 'delivered')
                            <div class="alert alert-success animate__animated animate__fadeIn">
                                <i class="bi bi-check-circle me-2"></i> Your order has been delivered successfully!
                            </div>
                        @elseif($order->status == 'completed')
                            <div class="alert alert-success animate__animated animate__fadeIn">
                                <i class="bi bi-check-circle-fill me-2"></i> Your order has been completed successfully!
                            </div>
                        @else
                            <div class="alert alert-info animate__animated animate__fadeIn">
                                <i class="bi bi-info-circle me-2"></i> Your order is being processed. You can track its
                                progress below.
                            </div>
                        @endif

                        <!-- Status Tracker -->
                        <div class="status-tracker">
                            @php
                                $statuses = [
                                    'pending' => 'bi-hourglass-split',
                                    'accepted' => 'bi-check-circle',
                                    'cooking' => 'bi-fire',
                                    'packed' => 'bi-box-seam',
                                    'out_for_delivery' => 'bi-bicycle',
                                    'delivered' => 'bi-house-door',
                                    'completed' => 'bi-check-circle-fill',
                                    'rejected' => 'bi-x-circle',
                                    'cancelled' => 'bi-slash-circle'
                                ];

                                $currentStatusIndex = array_search($order->status, array_keys($statuses));
                            @endphp

                            @if ($order->status == 'pending')
                                <div class="status-item">
                                    <div class="status-icon">
                                        <i class="bi bi-hourglass-split fs-4"></i>
                                    </div>
                                    <div class="status-text">
                                        Pending
                                    </div>
                                </div>
                            @elseif ($order->status == 'rejected')
                                <div class="status-item">
                                    <div class="status-icon">
                                        <i class="bi bi-x-circle fs-4"></i>
                                    </div>
                                    <div class="status-text">
                                        Rejected
                                    </div>
                                </div>
                            @elseif ($order->status == 'cancelled')
                                <div class="status-item">
                                    <div class="status-icon">
                                        <i class="bi bi-slash-circle fs-4"></i>
                                    </div>
                                    <div class="status-text">
                                        Cancelled
                                    </div>
                                </div>
                            @else
                                @foreach ($statuses as $statusKey => $iconClass)
                                    @if (!in_array($statusKey, ['pending', 'rejected', 'cancelled']))
                                        @php
                                            $isCompleted = array_search($statusKey, array_keys($statuses)) <= $currentStatusIndex;
                                        @endphp
                                        <div class="status-item">
                                            <div class="status-icon {{ $isCompleted ? 'completed' : '' }}">
                                                <i class="bi {{ $iconClass }} fs-4"></i>
                                            </div>
                                            <div class="status-text">
                                                {{ ucwords(str_replace('_', ' ', $statusKey)) }}
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>

                        <!-- Order Details -->
                        <div class="order-details">
                            <h3 class="section-title">Order Details</h3>

                            <div class="order-meta">
                                <div class="order-meta-item">
                                    <i class="fas fa-hashtag"></i>
                                    <div>
                                        <div class="meta-label">Order ID</div>
                                        <div class="meta-value">{{ $order->id }}</div>
                                    </div>
                                </div>

                                <div class="order-meta-item">
                                    <i class="fas fa-calendar"></i>
                                    <div>
                                        <div class="meta-label">Order Date</div>
                                        <div class="meta-value">{{ $order->created_at->format('M d, Y') }}</div>
                                    </div>
                                </div>

                                <div class="order-meta-item">
                                    <i class="fas fa-money-bill-wave"></i>
                                    <div>
                                        <div class="meta-label">Total Amount</div>
                                        <div class="meta-value">${{ number_format($order->total_amount, 2) }}</div>
                                    </div>
                                </div>

                                <div class="order-meta-item">
                                    <i class="fas fa-info-circle"></i>
                                    <div>
                                        <div class="meta-label">Status</div>
                                        <div class="meta-value">
                                            @if($order->status == 'pending')
                                                <span class="status-badge status-pending">Pending</span>
                                            @elseif($order->status == 'accepted')
                                                <span class="status-badge status-accepted">Accepted</span>
                                            @elseif($order->status == 'cooking')
                                                <span class="status-badge status-washing">Cooking</span>
                                            @elseif($order->status == 'packed')
                                                <span class="status-badge status-ironing">Packed</span>
                                            @elseif($order->status == 'out_for_delivery')
                                                <span class="status-badge status-ready">Out for Delivery</span>
                                            @elseif($order->status == 'delivered')
                                                <span class="status-badge status-delivered">Delivered</span>
                                            @elseif($order->status == 'completed')
                                                <span class="status-badge status-completed">Completed</span>
                                            @elseif($order->status == 'rejected')
                                                <span class="status-badge status-rejected">Rejected</span>
                                            @elseif($order->status == 'cancelled')
                                                <span class="status-badge status-cancelled">Cancelled</span>
                                            @else
                                                <span
                                                    class="status-badge">{{ ucwords(str_replace('_', ' ', $order->status)) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Order Items -->
                        <div class="mt-5">
                            <h3 class="section-title">Order Items</h3>

                            <div class="order-items">
                                @foreach($order->items as $item)
                                    <div class="item-card">
                                        <div class="item-name">{{ $item->service->name }}</div>
                                        <span class="item-qty">{{ $item->quantity }} x {{ $item->item_type }}</span>
                                        <span class="item-price">${{ number_format($item->price, 2) }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Order Chat Support -->
            <div class="col-lg-5">
                <x-order-chat 
                    :order="$order" 
                    userType="user" 
                    :fetchUrl="route('orders.messages.index', $order)" 
                    :sendUrl="route('orders.messages.store', $order)"
                />
            </div>
        </div>
    </div>

    <footer class="bg-white py-4 mt-5 border-top">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-0 text-muted">&copy; {{ date('Y') }} Tiffin Time. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="text-muted me-3">Privacy Policy</a>
                    <a href="#" class="text-muted">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Cancel Order Modal -->
    <div class="modal fade" id="cancelOrderModal" tabindex="-1" aria-labelledby="cancelOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header bg-danger text-white border-0 py-3">
                    <h5 class="modal-title fw-bold" id="cancelOrderModalLabel">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>Cancel Order
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="cancelOrderForm" method="POST" action="{{ route('orders.cancel', $order) }}">
                    @csrf
                    <div class="modal-body p-4">
                        <p class="text-muted">Are you sure you want to cancel this order? This action cannot be undone.</p>
                        <div class="mb-3">
                            <label for="cancellation_reason" class="form-label fw-bold">Reason for Cancellation <span class="text-danger">*</span></label>
                            <textarea class="form-control rounded-3" id="cancellation_reason" name="cancellation_reason" rows="3" required placeholder="Please let us know why you are cancelling this order..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-3 bg-light rounded-bottom-4">
                        <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Keep Order</button>
                        <button type="submit" class="btn btn-danger rounded-pill px-4">Cancel Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>