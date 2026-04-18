<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History - Tiffin Time</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styleHome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/orderTrack.css') }}">
    <link rel="stylesheet" href="{{ asset('css/logo.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }

        .history-hero {
            background: linear-gradient(135deg, #E23744 0%, #FF6B35 100%);
            padding: 60px 0 40px;
            color: white;
            text-align: center;
            margin-bottom: 40px;
        }

        .history-hero h1 {
            font-size: 2.4rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .history-hero p {
            font-size: 1.05rem;
            opacity: 0.88;
            margin-bottom: 0;
        }

        .history-hero .hero-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.9;
        }

        .history-stats {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-top: 1.5rem;
            flex-wrap: wrap;
        }

        .history-stat {
            background: rgba(255, 255, 255, 0.18);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255,255,255,0.3);
            border-radius: 14px;
            padding: 12px 24px;
            text-align: center;
        }

        .history-stat .stat-val {
            font-size: 1.6rem;
            font-weight: 700;
            line-height: 1;
        }

        .history-stat .stat-lbl {
            font-size: 0.8rem;
            opacity: 0.85;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 3px;
        }

        .orders-container {
            max-width: 1000px;
            margin: 0 auto;
            padding-bottom: 60px;
        }

        .empty-history {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 4rem 2rem;
            background: white;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.07);
            text-align: center;
        }

        .empty-history .empty-icon {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(226,55,68,0.1), rgba(255,107,53,0.1));
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .empty-history .empty-icon i {
            font-size: 2.8rem;
            background: linear-gradient(135deg, #E23744, #FF6B35);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .empty-history h4 {
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 0.5rem;
        }

        .empty-history p {
            color: #718096;
            margin-bottom: 1.5rem;
        }

        .btn-order-now {
            background: linear-gradient(135deg, #E23744, #FF6B35);
            color: white;
            border: none;
            padding: 12px 28px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(226,55,68,0.3);
        }

        .btn-order-now:hover {
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(226,55,68,0.4);
        }

        /* Order card styles */
        .order-history-card {
            background: white;
            border-radius: 18px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.07);
            margin-bottom: 20px;
            overflow: hidden;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border: 1px solid rgba(0,0,0,0.04);
        }

        .order-history-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        }

        .order-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 24px;
            background: linear-gradient(to right, #fafafa, #fff);
            border-bottom: 1px solid #f0f0f0;
            flex-wrap: wrap;
            gap: 10px;
        }

        .order-id-badge {
            font-weight: 700;
            font-size: 1rem;
            color: #E23744;
        }

        .completed-badge {
            background: linear-gradient(135deg, rgba(39,174,96,0.12), rgba(39,174,96,0.08));
            color: #27ae60;
            font-weight: 600;
            font-size: 0.78rem;
            padding: 5px 14px;
            border-radius: 50px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            border: 1px solid rgba(39,174,96,0.2);
        }

        .order-card-body {
            padding: 20px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
        }

        .order-detail-group {
            display: flex;
            gap: 32px;
            flex-wrap: wrap;
        }

        .order-detail-item {
            display: flex;
            flex-direction: column;
        }

        .order-detail-label {
            font-size: 0.72rem;
            color: #a0aec0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
            margin-bottom: 3px;
        }

        .order-detail-value {
            font-size: 0.95rem;
            font-weight: 600;
            color: #2d3748;
        }

        .order-total-value {
            font-size: 1.1rem;
            font-weight: 700;
            color: #E23744;
        }

        .btn-view-details {
            background: linear-gradient(135deg, #E23744, #FF6B35);
            color: white;
            border: none;
            padding: 9px 22px;
            border-radius: 50px;
            font-size: 0.87rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .btn-view-details:hover {
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(226,55,68,0.35);
        }

        .order-seller-info {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85rem;
            color: #718096;
            margin-top: 6px;
        }

        .order-seller-info i {
            color: #E23744;
            font-size: 0.8rem;
        }

        .section-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #718096;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-label::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e2e8f0;
        }

        @media (max-width: 576px) {
            .order-card-header {
                padding: 14px 16px;
            }
            .order-card-body {
                padding: 16px;
            }
            .order-detail-group {
                gap: 16px;
            }
            .history-hero h1 {
                font-size: 1.7rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <header class="navbar-main">
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <a href="{{ route('home') }}">
                        @include('components.logo')
                    </a>
                </div>
                <div class="nav-links">
                    <a href="{{ route('home') }}" class="nav-link">Home</a>
                    <a href="{{ route('order.all') }}" class="nav-link">
                        <i class="fas fa-box"></i> My Orders
                    </a>
                    <a href="{{ route('order.history') }}" class="nav-link active">
                        <i class="fas fa-history"></i> Order History
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero -->
    <div class="history-hero">
        <div class="container">
            <div class="hero-icon"><i class="fas fa-history"></i></div>
            <h1>Order History</h1>
            <p>All your completed orders in one place</p>
            <div class="history-stats">
                <div class="history-stat">
                    <div class="stat-val">{{ $orders->count() }}</div>
                    <div class="stat-lbl">Completed Orders</div>
                </div>
                <div class="history-stat">
                    <div class="stat-val">{{ number_format($orders->sum('total_amount'), 0) }} <small style="font-size:0.65rem">PKR</small></div>
                    <div class="stat-lbl">Total Spent</div>
                </div>
                <div class="history-stat">
                    <div class="stat-val">{{ $orders->sum(fn($o) => $o->orderItems ? $o->orderItems->count() : 0) }}</div>
                    <div class="stat-lbl">Items Ordered</div>
                </div>
            </div>
        </div>
    </div>

    <div class="container orders-container">

        @if($orders->isEmpty())
            <div class="empty-history">
                <div class="empty-icon">
                    <i class="fas fa-receipt"></i>
                </div>
                <h4>No Completed Orders Yet</h4>
                <p>Your completed orders will appear here once a seller marks them as completed.</p>
                <a href="{{ route('home') }}" class="btn-order-now">
                    <i class="fas fa-utensils"></i> Browse Sellers
                </a>
            </div>
        @else
            <div class="section-label">{{ $orders->count() }} Completed Order{{ $orders->count() !== 1 ? 's' : '' }}</div>

            @foreach($orders as $order)
                <div class="order-history-card">
                    <div class="order-card-header">
                        <div>
                            <div class="order-id-badge"># Order {{ $order->id }}</div>
                            @if($order->seller)
                                <div class="order-seller-info">
                                    <i class="fas fa-store"></i>
                                    {{ $order->seller->name ?? 'N/A' }}
                                </div>
                            @endif
                        </div>
                        <div class="d-flex align-items-center gap-3 flex-wrap">
                            <span class="completed-badge">
                                <i class="bi bi-check-circle-fill"></i> Completed
                            </span>
                            <span style="font-size:0.82rem; color:#a0aec0;">
                                <i class="fas fa-calendar-check me-1"></i>
                                {{ $order->updated_at->format('d M Y, h:i A') }}
                            </span>
                        </div>
                    </div>

                    <div class="order-card-body">
                        <div class="order-detail-group">
                            <div class="order-detail-item">
                                <span class="order-detail-label">Items</span>
                                <span class="order-detail-value">{{ $order->orderItems ? $order->orderItems->count() : 0 }} item{{ ($order->orderItems && $order->orderItems->count() !== 1) ? 's' : '' }}</span>
                            </div>
                            <div class="order-detail-item">
                                <span class="order-detail-label">Total Paid</span>
                                <span class="order-total-value">{{ number_format($order->total_amount, 0) }} PKR</span>
                            </div>
                            <div class="order-detail-item">
                                <span class="order-detail-label">Ordered On</span>
                                <span class="order-detail-value">{{ $order->created_at->format('d M Y') }}</span>
                            </div>
                            <div class="order-detail-item">
                                <span class="order-detail-label">Address</span>
                                <span class="order-detail-value" title="{{ $order->address }}">
                                    {{ Str::limit($order->address, 25) }}
                                </span>
                            </div>
                        </div>
                        <a href="{{ route('order.track', $order) }}" class="btn-view-details">
                            <i class="fas fa-eye"></i> View Details
                        </a>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <!-- Footer -->
    <footer style="background:#1a202c; color:#a0aec0; padding: 24px 0; text-align:center; font-size:0.88rem;">
        <div class="container">
            <p class="mb-0">&copy; 2026 Tiffin Time. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
