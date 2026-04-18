<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Seller Dashboard | Tiffin Time</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
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
            --card-shadow: 0 10px 30px -10px rgba(0,0,0,0.1);
            --hover-shadow: 0 20px 40px -15px rgba(0,0,0,0.15);
            --glass-bg: rgba(255, 255, 255, 0.95);
            --glass-border: 1px solid rgba(255, 255, 255, 0.18);
            --border-radius: 16px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f3f4f6;
            color: var(--dark);
            overflow-x: hidden;
        }

        /* Modern Navbar */
        .navbar-custom {
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0,0,0,0.05);
            padding: 1rem 0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
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

        .nav-link:hover, .nav-link.active {
            color: var(--primary) !important;
            background: rgba(226, 55, 68, 0.08);
        }

        .notification-btn {
            position: relative;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: white;
            border: 1px solid #e5e7eb;
            color: #4b5563;
            transition: all 0.3s;
        }

        .notification-btn:hover {
            color: var(--primary);
            border-color: var(--primary);
            transform: translateY(-2px);
        }

        .badge-pulse {
            position: absolute;
            top: 0;
            right: 0;
            background: var(--primary);
            border: 2px solid white;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(226, 55, 68, 0.4); }
            70% { box-shadow: 0 0 0 10px rgba(226, 55, 68, 0); }
            100% { box-shadow: 0 0 0 0 rgba(226, 55, 68, 0); }
        }

        /* Dashboard Hero */
        .dashboard-hero {
            margin-top: 100px;
            background: white;
            border-radius: 24px;
            padding: 2.5rem;
            position: relative;
            overflow: hidden;
            box-shadow: var(--card-shadow);
            margin-bottom: 2rem;
            background-image: url('https://img.freepik.com/free-vector/white-abstract-background-design_23-2148825582.jpg');
            background-size: cover;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .welcome-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(226, 55, 68, 0.1);
            color: var(--primary);
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Stats Cards */
        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 1.5rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(0,0,0,0.03);
            height: 100%;
            position: relative;
            overflow: hidden;
            box-shadow: var(--card-shadow);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--hover-shadow);
            border-color: rgba(226, 55, 68, 0.2);
        }

        .stat-icon-wrapper {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1.2rem;
        }

        .bg-gradient-red { background: linear-gradient(135deg, #FFE5E7 0%, #fff1f2 100%); color: var(--primary); }
        .bg-gradient-orange { background: linear-gradient(135deg, #FFF3E0 0%, #fff7ed 100%); color: var(--secondary); }
        .bg-gradient-yellow { background: linear-gradient(135deg, #FFF9C4 0%, #fffde7 100%); color: #FBC02D; }

        .stat-value {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--dark);
            line-height: 1;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: #6b7280;
            font-weight: 500;
            font-size: 1rem;
        }

        .stat-trend {
            position: absolute;
            top: 2rem;
            right: 2rem;
            font-size: 0.85rem;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 20px;
        }

        .trend-up { background: #dcfce7; color: #166534; }

        /* Section Headers */
        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .section-title::before {
            content: '';
            display: block;
            width: 6px;
            height: 28px;
            background: var(--gradient);
            border-radius: 4px;
        }

        /* Menu/Service Cards */
        .menu-card {
            background: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
            height: 100%;
            border: 1px solid transparent;
        }

        .menu-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--hover-shadow);
            border-color: var(--secondary);
        }

        .menu-img-container {
            position: relative;
            height: 200px;
            overflow: hidden;
        }

        .menu-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .menu-card:hover .menu-img {
            transform: scale(1.1);
        }

        .price-badge {
            position: absolute;
            bottom: 12px;
            right: 12px;
            background: white;
            padding: 6px 14px;
            border-radius: 50px;
            font-weight: 700;
            color: var(--dark);
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .menu-body {
            padding: 1.25rem;
        }

        .menu-title {
            font-size: 1.15rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--dark);
        }

        .menu-actions {
            display: flex;
            gap: 8px;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #f3f4f6;
        }

        .btn-action {
            flex: 1;
            padding: 8px;
            font-size: 0.9rem;
            border-radius: 8px;
            border: none;
            font-weight: 500;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .btn-edit { background: #f3f4f6; color: var(--dark); }
        .btn-edit:hover { background: #e5e7eb; }
        
        .btn-delete { background: #fee2e2; color: #dc2626; }
        .btn-delete:hover { background: #fecaca; }

        /* Modern Table */
        .custom-table-card {
            background: white;
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: var(--card-shadow);
            overflow: hidden;
        }

        .table-custom {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 12px;
        }

        .table-custom th {
            font-weight: 600;
            color: #6b7280;
            font-size: 0.85rem;
            text-transform: uppercase;
            padding: 0 1rem;
            letter-spacing: 0.5px;
        }

        .table-custom tr {
            transition: transform 0.2s;
        }

        .table-row-bg {
            background: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.02);
            border-radius: 12px;
            td:first-child { border-top-left-radius: 12px; border-bottom-left-radius: 12px; }
            td:last-child { border-top-right-radius: 12px; border-bottom-right-radius: 12px; }
        }

        .table-custom td {
            padding: 1.2rem 1rem;
            vertical-align: middle;
            background: #fcfcfc;
            border-top: 1px solid #f0f0f0;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .table-custom tr td:first-child { border-left: 1px solid #f0f0f0; }
        .table-custom tr td:last-child { border-right: 1px solid #f0f0f0; }

        .table-custom tr:hover td {
            background: #fffafa;
            border-top-color: #fee2e2;
            border-bottom-color: #fee2e2;
        }
        
        .table-custom tr:hover td:first-child { border-left-color: #fee2e2; }
        .table-custom tr:hover td:last-child { border-right-color: #fee2e2; }

        .status-badge {
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .status-pending { background: #fff7ed; color: #c2410c; }
        .status-accepted { background: #eff6ff; color: #1d4ed8; }
        .status-completed { background: #f0fdf4; color: #15803d; }
        .status-cancelled { background: #fef2f2; color: #b91c1c; }

        .btn-gradient {
            background: var(--gradient);
            color: white;
            border: none;
            padding: 10px 24px;
            border-radius: 12px;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(226, 55, 68, 0.3);
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(226, 55, 68, 0.4);
            color: white;
        }

        /* Animations */
        .fade-in-up {
            animation: fadeInUp 0.6s cubic-bezier(0.2, 0.8, 0.2, 1);
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsive */
        @media (max-width: 991px) {
            .navbar-collapse {
                background: white;
                padding: 1rem;
                border-radius: 12px;
                margin-top: 1rem;
                box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            }
        }
    </style>
</head>
<body>

    <!-- Premium Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('seller.panel') }}">
                <div class="brand-icon">
                    <i class="fas fa-utensils"></i>
                </div>
                <span>Tiffin Time <small class="text-muted fw-normal fs-6">Partner</small></span>
            </a>
            
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="fa fa-bars text-dark"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-3">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('seller.panel') }}">
                            <i class="fas fa-grid-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('add.service') }}">
                            <i class="fas fa-plus-circle"></i> Add Menu
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('seller.earnings') }}">
                            <i class="fas fa-chart-line"></i> View Earnings
                        </a>
                    </li>
                    
                    <!-- Notification Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="notification-btn" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="far fa-bell"></i>
                            @if($notifications->isNotEmpty())
                                <span class="badge-pulse"></span>
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-3" style="width: 320px; border-radius: 16px;">
                            <li><h6 class="dropdown-header text-uppercase fw-bold text-muted small letter-spacing-1">Notifications</h6></li>
                            @forelse($notifications->take(5) as $notification)
                                <li>
                                    <div class="dropdown-item p-2 rounded-3 mb-1">
                                        <div class="d-flex gap-3">
                                            <div class="bg-light rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                                <i class="fas fa-info-circle text-primary"></i>
                                            </div>
                                            <div>
                                                <p class="mb-0 small fw-medium text-dark text-wrap">{{ $notification->data['message'] ?? 'New Notification' }}</p>
                                                <small class="text-muted" style="font-size: 0.7rem;">{{ $notification->created_at->diffForHumans() }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <li><p class="text-center text-muted small my-3">No new notifications</p></li>
                            @endforelse
                        </ul>
                    </li>

                    <!-- User Profile -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle border-0 bg-transparent p-0" href="#" role="button" data-bs-toggle="dropdown">
                            <div class="d-flex align-items-center gap-2">
                                <div class="bg-gradient-red rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" style="width: 40px; height: 40px; background: var(--gradient);">
                                    {{ substr(auth()->guard('seller')->user()->name, 0, 1) }}
                                </div>
                                <div class="d-none d-lg-block text-start">
                                    <span class="d-block fw-bold text-dark lh-1 small">{{ auth()->guard('seller')->user()->name }}</span>
                                    <span class="d-block text-muted small lh-1 mt-1">Status: Active</span>
                                </div>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-2" style="border-radius: 16px; min-width: 200px;">
                            @if(session('admin_id'))
                                <li>
                                    <form action="{{ route('admin.returnToAdmin') }}" method="POST">
                                        @csrf
                                        <button class="dropdown-item rounded-3 py-2 text-primary fw-medium"><i class="fas fa-user-shield me-2"></i> Return Admin</button>
                                    </form>
                                </li>
                            @endif
                            <li>
                                <form action="{{ route('logout.seller') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item rounded-3 py-2 text-danger fw-medium"><i class="fas fa-sign-out-alt me-2"></i> Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container pb-5">
        
        <!-- Welcome Hero -->
        <div class="dashboard-hero fade-in-up" data-aos="fade-up">
            <div class="row align-items-center">
                <div class="col-lg-8 hero-content">
                    @php $sellerVerif = auth()->guard('seller')->user()->verification; @endphp
                    <span class="welcome-badge"><i class="fas fa-award"></i> Premium Partner</span>
                    <h1 class="hero-title">
                        Welcome back, {{ auth()->guard('seller')->user()->name }}!
                        @if(auth()->guard('seller')->user()->isVerified())
                            <i class="fas fa-circle-check" style="color:#1d4ed8;font-size:1.5rem;margin-left:8px;vertical-align:middle;" title="Verified Seller"></i>
                        @endif
                    </h1>
                    <p class="text-muted fs-5 mb-4">Here's what's happening with your kitchen today.</p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="{{ route('add.service') }}" class="btn btn-gradient">
                            <i class="fas fa-plus"></i> Add New Menu
                        </a>
                        {{-- Verification Badge CTA --}}
                        @if(!$sellerVerif)
                            <a href="{{ route('seller.verification.form') }}" class="btn" style="background:rgba(255,255,255,.9);color:#E23744;border:1.5px solid #E23744;border-radius:12px;font-weight:600;padding:10px 22px;display:inline-flex;align-items:center;gap:8px;">
                                <i class="fas fa-shield-alt"></i> Get Verified Badge
                            </a>
                        @elseif($sellerVerif->status === 'pending')
                            <a href="{{ route('seller.verification.status') }}" class="btn" style="background:rgba(245,158,11,.12);color:#b45309;border:1.5px solid rgba(245,158,11,.4);border-radius:12px;font-weight:600;padding:10px 22px;display:inline-flex;align-items:center;gap:8px;">
                                <i class="fas fa-clock"></i> Verification Pending
                            </a>
                        @elseif($sellerVerif->status === 'approved')
                            <span class="btn" style="background:rgba(16,185,129,.12);color:#059669;border:1.5px solid rgba(16,185,129,.3);border-radius:12px;font-weight:600;padding:10px 22px;display:inline-flex;align-items:center;gap:8px;pointer-events:none;">
                                <i class="fas fa-check-circle"></i> ✅ Verified Seller
                            </span>
                        @elseif($sellerVerif->status === 'rejected')
                            <a href="{{ route('seller.verification.form') }}" class="btn" style="background:rgba(239,68,68,.08);color:#b91c1c;border:1.5px solid rgba(239,68,68,.3);border-radius:12px;font-weight:600;padding:10px 22px;display:inline-flex;align-items:center;gap:8px;">
                                <i class="fas fa-redo"></i> Reapply for Badge
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="row g-4 mb-5">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="stat-card">
                    <span class="stat-trend trend-up"><i class="fas fa-arrow-up"></i> +12%</span>
                    <div class="stat-icon-wrapper bg-gradient-red">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <div class="stat-value">{{ $services->count() }}</div>
                    <div class="stat-label">Active Menus</div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-card">
                    <span class="stat-trend trend-up"><i class="fas fa-arrow-up"></i> +5%</span>
                    <div class="stat-icon-wrapper bg-gradient-orange">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <div class="stat-value">{{ $orders->count() }}</div>
                    <div class="stat-label">Total Orders</div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-card">
                    <div class="stat-icon-wrapper bg-gradient-yellow">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="stat-value">{{ isset($rating) ? number_format($rating, 1) : '0.0' }}</div>
                    <div class="stat-label">Average Rating</div>
                </div>
            </div>
        </div>

        <!-- Services Section -->
        <div class="mb-5">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Your Menu Items</h2>
                <a href="{{ route('add.service') }}" class="btn btn-outline-dark btn-sm rounded-pill px-3">View All</a>
            </div>

            @if($services->isEmpty())
                <div class="text-center py-5 bg-white rounded-4 shadow-sm" data-aos="fade-up">
                    <img src="https://cdni.iconscout.com/illustration/premium/thumb/empty-state-2130362-1800926.png" alt="Empty" style="width: 200px; opacity: 0.7;">
                    <h4 class="mt-3">No Menus Yet</h4>
                    <p class="text-muted">Start by adding your delicious dishes to the menu.</p>
                    <a href="{{ route('add.service') }}" class="btn btn-gradient mt-2">Add First Menu</a>
                </div>
            @else
                <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
                    @foreach($services as $service)
                        <div class="col" data-aos="fade-up" data-aos-delay="100">
                            <div class="menu-card">
                                <div class="menu-img-container">
                                    <img src="{{ Storage::url($service->image) }}" alt="{{ $service->service_name }}" class="menu-img">
                                    <span class="price-badge">{{ $service->service_price }} PKR</span>
                                </div>
                                <div class="menu-body">
                                    <h3 class="menu-title text-truncate">{{ $service->service_name }}</h3>
                                    <p class="text-muted small mb-2"><i class="fas fa-tag me-1"></i> {{ $service->category ?? 'Tiffin' }}</p>

                                    <div class="menu-actions">
                                        <a href="{{ route('seller.editService', $service->id) }}" class="btn-action btn-edit">
                                            <i class="fas fa-pen"></i> Edit
                                        </a>
                                        <form action="{{ route('seller.deleteService', $service->id) }}" method="POST" class="d-inline flex-grow-1" style="flex:1;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete w-100" onclick="return confirm('Delete this item?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Orders Section -->
        <div class="mb-5">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Recent Orders</h2>
                <button class="btn btn-light btn-sm rounded-pill px-3"><i class="fas fa-filter me-1"></i> Filter</button>
            </div>

            <div class="custom-table-card" data-aos="fade-up">
                @if($orders->isEmpty())
                    <div class="text-center py-5">
                        <i class="fas fa-clipboard-list text-muted mb-3" style="font-size: 3rem;"></i>
                        <p class="text-muted">No orders received yet.</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table-custom">
                            <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>Customer</th>
                                    <th>Items</th>
                                    <th>Total</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders->take(10) as $order)
                                    <tr class="table-row-bg">
                                        <td><span class="fw-bold text-dark">#{{ $order->id }}</span></td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                            <div class="bg-light rounded-circle d-flex justify-content-center align-items-center text-secondary fw-bold" style="width: 32px; height: 32px; font-size: 0.8rem;">
                                                {{ substr($order->user->name ?? 'U', 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="fw-medium text-dark small">{{ $order->user->name ?? 'Unknown Customer' }}</div>
                                                    <div class="text-muted" style="font-size: 0.75rem;">{{ $order->created_at->format('M d, h:i A') }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-muted small">
                                                {{ optional($order->items->first()->service)->service_name ?? 'Unavailable Item' }}
                                                @if($order->items->count() > 1)
                                                    <span class="badge bg-light text-dark ms-1">+{{ $order->items->count() - 1 }} more</span>
                                                @endif
                                            </span>
                                        </td>
                                        <td class="fw-bold text-dark">{{ $order->total_amount }} PKR</td>
                                        <td>
                                            @if($order->transaction_id)
                                                <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25 rounded-pill px-3">Online</span>
                                            @else
                                                <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25 rounded-pill px-3">Cash</span>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $statusClass = match ($order->status) {
                                                    'pending' => 'status-pending',
                                                    'accepted' => 'status-accepted',
                                                    'completed' => 'status-completed',
                                                    'cancelled' => 'status-cancelled',
                                                    default => 'status-pending'
                                                };
                                                $statusIcon = match ($order->status) {
                                                    'pending' => 'fa-clock',
                                                    'accepted' => 'fa-check',
                                                    'completed' => 'fa-check-double',
                                                    'cancelled' => 'fa-times',
                                                    default => 'fa-circle'
                                                };
                                            @endphp
                                            <span class="status-badge {{ $statusClass }}">
                                                <i class="fas {{ $statusIcon }}"></i> {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            @if($order->status === 'pending')
                                                <form action="{{ route('order.acceptReject', $order) }}" method="POST" class="d-inline-block">
                                                    @csrf
                                                    <button type="submit" name="status" value="accepted" class="btn btn-sm btn-success rounded-pill px-3 shadow-sm me-1"><i class="fas fa-check"></i></button>
                                                    <button type="submit" name="status" value="rejected" class="btn btn-sm btn-danger rounded-pill px-3 shadow-sm"><i class="fas fa-times"></i></button>
                                                </form>
                                            @else
                                                <a href="{{ route('seller.order.handle', $order) }}" class="btn btn-sm btn-light rounded-pill px-3 border">
                                                    Details
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 50
        });

        // Toast logic (kept from original)
        @if (session('success'))
            // Custom toast creation or sweetalert could go here
            // For now relying on standard bootstrap styling if needed or ignoring
        @endif
    </script>
</body>
</html>
