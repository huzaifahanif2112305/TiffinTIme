<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $seller->name }} Services - Tiffin Time</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/styleHome.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        .services-header {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
                url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRudU2mn2drpKuvtw9Z8bRv8QSkcY-_E7_4Pw&s');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 60px 0;
            margin-bottom: 40px;
            border-radius: var(--border-radius-lg);
        }

        .seller-info {
            text-align: center;
        }

        .seller-info h1 {
            font-weight: 700;
            margin-bottom: 15px;
            font-size: 2.5rem;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .seller-info p {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 700px;
            margin: 0 auto;
        }

        .service-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            height: 100%;
            background-color: var(--white);

        }

        .service-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .service-img-container {
            height: 220px;
            overflow: hidden;
            position: relative;
        }

        .service-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .service-card:hover .service-img {
            transform: scale(1.1);
        }

        .service-card .card-body {
            padding: 1.5rem;
        }

        .service-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1a202c;
            line-height: 1.4;

        }

        .service-price {
            font-size: 1.25rem;
            color: var(--primary-color);
            font-weight: 800;
            color: white !important;


        }

        .service-description {
            color: #4a5568;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .service-details {
            background-color: #f7fafc;
            border-radius: 12px;
            border: 1px solid #edf2f7;
        }

        .cart-button {
            background: linear-gradient(to right, var(--primary-color), var(--primary-dark));
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: var(--border-radius-md);
            font-weight: 600;
            transition: all var(--transition-normal);
        }

        .cart-button:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
            background: linear-gradient(to right, var(--primary-dark), var(--primary-color));
        }

        .cart-float {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: linear-gradient(to right, var(--primary-color), var(--primary-dark));
            color: white;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow-lg);
            z-index: 999;
            transition: all var(--transition-normal);
        }

        .cart-float:hover {
            transform: scale(1.1);
        }

        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: var(--danger);
            color: white;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .empty-state {
            text-align: center;
            padding: 40px 0;
            color: var(--text-muted);
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 15px;
            color: var(--light-gray);
        }

        .services-container {
            min-height: 300px;
        }

        /* Accordion Styling */
        .accordion-item {
            border: none;
            margin-bottom: 10px;
            border-radius: 12px !important;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .accordion-button {
            border-radius: 12px !important;
            font-weight: 600;
            padding: 1.25rem;
        }

        .accordion-button:not(.collapsed) {
            background-color: #ebf4ff;
            color: var(--primary-color);
            box-shadow: none;
        }

        .accordion-button:focus {
            box-shadow: none;
            border-color: rgba(0, 0, 0, 0.1);
        }

        .list-group-item {
            border: none;
            border-bottom: 1px solid #f0f0f0;
            padding: 1rem;
        }

        .list-group-item:last-child {
            border-bottom: none;
        }

        /* Alert styling */
        .alert {
            border-radius: var(--border-radius-md);
            box-shadow: var(--shadow-sm);
            border: none;
        }

        .alert-success {
            background-color: var(--success-light);
            color: var(--success);
            border-left: 4px solid var(--success);
        }
        /* Verified badge on this page */
        @keyframes v-pulse {
            0%,100% { box-shadow: 0 0 0 0 rgba(29,78,216,0),   0 2px 8px rgba(29,78,216,.3); }
            50%      { box-shadow: 0 0 0 4px rgba(29,78,216,.15), 0 4px 14px rgba(29,78,216,.45); }
        }
        .vbadge {
            display: inline-flex; align-items: center; gap: 7px;
            background: #1d4ed8;
            color: #fff;
            font-size: 0.6em; font-weight: 800;
            padding: 6px 16px; border-radius: 50px;
            vertical-align: middle; letter-spacing: 0.6px;
            border: none;
            box-shadow: 0 2px 10px rgba(29,78,216,.4);
            animation: v-pulse 2.5s ease-in-out infinite;
            cursor: default; white-space: nowrap;
            margin-left: 10px;
        }
        .vbadge i { font-size: 1.05em; color: #fff; }

        .heart-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            background: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            cursor: pointer;
            z-index: 10;
            transition: transform 0.2s;
        }

        .heart-btn:hover {
            transform: scale(1.1);
        }

        .heart-btn i {
            font-size: 1.2rem;
            color: #e02424; 
        }
        .heart-btn i.far {
            color: #aaaaaa; 
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <!-- Modern Navbar -->
    <header class="navbar-main">
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <a href="{{ route('home') }}">
                        <span class="logo-text">Tiffin Time</span>
                        <span class="logo-icon"><i class="fas fa-utensils"></i></span>
                    </a>
                </div>

                <div class="nav-links">
                    <a href="{{ route('home') }}" class="nav-link">Home</a>
                    @auth
                        <a href="{{ route('favourites.index') }}" class="nav-link">
                            <i class="fas fa-heart text-danger"></i>
                        </a>
                    @endauth
                    <a href="{{ route('cart.view') }}" class="nav-link">
                        <i class="fas fa-shopping-cart"></i> Cart
                        <span class="badge bg-danger rounded-pill">
                            {{ Session::get('cart') ? array_sum(array_column(Session::get('cart'), 'quantity')) : 0 }}
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Toast notification container -->
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1080; margin-top: 70px;">
        <div id="favouriteToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body" id="toastMessage">
                    <i class="fas fa-check-circle me-2"></i> Message
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <!-- Seller Header -->
    <div class="container mt-5">
        <div class="services-header">
            <div class="seller-info">
                <h1>
                    {{ $seller->name }}
                    @if($seller->isVerified())
                        <span class="vbadge" title="This seller has been verified by Tiffin Time">
                            <i class="fas fa-shield-halved"></i> Verified Seller
                        </span>
                    @endif
                </h1>
                <p>Tiffin service provider in {{ $seller->city }}, {{ $seller->area }}</p>
            </div>
        </div>
    </div>

    <!-- Services Section -->
    <section class="container mb-5">
        @if (session('success'))
            <div class="alert alert-success mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="services-container">
            @if ($services->isEmpty())
                <div class="empty-state">
                    <i class="fas fa-utensils"></i>
                    <h3>No Services Available</h3>
                    <p>This seller hasn't added any services yet.</p>
                </div>
            @else
                @php
                    // Sort services: Available First
                    $sortedServices = $services->sortBy(function ($service) {
                        $now = \Carbon\Carbon::now();
                        $currentDay = $now->format('D');
                        $currentTime = $now->format('H:i:s');

                        // Check stock
                        if (!is_null($service->stock_quantity) && $service->stock_quantity <= 0)
                            return 3; // Sold Out

                        // Check Day
                        $days = $service->availability_days ?? [];
                        if (!empty($days) && !in_array($currentDay, $days))
                            return 2; // Closed Today

                        // Check Time
                        if ($service->start_time && $service->end_time) {
                            if ($currentTime >= $service->start_time && $currentTime <= $service->end_time)
                                return 0; // Available

                            // Check if upcoming
                            $startTime = \Carbon\Carbon::parse($service->start_time);
                            $diffInMinutes = $now->diffInMinutes($startTime, false);
                            if ($diffInMinutes > 0 && $diffInMinutes <= 60)
                                return 1; // Opening Soon

                            return 2; // Closed
                        }

                        return 0; // Available (All Day)
                    });
                @endphp

                <div class="row g-4">
                    @foreach ($sortedServices as $service)
                        @php
                            $now = \Carbon\Carbon::now();
                            $currentDay = $now->format('D');
                            $currentTime = $now->format('H:i:s');
                            $isAvailable = true;
                            $statusText = 'Available Now';
                            $statusClass = 'bg-success';
                            $btnText = 'Order Now';
                            $btnDisabled = false;
                            $cardOpacity = '1';
                            $grayscale = '0';

                            // Logic to determine status
                            if (!is_null($service->stock_quantity) && $service->stock_quantity <= 0) {
                                $isAvailable = false;
                                $statusText = 'Sold Out';
                                $statusClass = 'bg-danger';
                                $btnText = 'Sold Out';
                                $btnDisabled = true;
                                $cardOpacity = '0.6';
                                $grayscale = '1';
                            } elseif (!empty($service->availability_days) && !in_array($currentDay, $service->availability_days)) {
                                $isAvailable = false;
                                $statusText = 'Closed Today';
                                $statusClass = 'bg-secondary';
                                // Find next available day logic could go here, simplified for now
                                $btnText = 'Closed Today';
                                $btnDisabled = true;
                                $cardOpacity = '0.6';
                                $grayscale = '1';
                            } elseif ($service->start_time && $service->end_time) {
                                if ($currentTime < $service->start_time) {
                                    $isAvailable = false;
                                    $statusText = 'Opens at ' . \Carbon\Carbon::parse($service->start_time)->format('h:i A');
                                    $statusClass = 'bg-warning text-dark';
                                    $btnText = 'Opens Soon';
                                    $btnDisabled = true;
                                    $cardOpacity = '0.8';
                                    $grayscale = '0.5';
                                } elseif ($currentTime > $service->end_time) {
                                    $isAvailable = false;
                                    $statusText = 'Closed';
                                    $statusClass = 'bg-secondary';
                                    $btnText = 'Closed';
                                    $btnDisabled = true;
                                    $cardOpacity = '0.6';
                                    $grayscale = '1';
                                }
                            }
                        @endphp

                        <div class="col-md-6 col-lg-4 d-flex align-items-stretch">
                            <div class="service-card w-100 d-flex flex-column"
                                style="opacity: {{ $cardOpacity }}; filter: grayscale({{ $grayscale }}); transition: all 0.3s ease;">
                                <div class="service-img-container position-relative">
                                    @if($service->image)
                                        <img src="{{ '/storage/' . $service->image }}" alt="{{ $service->service_name }}"
                                            class="service-img w-100 h-100" style="object-fit: cover;">
                                    @else
                                        <div class="d-flex justify-content-center align-items-center h-100 bg-light">
                                            <i class="fas fa-utensils text-secondary" style="font-size: 3rem;"></i>
                                        </div>
                                    @endif

                                    <!-- Heart Toggle -->
                                    <button class="heart-btn" onclick="toggleFavourite({{ $service->id }}, this)" style="pointer-events: auto;">
                                        @if(Auth::check() && Auth::user()->favourites->contains($service->id))
                                            <i class="fas fa-heart"></i>
                                        @else
                                            <i class="far fa-heart"></i>
                                        @endif
                                    </button>

                                    <div class="position-absolute top-0 start-0 w-100 d-flex justify-content-between p-3"
                                        style="pointer-events: none;">
                                        <!-- Category Tag -->
                                        <div>
                                            @if($service->category_tag)
                                                <span class="badge bg-dark shadow-sm">
                                                    {{ $service->category_tag }}
                                                </span>
                                            @endif
                                        </div>

                                        <!-- Status Badge Removed (Moved to Card Body) -->
                                        <div></div>
                                    </div>
                                </div>

                                <div class="card-body d-flex flex-column p-4">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h3 class="service-title h5 fw-bold mb-0 text-dark">{{ $service->service_name }}</h3>
                                        <div class="d-flex flex-column align-items-end">
                                            <div class="service-price text-primary fw-bold h5 mb-0">
                                                {{ $service->service_price }} <small>PKR</small>
                                            </div>
                                            <!-- Status Badge Moved Here -->
                                            @if($isAvailable)
                                                <span class="badge bg-success shadow-sm mt-1" style="font-size: 0.7rem;">
                                                    Available
                                                </span>
                                            @elseif(!empty($service->availability_days) && !in_array($currentDay, $service->availability_days))
                                                <span class="badge bg-secondary shadow-sm mt-1" style="font-size: 0.7rem;">
                                                    Closed Today
                                                </span>
                                            @else
                                                <span class="badge {{ $statusClass }} shadow-sm mt-1" style="font-size: 0.7rem;">
                                                    {{ $statusText }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <p class="service-description text-muted small mb-3 flex-grow-1" style="line-height: 1.6;">
                                        {{ Str::limit($service->service_description, 100) }}
                                    </p>

                                    <div class="service-details mb-3 p-3 bg-light rounded-3 small">
                                        <div class="row g-2">
                                            <div class="col-6">
                                                <i class="fas fa-clock text-primary me-1"></i>
                                                <span class="text-secondary">
                                                    @if($service->start_time && $service->end_time)
                                                        {{ \Carbon\Carbon::parse($service->start_time)->format('h:i A') }} -
                                                        {{ \Carbon\Carbon::parse($service->end_time)->format('h:i A') }}
                                                    @else
                                                        All Day
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="col-6">
                                                <i class="fas fa-truck text-primary me-1"></i>
                                                <span class="text-secondary">{{ $service->service_delivery_time }} Days
                                                    Delivery</span>
                                            </div>
                                            @if($service->stock_quantity !== null)
                                                <div class="col-12">
                                                    <i class="fas fa-cubes text-primary me-1"></i>
                                                    <span
                                                        class="{{ $service->stock_quantity < 5 ? 'text-danger fw-bold' : 'text-secondary' }}">
                                                        {{ $service->stock_quantity }} items left
                                                    </span>
                                                </div>
                                            @endif
                                            <div class="col-12">
                                                <i class="fas fa-calendar-check text-primary me-1"></i>
                                                <span class="text-secondary">
                                                    @if(!empty($service->availability_days))
                                                        {{ implode(', ', $service->availability_days) }}
                                                    @else
                                                        Every Day
                                                    @endif
                                                </span>
                                            </div>
                                            <!-- Timer Section -->
                                            <div class="col-12 mt-2">
                                                <div class="menu-timer badge bg-light text-dark border w-100 py-2"
                                                    data-start-time="{{ $service->start_time ? \Carbon\Carbon::parse($service->start_time)->format('H:i:s') : '' }}"
                                                    data-end-time="{{ $service->end_time ? \Carbon\Carbon::parse($service->end_time)->format('H:i:s') : '' }}"
                                                    data-availability-days="{{ json_encode($service->availability_days) }}">
                                                    <i class="fas fa-hourglass-half me-1"></i> <span
                                                        class="timer-text">Loading...</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-auto">
                                        <form action="{{ route('cart.add') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="service_id" value="{{ $service->id }}">
                                            <button type="submit" class="btn btn-primary w-100 py-2 fw-bold shadow-sm" {{ $btnDisabled ? 'disabled' : '' }} style="border-radius: 10px;">
                                                <i class="fas {{ $isAvailable ? 'fa-cart-plus' : 'fa-clock' }} me-2"></i>
                                                {{ $btnText }}
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
    </section>

    <!-- Today's Special Menu Section -->
    <section class="container mb-5">
        @php
            $now = \Carbon\Carbon::now();
            $currentDayName = $now->format('l'); // e.g., Friday
            $currentDayShort = $now->format('D'); // e.g., Fri

            $todaysMenus = $services->filter(function ($service) use ($currentDayShort) {
                return !empty($service->availability_days) && in_array($currentDayShort, $service->availability_days);
            });
        @endphp

        <div class="p-4 rounded-4 mb-4" style="background-color: #fff9db; border: 2px solid #ffe066;">
            <div class="text-center mb-4">
                <h2 class="fw-bold text-dark mb-1">🌟 Today's Menu ({{ $currentDayName }})</h2>
                <p class="text-muted mb-0">Freshly prepared for you today.</p>
            </div>

            @if($todaysMenus->isEmpty())
                <div class="text-center py-4">
                    <i class="fas fa-calendar-day text-warning mb-3" style="font-size: 3rem;"></i>
                    <h5 class="text-muted">No specific menu items scheduled for today.</h5>
                    <p class="text-muted">Check out our Weekly Schedule below!</p>
                </div>
            @else
                <div class="row g-4">
                    @foreach($todaysMenus as $service)
                        @php
                            // Reuse logic for status
                            $currentTime = $now->format('H:i:s');
                            $isAvailable = true;
                            $statusText = 'Available Now';
                            $statusClass = 'bg-success';
                            $btnText = 'Order Now';
                            $btnDisabled = false;

                            if (!is_null($service->stock_quantity) && $service->stock_quantity <= 0) {
                                $isAvailable = false;
                                $statusText = 'Sold Out';
                                $statusClass = 'bg-danger';
                                $btnText = 'Sold Out';
                                $btnDisabled = true;
                            } elseif ($service->start_time && $service->end_time) {
                                if ($currentTime < $service->start_time) {
                                    $isAvailable = false;
                                    $statusText = 'Opens Soon';
                                    $statusClass = 'bg-warning text-dark';
                                    $btnText = 'Opens Soon';
                                    $btnDisabled = true;
                                } elseif ($currentTime > $service->end_time) {
                                    $isAvailable = false;
                                    $statusText = 'Closed';
                                    $statusClass = 'bg-secondary';
                                    $btnText = 'Closed';
                                    $btnDisabled = true;
                                }
                            }
                        @endphp
                        <div class="col-md-6 col-lg-4 d-flex align-items-stretch">
                            <div class="service-card w-100 d-flex flex-column shadow-lg border-0"
                                style="transition: transform 0.3s;">
                                <div class="service-img-container position-relative">
                                    @if($service->image)
                                        <img src="{{ '/storage/' . $service->image }}" alt="{{ $service->service_name }}"
                                            class="service-img w-100 h-100" style="object-fit: cover;">
                                    @else
                                        <div class="d-flex justify-content-center align-items-center h-100 bg-light">
                                            <i class="fas fa-utensils text-secondary" style="font-size: 3rem;"></i>
                                        </div>
                                    @endif

                                    <!-- Heart Toggle -->
                                    <button class="heart-btn" onclick="toggleFavourite({{ $service->id }}, this)" style="pointer-events: auto;">
                                        @if(Auth::check() && Auth::user()->favourites->contains($service->id))
                                            <i class="fas fa-heart"></i>
                                        @else
                                            <i class="far fa-heart"></i>
                                        @endif
                                    </button>

                                    <div class="position-absolute top-0 start-0 w-100 d-flex justify-content-between p-3"
                                        style="pointer-events: none;">
                                        <div>
                                            @if($service->category_tag)
                                                <span class="badge bg-dark shadow-sm">{{ $service->category_tag }}</span>
                                            @endif
                                        </div>
                                        <div></div>
                                    </div>
                                </div>

                                <div class="card-body d-flex flex-column p-4">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h3 class="service-title h5 fw-bold mb-0 text-dark">{{ $service->service_name }}</h3>
                                        <div class="d-flex flex-column align-items-end">
                                            <div class="service-price text-primary fw-bold h5 mb-0"
                                                style="color: white !important;">{{ $service->service_price }}
                                                <small>PKR</small>
                                            </div>
                                            <span class="badge {{ $statusClass }} shadow-sm mt-1"
                                                style="font-size: 0.7rem;">{{ $statusText }}</span>
                                        </div>
                                    </div>

                                    <p class="service-description text-muted small mb-3 flex-grow-1">
                                        {{ Str::limit($service->service_description, 100) }}
                                    </p>

                                    <!-- Timer Section for Today's Special -->
                                    <div class="mb-3">
                                        <div class="menu-timer badge bg-warning text-dark w-100 py-2"
                                            data-start-time="{{ $service->start_time ? \Carbon\Carbon::parse($service->start_time)->format('H:i:s') : '' }}"
                                            data-end-time="{{ $service->end_time ? \Carbon\Carbon::parse($service->end_time)->format('H:i:s') : '' }}"
                                            data-availability-days="{{ json_encode($service->availability_days) }}">
                                            <i class="fas fa-hourglass-half me-1"></i> <span
                                                class="timer-text">Loading...</span>
                                        </div>
                                    </div>

                                    <div class="mt-auto">
                                        <form action="{{ route('cart.add') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="service_id" value="{{ $service->id }}">
                                            <button type="submit" class="btn btn-warning w-100 py-2 fw-bold shadow-sm text-dark"
                                                {{ $btnDisabled ? 'disabled' : '' }}>
                                                <i class="fas fa-utensils me-2"></i> {{ $btnText }}
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
    </section>

    <!-- Weekly Menu Schedule Section -->
    <section class="container mb-5">
        <div class="services-header p-4 mb-4"
            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); height: auto; min-height: auto;">
            <h2 class="text-white m-0"><i class="fas fa-calendar-week me-2"></i>Weekly Menu Schedule</h2>
            <p class="text-white-50 m-0">Plan your meals for the week</p>
        </div>

        <div class="accordion" id="weeklyScheduleAccordion">
            @php
                $weekDays = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
                $fullDayNames = [
                    'Mon' => 'Monday',
                    'Tue' => 'Tuesday',
                    'Wed' => 'Wednesday',
                    'Thu' => 'Thursday',
                    'Fri' => 'Friday',
                    'Sat' => 'Saturday',
                    'Sun' => 'Sunday'
                ];
                $currentDayShort = \Carbon\Carbon::now()->format('D');
            @endphp

            @foreach($weekDays as $index => $day)
                @php
                    $dayServices = $services->filter(function ($service) use ($day) {
                        return !empty($service->availability_days) && in_array($day, $service->availability_days);
                    });
                    $isToday = ($day === $currentDayShort);
                @endphp

                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $day }}">
                        <button
                            class="accordion-button {{ $isToday ? '' : 'collapsed' }} {{ $isToday ? 'bg-light fw-bold text-primary' : '' }}"
                            type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $day }}"
                            aria-expanded="{{ $isToday ? 'true' : 'false' }}" aria-controls="collapse{{ $day }}">
                            <div class="d-flex justify-content-between w-100 me-3">
                                <span>{{ $fullDayNames[$day] }}</span>
                                <span
                                    class="badge {{ $dayServices->count() > 0 ? 'bg-primary' : 'bg-secondary' }} rounded-pill">
                                    {{ $dayServices->count() }} Items
                                </span>
                            </div>
                        </button>
                    </h2>
                    <div id="collapse{{ $day }}" class="accordion-collapse collapse {{ $isToday ? 'show' : '' }}"
                        aria-labelledby="heading{{ $day }}" data-bs-parent="#weeklyScheduleAccordion">
                        <div class="accordion-body">
                            @if($dayServices->isEmpty())
                                <p class="text-muted text-center my-3">No menu items scheduled for this day.</p>
                            @else
                                <div class="list-group">
                                    @foreach($dayServices as $service)
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                @if($service->image)
                                                    <img src="{{ '/storage/' . $service->image }}" alt="{{ $service->service_name }}"
                                                        class="rounded me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                                @else
                                                    <div class="rounded me-3 d-flex justify-content-center align-items-center bg-light"
                                                        style="width: 50px; height: 50px;">
                                                        <i class="fas fa-utensils text-muted"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <h6 class="mb-0">{{ $service->service_name }}</h6>
                                                    <small class="text-muted">
                                                        @if($service->start_time && $service->end_time)
                                                            {{ \Carbon\Carbon::parse($service->start_time)->format('h:i A') }} -
                                                            {{ \Carbon\Carbon::parse($service->end_time)->format('h:i A') }}
                                                        @else
                                                            All Day
                                                        @endif
                                                    </small>
                                                    <span
                                                        class="badge bg-info text-dark ms-2">{{ $service->category_tag ?? 'Meal' }}</span>
                                                </div>
                                            </div>
                                            <span class="fw-bold text-primary">{{ $service->service_price }} PKR</span>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Customer Testimonials Section -->


    <!-- Floating Cart Button -->
    <a href="{{ route('cart.view') }}" class="cart-float">
        <i class="fas fa-shopping-cart"></i>
        <span class="cart-count">
            {{ Session::get('cart') ? array_sum(array_column(Session::get('cart'), 'quantity')) : 0 }}
        </span>
    </a>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="text-center">
                <p>&copy; 2026 Tiffin Time. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function updateTimers() {
                const timers = document.querySelectorAll('.menu-timer');
                const now = new Date();
                const currentDay = now.toLocaleDateString('en-US', { weekday: 'short' }); // Mon, Tue...

                timers.forEach(timer => {
                    const startTimeStr = timer.dataset.startTime;
                    const endTimeStr = timer.dataset.endTime;
                    const availabilityDays = JSON.parse(timer.dataset.availabilityDays || '[]');
                    const timerText = timer.querySelector('.timer-text');

                    if (!startTimeStr || !endTimeStr) {
                        timerText.textContent = "Available All Day";
                        timer.className = timer.className.replace('bg-warning', 'bg-success').replace('text-dark', 'text-white');
                        return;
                    }

                    // Create Date objects for start and end times today
                    const [startH, startM, startS] = startTimeStr.split(':');
                    const [endH, endM, endS] = endTimeStr.split(':');

                    const startTime = new Date(now);
                    startTime.setHours(startH, startM, startS, 0);

                    const endTime = new Date(now);
                    endTime.setHours(endH, endM, endS, 0);

                    // Check if available today
                    if (availabilityDays.length > 0 && !availabilityDays.includes(currentDay)) {
                        timerText.textContent = "Not Available Today";
                        timer.className = "menu-timer badge bg-secondary text-white w-100 py-2";
                        return;
                    }

                    if (now < startTime) {
                        // Before opening
                        const diff = startTime - now;
                        const hours = Math.floor(diff / (1000 * 60 * 60));
                        const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                        const seconds = Math.floor((diff % (1000 * 60)) / 1000);
                        timerText.textContent = `Opens in ${hours}h ${minutes}m ${seconds}s`;
                        timer.className = "menu-timer badge bg-info text-dark w-100 py-2";
                    } else if (now >= startTime && now <= endTime) {
                        // Currently open
                        const diff = endTime - now;
                        const hours = Math.floor(diff / (1000 * 60 * 60));
                        const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                        const seconds = Math.floor((diff % (1000 * 60)) / 1000);
                        timerText.textContent = `Live! Ends in ${hours}h ${minutes}m ${seconds}s`;
                        timer.className = "menu-timer badge bg-success text-white w-100 py-2";
                        // Add glowing effect
                        timer.style.boxShadow = "0 0 10px rgba(40, 167, 69, 0.5)";
                    } else {
                        // Closed for the day
                        timerText.textContent = "Closed for Today";
                        timer.className = "menu-timer badge bg-danger text-white w-100 py-2";
                        timer.style.boxShadow = "none";
                    }
                });
            }

            // Update immediately and then every second
            updateTimers();
            setInterval(updateTimers, 1000);
        });

        function toggleFavourite(serviceId, btnElement) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            // Optimistic UI updates
            const icon = btnElement.querySelector('i');
            const isFavourited = icon.classList.contains('fas');
            btnElement.disabled = true;

            fetch('{{ route("favourite.toggle") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ service_id: serviceId })
            })
            .then(response => {
                if(response.status === 401) {
                    window.location.href = "{{ route('login') }}";
                    throw new Error('Not authenticated');
                }
                return response.json();
            })
            .then(data => {
                btnElement.disabled = false;
                if(data.status === 'added') {
                    icon.classList.remove('far');
                    icon.classList.add('fas');
                    showToast(data.message, 'success');
                } else if(data.status === 'removed') {
                    icon.classList.remove('fas');
                    icon.classList.add('far');
                    showToast(data.message, 'danger');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                btnElement.disabled = false;
            });
        }

        function showToast(message, type = 'success') {
            const toastEl = document.getElementById('favouriteToast');
            if(toastEl) {
                const toastMessage = document.getElementById('toastMessage');
                toastEl.className = `toast align-items-center text-white bg-${type} border-0`;
                let icon = type === 'success' ? 'fa-check-circle' : 'fa-info-circle';
                toastMessage.innerHTML = `<i class="fas ${icon} me-2"></i> ${message}`;
                const toast = new bootstrap.Toast(toastEl, { delay: 3000 });
                toast.show();
            }
        }
    </script>
</body>

</html>