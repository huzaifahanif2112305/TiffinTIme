<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Manage Order #{{ $order->id }} | Tiffin Time</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --primary: #E23744;
            --primary-dark: #cc222e;
            --secondary: #FF6B35;
            --gradient: linear-gradient(135deg, #E23744 0%, #FF6B35 100%);
            --dark: #1c1c1c;
            --light: #f8f9fa;
            --gray: #9ca3af;
            --card-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.1);
            --hover-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.15);
            --glass-bg: rgba(255, 255, 255, 0.95);
            --border-radius: 16px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f3f4f6;
            color: var(--dark);
            overflow-x: hidden;
        }

        /* Navbar Matches Panel */
        .navbar-custom {
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1rem 0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            z-index: 1000;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary) !important;
        }

        .brand-icon {
            width: 45px;
            height: 45px;
            background: var(--gradient);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            box-shadow: 0 4px 12px rgba(226, 55, 68, 0.3);
        }

        .nav-link {
            font-weight: 500;
            color: #4b5563 !important;
            padding: 0.8rem 1.2rem !important;
            border-radius: 12px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--primary) !important;
            background: rgba(226, 55, 68, 0.08);
        }

        /* Page Header */
        .page-header {
            margin-top: 100px;
            margin-bottom: 2rem;
        }

        .order-id-badge {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* Cards */
        .custom-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: var(--card-shadow);
            border: 1px solid rgba(0, 0, 0, 0.03);
            height: 100%;
            transition: transform 0.3s ease;
        }

        .custom-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--hover-shadow);
        }

        .card-header-custom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #f3f4f6;
        }

        .card-title-custom {
            font-size: 1.2rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--dark);
        }

        /* Timeline / Processor */
        .status-timeline {
            position: relative;
            padding-left: 2rem;
            margin: 2rem 0;
        }

        .status-timeline::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: #e5e7eb;
            border-radius: 4px;
        }

        .timeline-step {
            position: relative;
            padding-bottom: 2rem;
            padding-left: 1.5rem;
        }

        .timeline-step:last-child {
            padding-bottom: 0;
        }

        .timeline-marker {
            position: absolute;
            left: -2.15rem;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #fff;
            border: 4px solid #d1d5db;
            z-index: 1;
        }

        .timeline-step.active .timeline-marker {
            border-color: var(--primary);
            background: var(--primary);
            box-shadow: 0 0 0 4px rgba(226, 55, 68, 0.2);
        }

        .timeline-step.completed .timeline-marker {
            border-color: #10b981;
            background: #10b981;
        }

        .timeline-content h6 {
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .timeline-content p {
            font-size: 0.9rem;
            color: #6b7280;
            margin: 0;
        }

        /* Order Items */
        .order-item {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            padding: 1rem 0;
            border-bottom: 1px dashed #e5e7eb;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .item-icon {
            width: 50px;
            height: 50px;
            background: #fff5f5;
            color: var(--primary);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .item-details h6 {
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .item-price {
            margin-left: auto;
            font-weight: 700;
            font-size: 1.1rem;
        }

        /* Status Action Area */
        .status-action-area {
            background: #fff;
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            border: 2px dashed var(--primary);
            background: #fff5f5;
        }

        .status-btn-lg {
            background: var(--gradient);
            color: white;
            border: none;
            padding: 1rem 2.5rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.1rem;
            box-shadow: 0 10px 20px rgba(226, 55, 68, 0.3);
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .status-btn-lg:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(226, 55, 68, 0.4);
            color: white;
        }

        /* Badges */
        .badge-status {
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: capitalize;
        }

        .status-accepted {
            background: #dbeafe;
            color: #1e40af;
        }

        .status-cooking {
            background: #ffedd5;
            color: #c2410c;
        }

        .status-packed {
            background: #f3e8ff;
            color: #7e22ce;
        }

        .status-out_for_delivery {
            background: #e0e7ff;
            color: #4338ca;
        }

        .status-delivered {
            background: #dcfce7;
            color: #166534;
        }

        .status-completed {
            background: #dcfce7;
            color: #15803d;
        }

        .status-rejected {
            background: #fee2e2;
            color: #b91c1c;
        }

        .status-cancelled {
            background: #fee2e2;
            color: #b91c1c;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 0.8rem 0;
            border-bottom: 1px solid #f3f4f6;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            color: #6b7280;
            font-weight: 500;
        }

        .info-value {
            font-weight: 600;
            color: var(--dark);
            text-align: right;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('seller.panel') }}">
                <div class="brand-icon">
                    <i class="fas fa-utensils"></i>
                </div>
                <span>Tiffin Time <small class="text-muted fw-normal fs-6">Partner</small></span>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarContent">
                <span class="fa fa-bars text-dark"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-3">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('seller.panel') }}">
                            <i class="fas fa-grid-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('add.service') }}">
                            <i class="fas fa-plus-circle"></i> Add Menu
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="{{ route('seller.panel') }}">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mb-5">
        <div
            class="page-header d-flex flex-wrap align-items-center justify-content-between gap-3 animate__animated animate__fadeInDown">
            <div>
                <div class="text-muted small text-uppercase fw-bold mb-1">Order Management</div>
                <div class="order-id-badge">
                    Order #{{ $order->id }}
                    @php
                        $statusClass = match ($order->status) {
                            'accepted' => 'status-accepted',
                            'cooking' => 'status-cooking',
                            'packed' => 'status-packed',
                            'out_for_delivery' => 'status-out_for_delivery',
                            'delivered' => 'status-delivered',
                            'completed' => 'status-completed',
                            'rejected' => 'status-cancelled',
                            'cancelled' => 'status-cancelled',
                            default => 'bg-light text-dark'
                        };
                    @endphp
                    <span class="badge {{ $statusClass }} ms-2" style="font-size: 0.9rem;">
                        {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                    </span>
                </div>
                <div class="text-muted mt-2">
                    <i class="far fa-clock me-1"></i> {{ $order->created_at->format('F d, Y • h:i A') }}
                </div>
            </div>

            <div class="d-flex align-items-center gap-2">
                <div class="text-end">
                    <div class="small text-muted fw-bold text-uppercase">Total Amount</div>
                    <div class="h2 fw-bold text-dark mb-0">{{ number_format($order->total_amount) }} <span
                            class="fs-6 text-muted">PKR</span></div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Left Column: Order Items & Customer -->
            <div class="col-lg-8">
                <!-- Status Process -->
                <div class="custom-card mb-4 animate__animated animate__fadeInUp">
                    <div class="card-header-custom">
                        <div class="card-title-custom"><i class="fas fa-tasks text-primary"></i> Order Progress</div>
                    </div>

                    @php
                        $statusFlow = [
                            'accepted' => 'Order Accepted',
                            'cooking' => 'Cooking in Progress',
                            'packed' => 'Packed & Ready',
                            'out_for_delivery' => 'Out for Delivery',
                            'delivered' => 'Delivered',
                            'completed' => 'Completed'
                        ];

                        $currentStatusIndex = array_search($order->status, array_keys($statusFlow));
                    @endphp

                    <div class="status-action-area">
                        @if($order->status === 'pending')
                            <h4 class="fw-bold mb-3 text-warning"><i class="fas fa-clock"></i> Pending Confirmation</h4>
                            <p class="text-muted mb-4">Accept or reject this new order.</p>
                            <div class="d-flex justify-content-center gap-3">
                                <form action="{{ route('order.acceptReject', $order) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="accepted">
                                    <button type="submit" class="btn btn-success btn-lg rounded-pill px-4">
                                        <i class="fas fa-check-circle me-1"></i> Accept Order
                                    </button>
                                </form>
                                <button type="button" class="btn btn-danger btn-lg rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#sellerRejectModal">
                                    <i class="fas fa-times-circle me-1"></i> Reject Order
                                </button>
                            </div>
                        @elseif($order->status === 'rejected')
                            <div class="text-danger">
                                <i class="fas fa-times-circle fa-3x mb-3"></i>
                                <h3>Order Rejected</h3>
                                <p>You rejected this order.</p>
                                @if($order->cancellation_reason)
                                    <div class="alert alert-danger d-inline-block text-start mt-2 border-0 shadow-sm rounded-3">
                                        <strong>Reason:</strong> {{ $order->cancellation_reason }}
                                    </div>
                                @endif
                            </div>
                        @elseif($order->status === 'cancelled')
                            <div class="text-danger">
                                <i class="fas fa-ban fa-3x mb-3"></i>
                                <h3>Order Cancelled</h3>
                                <p>This order was cancelled by <strong>{{ $order->cancelled_by === 'user' ? 'Customer' : 'Kitchen' }}</strong>.</p>
                                @if($order->cancellation_reason)
                                    <div class="alert alert-danger d-inline-block text-start mt-2 border-0 shadow-sm rounded-3">
                                        <strong>Reason:</strong> {{ $order->cancellation_reason }}
                                    </div>
                                @endif
                                @if($order->refund_status && $order->refund_status !== 'none')
                                    <div class="alert alert-info d-inline-block text-start mt-2 border-0 shadow-sm rounded-3 text-dark">
                                        <i class="fas fa-credit-card me-1"></i> <strong>Refund Status:</strong> {{ ucwords($order->refund_status) }}
                                    </div>
                                @endif
                            </div>
                        @else
                            @php
                                $nextStatusKey = null;
                                $keys = array_keys($statusFlow);
                                if ($currentStatusIndex !== false && $currentStatusIndex < count($keys) - 1) {
                                    $nextStatusKey = $keys[$currentStatusIndex + 1];
                                }
                            @endphp

                            @if($nextStatusKey)
                                <h4 class="fw-bold mb-3">Next Step</h4>
                                <p class="text-muted mb-4">Move order to <strong>{{ $statusFlow[$nextStatusKey] }}</strong> phase?</p>

                                <form action="{{ route('order.updateStatus', $order) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    <input type="hidden" name="status" value="{{ $nextStatusKey }}">
                                    <button type="submit" class="status-btn-lg">
                                        <i class="fas fa-check-circle"></i> Mark as {{ $statusFlow[$nextStatusKey] }}
                                    </button>
                                </form>
                            @elseif($order->status === 'completed')
                                <div class="text-success">
                                    <i class="fas fa-check-circle fa-3x mb-3"></i>
                                    <h3>Order Completed</h3>
                                    <p>This order has been successfully fulfilled.</p>
                                </div>
                            @else
                                <div class="text-muted">
                                    <i class="fas fa-ban fa-3x mb-3"></i>
                                    <h3>No Actions Available</h3>
                                    <p>This order cannot be updated further.</p>
                                </div>
                            @endif

                            @if($order->isCancellableBySeller())
                                <div class="mt-4 pt-3 border-top">
                                    <button type="button" class="btn btn-outline-danger rounded-pill px-4 py-2" data-bs-toggle="modal" data-bs-target="#sellerCancelModal">
                                        <i class="fas fa-times-circle me-1"></i> Cancel Order
                                    </button>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>

                <!-- Order Items -->
                <div class="custom-card animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
                    <div class="card-header-custom">
                        <div class="card-title-custom"><i class="fas fa-utensils text-primary"></i> Order Details</div>
                        <span class="badge bg-light text-dark">{{ $order->items->count() }} Items</span>
                    </div>

                    <div class="order-items-list">
                        @foreach ($order->items as $item)
                            <div class="order-item">
                                <div class="item-icon">
                                    <i class="fas fa-bowl-food"></i>
                                </div>
                                <div class="item-details">
                                    <h6 class="text-dark">{{ optional($item->service)->service_name ?? 'Unavailable Item' }}
                                    </h6>
                                    <div class="text-muted small">Quantity: <strong>{{ $item->quantity }}</strong></div>
                                </div>
                                <div class="item-price">
                                    {{ number_format($item->price * $item->quantity) }} PKR
                                </div>
                            </div>
                        @endforeach

                        <div class="d-flex justify-content-between pt-3 mt-3 border-top">
                            <span class="fw-bold text-muted">Subtotal</span>
                            <span class="fw-bold">{{ number_format($order->total_amount) }} PKR</span>
                        </div>
                        <div class="d-flex justify-content-between pt-2">
                            <span class="fw-bold text-muted">Delivery Fee</span>
                            <span class="fw-bold text-success">Free</span>
                        </div>
                        <div class="d-flex justify-content-between pt-3 mt-2 border-top">
                            <span class="h5 fw-bold text-dark">Total</span>
                            <span class="h5 fw-bold text-primary">{{ number_format($order->total_amount) }} PKR</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Info Cards -->
            <div class="col-lg-4">
                <!-- Customer Info -->
                <div class="custom-card mb-4 animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                    <div class="card-header-custom">
                        <div class="card-title-custom"><i class="fas fa-user-circle text-primary"></i> Customer</div>
                    </div>
                    <div class="text-center mb-4">
                        <div class="bg-gradient text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3 fw-bold"
                            style="width: 64px; height: 64px; font-size: 1.5rem; background: var(--gradient);">
                            {{ substr($order->user->name ?? 'U', 0, 1) }}
                        </div>
                        <h5 class="fw-bold mb-1">{{ $order->user->name ?? 'Unknown Customer' }}</h5>
                        <div class="badge bg-light text-muted">{{ $order->user->email ?? 'No Email' }}</div>
                    </div>

                    <div class="info-list">
                        <div class="info-row">
                            <span class="info-label"><i class="fas fa-phone me-2"></i> Mobile</span>
                            <span class="info-value">{{ $order->user->mobile ?? $order->phone ?? 'N/A' }}</span>
                        </div>
                        <div class="info-row align-items-start">
                            <span class="info-label"><i class="fas fa-map-marker-alt me-2"></i> Address</span>
                            <span class="info-value text-break"
                                style="max-width: 60%;">{{ $order->address ?? optional($order->user)->address ?? 'No Address' }}</span>
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top text-center">
                        <a href="tel:{{ $order->phone ?? optional($order->user)->mobile }}"
                            class="btn btn-outline-primary rounded-pill w-100"><i class="fas fa-phone-alt me-2"></i>
                            Call Customer</a>
                    </div>
                </div>

                <!-- Payment Info -->
                <div class="custom-card mb-4 animate__animated animate__fadeInUp" style="animation-delay: 0.3s;">
                    <div class="card-header-custom">
                        <div class="card-title-custom"><i class="fas fa-wallet text-primary"></i> Payment</div>
                    </div>

                    <div class="text-center p-3 bg-light rounded-4 mb-3">
                        @if($order->transaction_id)
                            <i class="fas fa-credit-card text-success fa-2x mb-2"></i>
                            <h6 class="fw-bold margin-0">Online Payment</h6>
                            <small class="text-muted">ID: {{ $order->transaction_id }}</small>
                        @else
                            <i class="fas fa-money-bill-wave text-success fa-2x mb-2"></i>
                            <h6 class="fw-bold margin-0">Cash on Delivery</h6>
                            <small class="text-muted">Collect cash upon delivery</small>
                        @endif
                    </div>

                    <div class="alert alert-warning d-flex align-items-center gap-2 mb-0" style="font-size: 0.85rem;">
                        <i class="fas fa-info-circle"></i>
                        @if($order->transaction_id)
                            Payment already verified.
                        @else
                            Please create invoice before delivery.
                        @endif
                    </div>
                    @if($order->refund_status && $order->refund_status !== 'none')
                        <div class="alert alert-info d-flex align-items-center gap-2 mb-0 mt-3 text-dark" style="font-size: 0.85rem;">
                            <i class="fas fa-undo"></i>
                            <span>Refund Status: <strong>{{ ucwords($order->refund_status) }}</strong></span>
                        </div>
                    @endif
                </div>

                <!-- Chat Support -->
                <x-order-chat 
                    :order="$order" 
                    userType="seller" 
                    :fetchUrl="route('seller.orders.messages.index', $order)" 
                    :sendUrl="route('seller.orders.messages.store', $order)"
                />
            </div>
        </div>
    </div>

    <!-- Seller Reject Order Modal -->
    <div class="modal fade" id="sellerRejectModal" tabindex="-1" aria-labelledby="sellerRejectModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header bg-danger text-white border-0 py-3">
                    <h5 class="modal-title fw-bold" id="sellerRejectModalLabel">
                        <i class="fas fa-exclamation-triangle me-2"></i>Reject Order
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="sellerRejectForm" method="POST" action="{{ route('order.acceptReject', $order) }}">
                    @csrf
                    <input type="hidden" name="status" value="rejected">
                    <div class="modal-body p-4">
                        <p class="text-muted">Are you sure you want to reject this order? Please provide a reason for the customer.</p>
                        <div class="mb-3">
                            <label for="seller_rejection_reason" class="form-label fw-bold">Reason for Rejection <span class="text-danger">*</span></label>
                            <textarea class="form-control rounded-3" id="seller_rejection_reason" name="cancellation_reason" rows="3" required placeholder="e.g. Out of ingredients, kitchen closed, too busy..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-3 bg-light rounded-bottom-4">
                        <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger rounded-pill px-4">Reject Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Seller Cancel Order Modal -->
    <div class="modal fade" id="sellerCancelModal" tabindex="-1" aria-labelledby="sellerCancelModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header bg-danger text-white border-0 py-3">
                    <h5 class="modal-title fw-bold" id="sellerCancelModalLabel">
                        <i class="fas fa-exclamation-triangle me-2"></i>Cancel Order
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="sellerCancelForm" method="POST" action="{{ route('seller.order.cancel', $order) }}">
                    @csrf
                    <div class="modal-body p-4">
                        <p class="text-muted">Are you sure you want to cancel this order? This action cannot be undone.</p>
                        <div class="mb-3">
                            <label for="seller_cancellation_reason" class="form-label fw-bold">Reason for Cancellation <span class="text-danger">*</span></label>
                            <textarea class="form-control rounded-3" id="seller_cancellation_reason" name="cancellation_reason" rows="3" required placeholder="e.g. Courier unavailable, kitchen issue, customer requested..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-3 bg-light rounded-bottom-4">
                        <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger rounded-pill px-4">Cancel Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });
    </script>
</body>

</html>