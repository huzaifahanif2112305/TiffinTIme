<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Earnings Dashboard | Tiffin Time</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <style>
        :root {
            --primary: #E23744;
            --primary-dark: #cc222e;
            --secondary: #FF6B35;
            --gradient: linear-gradient(135deg, #E23744 0%, #FF6B35 100%);
            --dark: #1c1c1c;
            --light: #f3f4f6;
            --card-shadow: 0 10px 30px -10px rgba(0,0,0,0.1);
            --hover-shadow: 0 20px 40px -15px rgba(0,0,0,0.15);
            --border-radius: 18px;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f3f4f6;
            color: var(--dark);
            overflow-x: hidden;
        }

        /* ===== NAVBAR ===== */
        .navbar-custom {
            background: rgba(255,255,255,0.97);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0,0,0,0.05);
            padding: 1rem 0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.04);
            z-index: 1000;
        }
        .navbar-brand {
            display: flex; align-items: center; gap: 12px;
            font-weight: 700; font-size: 1.4rem; color: var(--primary) !important;
        }
        .brand-icon {
            width: 42px; height: 42px; background: var(--gradient);
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            color: white; font-size: 1.1rem;
            box-shadow: 0 4px 12px rgba(226,55,68,0.3);
        }
        .nav-link-custom {
            font-weight: 500; color: #4b5563;
            padding: 8px 16px; border-radius: 12px;
            transition: all 0.25s; text-decoration: none;
            display: inline-flex; align-items: center; gap: 7px;
            font-size: 0.93rem;
        }
        .nav-link-custom:hover, .nav-link-custom.active {
            color: var(--primary);
            background: rgba(226,55,68,0.08);
        }

        /* ===== HERO BANNER ===== */
        .earnings-hero {
            background: var(--gradient);
            padding: 110px 0 50px;
            position: relative;
            overflow: hidden;
        }
        .earnings-hero::before {
            content: '';
            position: absolute; inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Ccircle cx='40' cy='40' r='40'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            background-size: 80px;
        }
        .hero-inner { position: relative; z-index: 2; }
        .hero-label {
            display: inline-flex; align-items: center; gap: 8px;
            background: rgba(255,255,255,0.2); border: 1px solid rgba(255,255,255,0.35);
            color: white; padding: 6px 16px; border-radius: 50px;
            font-size: 0.85rem; font-weight: 600; margin-bottom: 14px;
        }
        .hero-title {
            font-size: 2.6rem; font-weight: 800; color: white; margin-bottom: 6px;
        }
        .hero-subtitle { color: rgba(255,255,255,0.82); font-size: 1.05rem; }

        /* ===== KPI CARDS ===== */
        .kpi-row { margin-top: -40px; position: relative; z-index: 10; }
        .kpi-card {
            background: white; border-radius: var(--border-radius);
            padding: 1.6rem 1.8rem;
            box-shadow: var(--card-shadow);
            border: 1px solid rgba(0,0,0,0.03);
            transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
            height: 100%;
            position: relative; overflow: hidden;
        }
        .kpi-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--hover-shadow);
        }
        .kpi-card::after {
            content: '';
            position: absolute; bottom: 0; left: 0; right: 0;
            height: 4px;
            border-radius: 0 0 var(--border-radius) var(--border-radius);
        }
        .kpi-card.red::after   { background: linear-gradient(90deg, #E23744, #FF6B35); }
        .kpi-card.green::after { background: linear-gradient(90deg, #10b981, #34d399); }
        .kpi-card.blue::after  { background: linear-gradient(90deg, #3b82f6, #60a5fa); }
        .kpi-card.purple::after{ background: linear-gradient(90deg, #8b5cf6, #a78bfa); }
        .kpi-card.amber::after { background: linear-gradient(90deg, #f59e0b, #fbbf24); }

        .kpi-icon {
            width: 52px; height: 52px; border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.3rem; margin-bottom: 1.1rem;
        }
        .icon-red    { background: rgba(226,55,68,0.1);  color: var(--primary); }
        .icon-green  { background: rgba(16,185,129,0.1); color: #059669; }
        .icon-blue   { background: rgba(59,130,246,0.1); color: #2563eb; }
        .icon-purple { background: rgba(139,92,246,0.1); color: #7c3aed; }
        .icon-amber  { background: rgba(245,158,11,0.1); color: #b45309; }

        .kpi-value {
            font-size: 1.95rem; font-weight: 800; color: var(--dark);
            line-height: 1; margin-bottom: 5px;
        }
        .kpi-label { color: #6b7280; font-size: 0.9rem; font-weight: 500; }
        .kpi-sub   { font-size: 0.78rem; color: #9ca3af; margin-top: 6px; }
        .kpi-badge {
            position: absolute; top: 1.3rem; right: 1.3rem;
            font-size: 0.75rem; font-weight: 600;
            padding: 3px 9px; border-radius: 50px;
        }
        .badge-up   { background: #dcfce7; color: #15803d; }
        .badge-down { background: #fee2e2; color: #b91c1c; }

        /* ===== SECTION HEADER ===== */
        .section-header {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 1.4rem;
        }
        .section-title {
            font-size: 1.3rem; font-weight: 700;
            display: flex; align-items: center; gap: 12px;
        }
        .section-title::before {
            content: ''; display: block; width: 5px; height: 24px;
            background: var(--gradient); border-radius: 3px;
        }

        /* ===== CHART CARD ===== */
        .chart-card {
            background: white; border-radius: var(--border-radius);
            padding: 1.8rem; box-shadow: var(--card-shadow);
            height: 100%;
            border: 1px solid rgba(0,0,0,0.03);
        }
        .chart-card-header {
            display: flex; justify-content: space-between; align-items: flex-start;
            margin-bottom: 1.5rem; flex-wrap: wrap; gap: 10px;
        }
        .chart-card-title {
            font-size: 1rem; font-weight: 700; color: var(--dark);
        }
        .chart-card-subtitle {
            font-size: 0.8rem; color: #9ca3af; margin-top: 2px;
        }

        /* ===== TAB PILLS ===== */
        .period-tabs {
            display: flex; gap: 6px; flex-wrap: wrap;
        }
        .period-tab {
            padding: 5px 14px; border-radius: 50px; border: 1px solid #e5e7eb;
            font-size: 0.8rem; font-weight: 600; cursor: pointer;
            background: white; color: #6b7280;
            transition: all 0.2s;
        }
        .period-tab:hover { border-color: var(--primary); color: var(--primary); }
        .period-tab.active {
            background: var(--gradient); color: white;
            border-color: transparent;
            box-shadow: 0 4px 12px rgba(226,55,68,0.3);
        }

        /* ===== EARNINGS TABLE ===== */
        .earnings-table-card {
            background: white; border-radius: var(--border-radius);
            padding: 1.8rem; box-shadow: var(--card-shadow);
            border: 1px solid rgba(0,0,0,0.03);
        }
        .earnings-table { width: 100%; border-collapse: collapse; }
        .earnings-table thead th {
            background: #fafafa;
            padding: 12px 16px;
            font-size: 0.78rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.5px;
            color: #9ca3af; border-bottom: 2px solid #f0f0f0;
        }
        .earnings-table tbody td {
            padding: 14px 16px;
            font-size: 0.9rem; color: var(--dark);
            border-bottom: 1px solid #f9fafb;
            vertical-align: middle;
        }
        .earnings-table tbody tr:last-child td { border-bottom: none; }
        .earnings-table tbody tr:hover td { background: #fffbfb; }
        .amount-positive { color: #059669; font-weight: 700; }
        .status-pill {
            padding: 4px 12px; border-radius: 50px; font-size: 0.75rem; font-weight: 600;
        }
        .pill-completed { background: #dcfce7; color: #15803d; }
        .pill-delivered { background: #dbeafe; color: #1d4ed8; }

        /* ===== QUARTER CARDS ===== */
        .quarter-card {
            background: white; border-radius: var(--border-radius);
            padding: 1.4rem 1.6rem; box-shadow: var(--card-shadow);
            border: 1px solid rgba(0,0,0,0.03);
            text-align: center; transition: all 0.3s;
        }
        .quarter-card:hover { transform: translateY(-4px); box-shadow: var(--hover-shadow); }
        .quarter-label {
            font-size: 0.78rem; font-weight: 700; text-transform: uppercase;
            letter-spacing: 1px; color: #9ca3af; margin-bottom: 8px;
        }
        .quarter-amount {
            font-size: 1.5rem; font-weight: 800; color: var(--dark);
        }
        .quarter-orders { font-size: 0.78rem; color: #9ca3af; margin-top: 4px; }
        .quarter-bar {
            height: 6px; background: #f3f4f6; border-radius: 3px; margin-top: 12px; overflow: hidden;
        }
        .quarter-fill { height: 100%; border-radius: 3px; background: var(--gradient); }

        /* ===== EMPTY STATE ===== */
        .empty-chart {
            display: flex; flex-direction: column; align-items: center;
            justify-content: center; padding: 3rem; text-align: center;
        }
        .empty-chart i { font-size: 3rem; color: #d1d5db; margin-bottom: 1rem; }
        .empty-chart p { color: #9ca3af; font-size: 0.9rem; }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .hero-title { font-size: 1.9rem; }
            .kpi-value { font-size: 1.5rem; }
        }
    </style>
</head>
<body>

<!-- ===== NAVBAR ===== -->
<nav class="navbar navbar-expand-lg navbar-custom fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('seller.panel') }}">
            <div class="brand-icon"><i class="fas fa-utensils"></i></div>
            <span>Tiffin Time <small class="text-muted fw-normal" style="font-size:0.85rem;">Partner</small></span>
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navContent">
            <span class="fa fa-bars text-dark"></span>
        </button>

        <div class="collapse navbar-collapse" id="navContent">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-2">
                <li class="nav-item">
                    <a class="nav-link-custom" href="{{ route('seller.panel') }}">
                        <i class="fas fa-th-large"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link-custom" href="{{ route('add.service') }}">
                        <i class="fas fa-plus-circle"></i> Add Menu
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link-custom active" href="{{ route('seller.earnings') }}">
                        <i class="fas fa-chart-line"></i> Earnings
                    </a>
                </li>
                <li class="nav-item">
                    <form action="{{ route('logout.seller') }}" method="POST" class="d-inline">
                        @csrf
                        <button class="nav-link-custom border-0 bg-transparent" style="color:#dc2626;">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- ===== HERO ===== -->
<div class="earnings-hero">
    <div class="container hero-inner">
        <div class="hero-label"><i class="fas fa-coins"></i> Earnings Dashboard</div>
        <h1 class="hero-title">Your Earnings</h1>
        <p class="hero-subtitle">Complete financial overview — daily, weekly, monthly, quarterly & yearly</p>
    </div>
</div>

<!-- ===== MAIN CONTENT ===== -->
<div class="container pb-5">

    <!-- ===== KPI CARDS ===== -->
    <div class="row g-4 kpi-row mb-5" data-aos="fade-up">
        <div class="col-6 col-md-4 col-lg">
            <div class="kpi-card red">
                <div class="kpi-icon icon-red"><i class="fas fa-wallet"></i></div>
                <div class="kpi-value">{{ number_format($totalEarnings, 0) }}</div>
                <div class="kpi-label">Total Earnings (PKR)</div>
                <div class="kpi-sub">All completed orders</div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg">
            <div class="kpi-card green">
                <div class="kpi-icon icon-green"><i class="fas fa-calendar-day"></i></div>
                <div class="kpi-value">{{ number_format($todayEarnings, 0) }}</div>
                <div class="kpi-label">Today (PKR)</div>
                <div class="kpi-sub">{{ now()->format('d M Y') }}</div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg">
            <div class="kpi-card blue">
                <div class="kpi-icon icon-blue"><i class="fas fa-calendar-week"></i></div>
                <div class="kpi-value">{{ number_format($weekEarnings, 0) }}</div>
                <div class="kpi-label">This Week (PKR)</div>
                <div class="kpi-sub">Last 7 days</div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg">
            <div class="kpi-card purple">
                <div class="kpi-icon icon-purple"><i class="fas fa-calendar-alt"></i></div>
                <div class="kpi-value">{{ number_format($monthEarnings, 0) }}</div>
                <div class="kpi-label">This Month (PKR)</div>
                <div class="kpi-sub">{{ now()->format('F Y') }}</div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg">
            <div class="kpi-card amber">
                <div class="kpi-icon icon-amber"><i class="fas fa-star"></i></div>
                <div class="kpi-value">{{ $completedOrdersCount }}</div>
                <div class="kpi-label">Completed Orders</div>
                <div class="kpi-sub">All time</div>
            </div>
        </div>
    </div>

    <!-- ===== MAIN CHART — PERIOD SELECTOR ===== -->
    <div class="row g-4 mb-4">
        <div class="col-12" data-aos="fade-up">
            <div class="chart-card">
                <div class="chart-card-header">
                    <div>
                        <div class="chart-card-title">Earnings Overview</div>
                        <div class="chart-card-subtitle">Revenue trend over selected period</div>
                    </div>
                    <div class="period-tabs">
                        <span class="period-tab active" onclick="switchChart(this, 'daily')">Daily</span>
                        <span class="period-tab" onclick="switchChart(this, 'weekly')">Weekly</span>
                        <span class="period-tab" onclick="switchChart(this, 'monthly')">Monthly</span>
                        <span class="period-tab" onclick="switchChart(this, 'quarterly')">Quarterly</span>
                        <span class="period-tab" onclick="switchChart(this, 'yearly')">Yearly</span>
                    </div>
                </div>
                <div style="position: relative; height: 320px;">
                    <canvas id="mainEarningsChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== QUARTERLY BREAKDOWN + PIE CHART ===== -->
    <div class="row g-4 mb-4">
        <!-- Quarterly Cards -->
        <div class="col-lg-7" data-aos="fade-up" data-aos-delay="100">
            <div class="chart-card h-100">
                <div class="chart-card-header mb-3">
                    <div>
                        <div class="chart-card-title">Quarterly Breakdown</div>
                        <div class="chart-card-subtitle">{{ now()->year }} earnings by quarter</div>
                    </div>
                </div>
                <div class="row g-3">
                    @php
                        $maxQ = max(array_values($quarterlyEarnings)) ?: 1;
                    @endphp
                    @foreach(['Q1','Q2','Q3','Q4'] as $qi => $q)
                        @php
                            $qAmt   = $quarterlyEarnings[$q] ?? 0;
                            $qCount = $quarterlyOrders[$q] ?? 0;
                            $pct    = $maxQ > 0 ? ($qAmt / $maxQ) * 100 : 0;
                            $qMonths = [['Jan','Feb','Mar'],['Apr','May','Jun'],['Jul','Aug','Sep'],['Oct','Nov','Dec']][$qi];
                        @endphp
                        <div class="col-6">
                            <div class="quarter-card">
                                <div class="quarter-label">{{ $q }} &middot; {{ implode(', ', $qMonths) }}</div>
                                <div class="quarter-amount">{{ number_format($qAmt, 0) }} <small style="font-size:0.65rem;font-weight:600;color:#9ca3af;">PKR</small></div>
                                <div class="quarter-orders">{{ $qCount }} order{{ $qCount != 1 ? 's' : '' }}</div>
                                <div class="quarter-bar">
                                    <div class="quarter-fill" style="width: {{ $pct }}%;"></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Earnings Donut -->
        <div class="col-lg-5" data-aos="fade-up" data-aos-delay="200">
            <div class="chart-card h-100">
                <div class="chart-card-header">
                    <div>
                        <div class="chart-card-title">Payment Method Split</div>
                        <div class="chart-card-subtitle">Cash vs Online</div>
                    </div>
                </div>
                <div style="position:relative; height:230px; display:flex; align-items:center; justify-content:center;">
                    <canvas id="paymentPieChart"></canvas>
                </div>
                <div class="d-flex justify-content-center gap-4 mt-3">
                    <div class="d-flex align-items-center gap-2">
                        <span style="width:12px;height:12px;background:#E23744;border-radius:3px;display:inline-block;"></span>
                        <span style="font-size:0.82rem;color:#6b7280;">Cash on Delivery</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span style="width:12px;height:12px;background:#3b82f6;border-radius:3px;display:inline-block;"></span>
                        <span style="font-size:0.82rem;color:#6b7280;">Online Payment</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== MONTHLY BAR CHART ===== -->
    <div class="row g-4 mb-4">
        <div class="col-12" data-aos="fade-up">
            <div class="chart-card">
                <div class="chart-card-header">
                    <div>
                        <div class="chart-card-title">Monthly Earnings — {{ now()->year }}</div>
                        <div class="chart-card-subtitle">Full-year month-by-month revenue</div>
                    </div>
                </div>
                <div style="position: relative; height: 260px;">
                    <canvas id="monthlyBarChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== COMPLETED ORDERS TABLE ===== -->
    <div class="row g-4 mb-4">
        <div class="col-12" data-aos="fade-up">
            <div class="earnings-table-card">
                <div class="section-header">
                    <div class="section-title">Completed Orders</div>
                    <span class="badge rounded-pill" style="background:rgba(226,55,68,0.1);color:var(--primary);font-weight:600;font-size:0.8rem;padding:6px 14px;">
                        {{ $completedOrders->count() }} total
                    </span>
                </div>

                @if($completedOrders->isEmpty())
                    <div class="empty-chart">
                        <i class="fas fa-receipt"></i>
                        <p>No completed orders yet. Keep going!</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="earnings-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Customer</th>
                                    <th>Date</th>
                                    <th>Items</th>
                                    <th>Payment</th>
                                    <th>Status</th>
                                    <th class="text-end">Amount (PKR)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($completedOrders as $order)
                                    <tr>
                                        <td><span style="font-weight:700;color:var(--primary);">#{{ $order->id }}</span></td>
                                        <td>
                                            <div style="font-weight:600;font-size:0.88rem;">{{ $order->user->name ?? 'Unknown' }}</div>
                                            <div style="font-size:0.75rem;color:#9ca3af;">{{ $order->user->email ?? '' }}</div>
                                        </td>
                                        <td>
                                            <div style="font-size:0.87rem;">{{ $order->updated_at->format('d M Y') }}</div>
                                            <div style="font-size:0.75rem;color:#9ca3af;">{{ $order->updated_at->format('h:i A') }}</div>
                                        </td>
                                        <td>
                                            <span style="font-weight:600;font-size:0.87rem;">{{ $order->orderItems->count() }} item{{ $order->orderItems->count() != 1 ? 's' : '' }}</span>
                                        </td>
                                        <td>
                                            @if($order->transaction_id)
                                                <span class="status-pill" style="background:#dbeafe;color:#1d4ed8;">Online</span>
                                            @else
                                                <span class="status-pill" style="background:#f3f4f6;color:#4b5563;">Cash</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="status-pill pill-completed">
                                                <i class="fas fa-check-circle me-1" style="font-size:0.7rem;"></i>Completed
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <span class="amount-positive">{{ number_format($order->total_amount, 0) }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6" style="padding:14px 16px;font-weight:700;font-size:0.88rem;background:#fafafa;border-top:2px solid #f0f0f0;">
                                        Total Earnings
                                    </td>
                                    <td class="text-end" style="padding:14px 16px;background:#fafafa;border-top:2px solid #f0f0f0;">
                                        <span style="color:var(--primary);font-weight:800;font-size:1rem;">
                                            {{ number_format($completedOrders->sum('total_amount'), 0) }}
                                        </span>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

</div><!-- /container -->

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
AOS.init({ duration: 700, once: true, offset: 40 });

// =========================================================
// DATA FROM BLADE (passed as PHP → JS)
// =========================================================
const dailyData    = @json($dailyData);
const weeklyData   = @json($weeklyData);
const monthlyData  = @json($monthlyData);
const quarterData  = @json($quarterlyEarnings);
const yearlyData   = @json($yearlyData);
const cashAmt      = {{ $cashEarnings }};
const onlineAmt    = {{ $onlineEarnings }};

// =========================================================
// CHART DEFAULTS
// =========================================================
Chart.defaults.font.family = "'Poppins', sans-serif";
Chart.defaults.color = '#9ca3af';

const red     = '#E23744';
const orange  = '#FF6B35';
const gradFn  = (ctx, colors) => {
    const g = ctx.createLinearGradient(0, 0, 0, 300);
    g.addColorStop(0, colors[0]);
    g.addColorStop(1, colors[1]);
    return g;
};

// =========================================================
// MAIN CHART (period switcher)
// =========================================================
let mainChart;

function buildMainChart(period) {
    let labels, data;
    if (period === 'daily') {
        labels = dailyData.map(d => d.label);
        data   = dailyData.map(d => d.amount);
    } else if (period === 'weekly') {
        labels = weeklyData.map(d => d.label);
        data   = weeklyData.map(d => d.amount);
    } else if (period === 'monthly') {
        labels = monthlyData.map(d => d.label);
        data   = monthlyData.map(d => d.amount);
    } else if (period === 'quarterly') {
        labels = ['Q1 (Jan-Mar)', 'Q2 (Apr-Jun)', 'Q3 (Jul-Sep)', 'Q4 (Oct-Dec)'];
        data   = [quarterData.Q1||0, quarterData.Q2||0, quarterData.Q3||0, quarterData.Q4||0];
    } else {
        labels = yearlyData.map(d => d.label);
        data   = yearlyData.map(d => d.amount);
    }

    const ctx = document.getElementById('mainEarningsChart').getContext('2d');

    if (mainChart) mainChart.destroy();

    mainChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels,
            datasets: [{
                label: 'Earnings (PKR)',
                data,
                borderColor: red,
                borderWidth: 3,
                tension: 0.4,
                pointBackgroundColor: red,
                pointRadius: 4,
                pointHoverRadius: 7,
                fill: true,
                backgroundColor: (context) => {
                    const chart = context.chart;
                    const {ctx: c, chartArea} = chart;
                    if (!chartArea) return 'transparent';
                    const g = c.createLinearGradient(0, chartArea.top, 0, chartArea.bottom);
                    g.addColorStop(0, 'rgba(226,55,68,0.18)');
                    g.addColorStop(1, 'rgba(255,107,53,0.01)');
                    return g;
                }
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: { intersect: false, mode: 'index' },
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1c1c1c',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    padding: 12,
                    callbacks: {
                        label: ctx => ` PKR ${ctx.parsed.y.toLocaleString()}`
                    }
                }
            },
            scales: {
                x: { grid: { display: false }, ticks: { maxTicksLimit: 12 } },
                y: {
                    grid: { color: '#f3f4f6' },
                    title: { display: true, text: 'PKR', color: '#9ca3af', font: { size: 11 } },
                    ticks: { callback: v => v.toLocaleString() }
                }
            }
        }
    });
}

function switchChart(el, period) {
    document.querySelectorAll('.period-tab').forEach(t => t.classList.remove('active'));
    el.classList.add('active');
    buildMainChart(period);
}

buildMainChart('daily');

// =========================================================
// PAYMENT PIE CHART
// =========================================================
new Chart(document.getElementById('paymentPieChart').getContext('2d'), {
    type: 'doughnut',
    data: {
        labels: ['Cash on Delivery', 'Online Payment'],
        datasets: [{
            data: [cashAmt, onlineAmt],
            backgroundColor: ['#E23744', '#3b82f6'],
            borderWidth: 3,
            borderColor: '#fff',
            hoverOffset: 8
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        cutout: '70%',
        plugins: {
            legend: { display: false },
            tooltip: {
                backgroundColor: '#1c1c1c',
                callbacks: {
                    label: ctx => ` PKR ${ctx.parsed.toLocaleString()}`
                }
            }
        }
    }
});

// =========================================================
// MONTHLY BAR CHART
// =========================================================
new Chart(document.getElementById('monthlyBarChart').getContext('2d'), {
    type: 'bar',
    data: {
        labels: monthlyData.map(d => d.label),
        datasets: [{
            label: 'Monthly Earnings (PKR)',
            data: monthlyData.map(d => d.amount),
            borderRadius: 8,
            borderSkipped: false,
            backgroundColor: (ctx) => {
                const index = ctx.dataIndex;
                const chart = ctx.chart;
                const {chartArea, c} = chart;
                const g = chart.ctx.createLinearGradient(0, chartArea ? chartArea.top : 0, 0, chartArea ? chartArea.bottom : 300);
                g.addColorStop(0, '#E23744');
                g.addColorStop(1, '#FF6B35');
                return g;
            },
            hoverBackgroundColor: '#cc222e',
            maxBarThickness: 42
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false },
            tooltip: {
                backgroundColor: '#1c1c1c',
                callbacks: { label: ctx => ` PKR ${ctx.parsed.y.toLocaleString()}` }
            }
        },
        scales: {
            x: { grid: { display: false } },
            y: {
                grid: { color: '#f3f4f6' },
                ticks: { callback: v => v.toLocaleString() }
            }
        }
    }
});
</script>
</body>
</html>
