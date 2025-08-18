<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundrify - Your Laundry Service Solution</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/styleHome.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/logo.css') }}">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
<style>
/* Modern Logo Styles */
.logo-container {
    display: flex;
    align-items: center;
    position: relative;
    z-index: 1;
}

.logo-icon {
    font-size: 1.5rem;
    color: var(--white, #fff);
    width: 2.5rem;
    height: 2.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #4361ee, #3a56d4);
    border-radius: 50%;
    margin-right: 0.75rem;
    box-shadow: 0 4px 8px rgba(67, 97, 238, 0.25);
}

.logo-text {
    font-family: 'Poppins', sans-serif;
    font-weight: 700;
    font-size: 1.25rem;
    color: #2d3748;
    position: relative;
}

.logo-text::after {
    content: '';
    position: absolute;
    bottom: -3px;
    left: 0;
    width: 70%;
    height: 2px;
    background: linear-gradient(135deg, #4361ee, #3a56d4);
    border-radius: 8px;
}

</style>
</head>
<body>
    {{-- <pre>{{ var_dump(session()->all()) }}</pre> --}}
    <!-- Toast notification container - fixed position that doesn't overflow -->
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1080; margin-top: 70px;">
        @if(session('success'))
            <div class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        @endif
    
        @if(session('error'))
            <div class="toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        @endif
    </div>

<!-- Modern, consistent navbar -->
<header class="navbar-main">
    <div class="container">
        <div class="header-content">
            <div class="logo">
                <a href="#home">
                    <div class="logo-container">
                        <i class="fas fa-tshirt logo-icon"></i>
                        <span class="logo-text">Laundrify</span>
                    </div>
                </a>
            </div>
            
            <div class="search-bar">
                <div class="search-wrapper">
                    <i class="fas fa-search search-icon"></i>
                    <input 
                        type="text" 
                        id="serviceSearch" 
                        placeholder="Search for services..." 
                        onkeyup="searchServices()" 
                        onclick="toggleSearchResults()"
                    />
                </div>
                <div id="searchResults" class="search-results" style="display: none;"></div>
            </div>
            
            <div class="nav-links">
                <a href="#home" class="nav-link active">Home</a>
                <a href="#sellers" class="nav-link">Sellers</a>
                <a href="#services" class="nav-link">Services</a>
                <a href="#about" class="nav-link">About</a>
            </div>

            <div class="nav-actions">
                <!-- Notification dropdown with improved styling -->
                <div class="notification-dropdown dropdown">
                    <button class="notification-btn" type="button" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-bell"></i>
                        @auth
                            @php
                                $unreadCount = Auth::user()->unreadNotifications->count();
                            @endphp

                            @if($unreadCount > 0)
                                <span class="notification-badge">{{ $unreadCount }}</span>
                            @endif
                        @endauth
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end notification-menu" aria-labelledby="notificationDropdown">
                        <li class="dropdown-header d-flex justify-content-between align-items-center">
                            <span>Notifications</span>
                            @auth
                                <form method="POST" action="{{ route('notifications.markAllAsRead') }}" class="d-inline-block">
                                    @csrf
                                    <button type="submit" class="btn btn-link btn-sm p-0 text-primary">Mark all as read</button>
                                </form>
                            @endauth
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        @auth
                            @php
                                $notifications = Auth::user()->notifications()->latest()->take(5)->get();
                            @endphp
                            @if(count($notifications) > 0)
                                @foreach($notifications as $notification)
                                    <li class="notification-item dropdown-item {{ is_null($notification->read_at) ? 'unread' : '' }}" data-id="{{ $notification->id }}">
                                        <a href="{{ $notification->data['service_url'] ?? '#' }}" class="notification-link">
                                            <div class="notification-content">
                                                <p>{{ $notification->data['message'] ?? 'No message available' }}</p>
                                                <span class="notification-time">{{ $notification->created_at->diffForHumans() }}</span>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                                <li><hr class="dropdown-divider"></li>
                                <li class="dropdown-footer"><a href="#">View All Notifications</a></li>
                            @else
                                <li class="notification-empty">No notifications yet</li>
                            @endif
                        @else
                            <li class="notification-empty">Please login to see notifications</li>
                        @endauth
                    </ul>
                </div>

                <!-- User profile dropdown with improved styling -->
                <div class="profile-dropdown dropdown">
                    @auth
                        @php
                            $profileUpdate = \App\Models\UserProfileUpdate::where('user_id', Auth::id())->first();
                        @endphp
                        <button class="profile-btn" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            @if ($profileUpdate && $profileUpdate->profile_image)
                                <img src="{{ asset('storage/' . $profileUpdate->profile_image) }}" alt="Profile Image" class="profile-img">
                            @else
                                <div class="profile-avatar">
                                    <i class="fas fa-user"></i>
                                </div>
                            @endif
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end profile-menu" aria-labelledby="profileDropdown">
                            <li class="dropdown-header">Welcome, {{ Auth::user()->name }}!</li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-user-edit me-2"></i>Update Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('order.all') }}"><i class="fas fa-shopping-bag me-2"></i>View Your Orders</a></li>
                            <li><a class="dropdown-item" href="{{ route('order.history') }}"><i class="fas fa-history me-2"></i>Order History</a></li>
                            <li><hr class="dropdown-divider"></li>
                            @if(Auth::user()->sellerType == 1)
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i>Admin Dashboard</a></li>
                            @elseif(Auth::user()->sellerType == 3)
                                <li><a class="dropdown-item" href="{{ route('seller.panel') }}"><i class="fas fa-store me-2"></i>Seller Panel</a></li>
                            @endif
                            <li><a class="dropdown-item" href="{{ route('register.seller') }}"><i class="fas fa-user-plus me-2"></i>Register as Seller</a></li>
                            <li><a class="dropdown-item" href="{{ route('login.seller') }}"><i class="fas fa-sign-in-alt me-2"></i>Login as Seller</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                                </form>
                            </li>
                        </ul>
                    @else
                        <button class="profile-btn" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="profile-avatar">
                                <i class="fas fa-user"></i>
                            </div>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end profile-menu" aria-labelledby="profileDropdown">
                            <li><a class="dropdown-item" href="{{ route('login') }}"><i class="fas fa-sign-in-alt me-2"></i>Login</a></li>
                            <li><a class="dropdown-item" href="{{ route('register') }}"><i class="fas fa-user-plus me-2"></i>Register</a></li>
                        </ul>
                    @endauth
                </div>
            </div>
            
            <!-- Mobile menu toggle button -->
            <div class="mobile-menu-toggle">
                <button type="button" id="mobileMenuBtn">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Mobile menu dropdown -->
    <div class="mobile-menu" id="mobileMenu">
        <div class="container">
            <div class="mobile-search">
                <div class="search-wrapper">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" placeholder="Search for services...">
                </div>
            </div>
            <div class="mobile-links">
                <a href="#home" class="active">Home</a>
                <a href="#sellers">Sellers</a>
                <a href="#services">Services</a>
                <a href="#about">About</a>
                @auth
                    <a href="{{ route('profile.edit') }}">Update Profile</a>
                    <a href="{{ route('order.all') }}">View Your Orders</a>
                    <a href="{{ route('order.history') }}">Order History</a>
                    @if(Auth::user()->sellerType == 1)
                        <a href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                    @elseif(Auth::user()->sellerType == 3)
                        <a href="{{ route('seller.panel') }}">Seller Panel</a>
                    @endif
                    <a href="{{ route('register.seller') }}">Register as Seller</a>
                    <a href="{{ route('login.seller') }}">Login as Seller</a>
                    <form method="POST" action="{{ route('logout') }}" class="mobile-logout">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}">Register</a>
                @endauth
            </div>
        </div>
    </div>
</header>

<!-- Hero Section -->
<section class="hero-section" id="home">
    <div class="hero-background">
        <div class="hero-particles"></div>
        <div class="hero-gradient"></div>
    </div>
    
    <div class="container">
        <div class="hero-content">
            <div class="hero-text">
                <div class="hero-badge">
                    <i class="fas fa-star"></i>
                    <span>Trusted by 10,000+ customers</span>
                </div>
                
                <h1 class="hero-title">
                    <span class="gradient-text">Fresh Clothes,</span>
                    <br>Fresh Start
                </h1>
                
                <p class="hero-description">
                    Experience the future of laundry services. Professional cleaning, 
                    doorstep delivery, and eco-friendly solutions - all at your fingertips.
                </p>
                
                <div class="hero-actions">
                    <a href="#services" class="btn btn-primary btn-lg">
                        <i class="fas fa-tshirt me-2"></i>
                        Explore Services
                    </a>
                    <a href="#about" class="btn btn-outline btn-lg">
                        <i class="fas fa-play me-2"></i>
                        Learn More
                    </a>
                </div>
                
                <div class="hero-stats">
                    <div class="stat-item">
                        <div class="stat-number">24/7</div>
                        <div class="stat-label">Service</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">99%</div>
                        <div class="stat-label">Satisfaction</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">1hr</div>
                        <div class="stat-label">Delivery</div>
                    </div>
                </div>
            </div>
            
            <div class="hero-visual">
                <div class="hero-image-container">
                    <img src="{{ asset('images/main-body.jpg') }}" alt="Laundry Service" class="hero-image">
                    <div class="hero-image-overlay"></div>
                </div>
                
                <div class="floating-card card-1">
                    <i class="fas fa-check-circle"></i>
                    <span>Quality Assured</span>
                </div>
                
                <div class="floating-card card-2">
                    <i class="fas fa-truck"></i>
                    <span>Free Delivery</span>
                </div>
                
                <div class="floating-card card-3">
                    <i class="fas fa-leaf"></i>
                    <span>Eco-Friendly</span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="scroll-indicator">
        <div class="scroll-arrow"></div>
        <span>Scroll to explore</span>
    </div>
</section>

<!-- Features Section -->
<section class="features-section">
    <div class="container">
        <div class="section-header text-center">
            <h2 class="section-title">Why Choose Laundrify?</h2>
            <p class="section-subtitle">Experience the difference with our premium laundry services</p>
        </div>
        
        <div class="features-grid">
            <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-icon">
                    <i class="fas fa-award"></i>
                </div>
                <h3 class="feature-title">Premium Quality</h3>
                <p class="feature-description">
                    Professional-grade detergents and state-of-the-art equipment ensure your clothes 
                    receive the finest care possible.
                </p>
                <div class="feature-highlight">
                    <i class="fas fa-check"></i>
                    <span>100% Quality Guarantee</span>
                </div>
            </div>
            
            <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <h3 class="feature-title">Lightning Fast</h3>
                <p class="feature-description">
                    Express service available with same-day turnaround. 
                    Get your clothes back when you need them most.
                </p>
                <div class="feature-highlight">
                    <i class="fas fa-check"></i>
                    <span>Same Day Service</span>
                </div>
            </div>
            
            <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-icon">
                    <i class="fas fa-leaf"></i>
                </div>
                <h3 class="feature-title">Eco-Friendly</h3>
                <p class="feature-description">
                    Sustainable cleaning methods and biodegradable products 
                    to protect both your clothes and the environment.
                </p>
                <div class="feature-highlight">
                    <i class="fas fa-check"></i>
                    <span>Green Certified</span>
                </div>
            </div>
            
            <div class="feature-card" data-aos="fade-up" data-aos-delay="400">
                <div class="feature-icon">
                    <i class="fas fa-truck"></i>
                </div>
                <h3 class="feature-title">Doorstep Service</h3>
                <p class="feature-description">
                    Convenient pickup and delivery right to your doorstep. 
                    No more trips to the laundry - we come to you.
                </p>
                <div class="feature-highlight">
                    <i class="fas fa-check"></i>
                    <span>Free Pickup & Delivery</span>
                </div>
            </div>
            
            <div class="feature-card" data-aos="fade-up" data-aos-delay="500">
                <div class="feature-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3 class="feature-title">Secure & Safe</h3>
                <p class="feature-description">
                    Your clothes are handled with care in secure facilities. 
                    Advanced tracking ensures you always know where they are.
                </p>
                <div class="feature-highlight">
                    <i class="fas fa-check"></i>
                    <span>Real-time Tracking</span>
                </div>
            </div>
            
            <div class="feature-card" data-aos="fade-up" data-aos-delay="600">
                <div class="feature-icon">
                    <i class="fas fa-headset"></i>
                </div>
                <h3 class="feature-title">24/7 Support</h3>
                <p class="feature-description">
                    Round-the-clock customer support to answer your questions 
                    and resolve any concerns immediately.
                </p>
                <div class="feature-highlight">
                    <i class="fas fa-check"></i>
                    <span>Always Available</span>
                </div>
            </div>
        </div>
    </div>
</section>
        </div>
    </div>
</section>

<section class="sellers" id="sellers">
    <div class="container">
        <div class='text-center'>
            <h2 class="my-4" style="font-size: 40px">Our Sellers</h2>
        </div>
        @auth
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @foreach ($sellers as $seller)
                    <div class="col">
                        <div class="card h-100">
                            <div class="card-img-top d-flex justify-content-center align-items-center" 
                                style="width: 120px; height: 120px; background-color: #f0f0f0; border-radius: 50%; overflow: hidden; margin: 0 auto;">
                                @if ($seller->profile_image && file_exists(public_path('storage/' . $seller->profile_image)))
                                    <img src="{{ asset('storage/' . $seller->profile_image) }}" alt="{{ $seller->name }}" class="img-fluid" style="object-fit: cover; width: 100%; height: 100%;">
                                @else
                                    <i class="fas fa-user" style="font-size: 70px; color: #aaa;"></i>
                                @endif
                            </div>
                            <div class="card-body text-center">
                                <h5 class="card-title">
                                    {{ $seller->name }}
                                    @if($seller->isVerified())
                                        <span class="verified-badge" data-bs-toggle="tooltip" data-bs-placement="top" title="This seller has been verified by Laundrify">
                                            <i class="fas fa-check-circle"></i><span class="verified-text">Verified</span>
                                        </span>
                                    @endif
                                </h5>
                                <p class="card-text"><strong>City:</strong> {{ $seller->city }}</p>
                                <p class="card-text"><strong>Area:</strong> {{ $seller->area }}</p>
                                <a href="{{ route('sellers.services', $seller->id) }}" class="btn btn-primary">View Services</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>Please <a href="{{ route('login') }}">log in</a> to view our sellers.</p>
        @endauth
    </div>
</section>

<!-- Services Section -->
<section class="services-section" id="services">
    <div class="container">
        <div class="section-header text-center" data-aos="fade-up">
            <h2 class="section-title">Our Premium Services</h2>
            <p class="section-subtitle">Discover a wide range of professional laundry services tailored to your needs</p>
        </div>
        
        <div class="services-grid">
            @auth
                @if ($services->isEmpty())
                    <div class="no-services" data-aos="fade-up">
                        <div class="no-services-icon">
                            <i class="fas fa-tshirt"></i>
                        </div>
                        <h4>No services available</h4>
                        <p>Check back soon for new laundry services!</p>
                    </div>
                @else
                    @foreach ($services as $service)
                        @if ($service->is_approved)
                            <div class="service-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                                <div class="service-header">
                                    <div class="service-image">
                                        @if ($service->image && file_exists(public_path('storage/' . $service->image)))
                                            <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->service_name }}">
                                        @else
                                            <div class="service-placeholder">
                                                <i class="fas fa-tshirt"></i>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="service-price">
                                        <span class="price-amount">{{ $service->service_price }}</span>
                                        <span class="price-currency">PKR</span>
                                    </div>
                                </div>
                                
                                <div class="service-content">
                                    <h3 class="service-title">{{ $service->service_name }}</h3>
                                    <p class="service-description">{{ $service->service_description }}</p>
                                    
                                    <div class="service-seller">
                                        <div class="seller-avatar">
                                            @if ($service->seller->profile_image && file_exists(public_path('storage/' . $service->seller->profile_image)))
                                                <img src="{{ asset('storage/' . $service->seller->profile_image) }}" alt="{{ $service->seller->name }}">
                                            @else
                                                <i class="fas fa-user"></i>
                                            @endif
                                        </div>
                                        <div class="seller-info">
                                            <h5 class="seller-name">{{ $service->seller->name }}</h5>
                                            <p class="seller-location">
                                                <i class="fas fa-map-marker-alt"></i>
                                                {{ $service->seller->city }}, {{ $service->seller->area }}
                                            </p>
                                            @if($service->seller->isVerified())
                                                <span class="verified-badge">
                                                    <i class="fas fa-check-circle"></i>
                                                    Verified Seller
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="service-meta">
                                        <div class="meta-item">
                                            <i class="fas fa-clock"></i>
                                            <span>{{ $service->service_delivery_time }} days</span>
                                        </div>
                                        <div class="meta-item">
                                            <i class="fas fa-check-circle"></i>
                                            <span>{{ $service->availability }}</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="service-actions">
                                    <a href="{{ route('seller.services', ['seller_id' => $service->seller->id]) }}" class="btn btn-primary btn-full">
                                        <i class="fas fa-shopping-cart me-2"></i>
                                        View Details
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            @else
                <div class="login-prompt" data-aos="fade-up">
                    <div class="login-prompt-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <h4>Login to view services</h4>
                    <p>Please <a href="{{ route('login') }}" class="text-primary">log in</a> to see our available services.</p>
                </div>
            @endauth
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="stats-section">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-card" data-aos="fade-up" data-aos-delay="100">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-number" data-count="10000">0</div>
                    <div class="stat-label">Happy Customers</div>
                </div>
            </div>
            
            <div class="stat-card" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-icon">
                    <i class="fas fa-tshirt"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-number" data-count="50000">0</div>
                    <div class="stat-label">Clothes Cleaned</div>
                </div>
            </div>
            
            <div class="stat-card" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-icon">
                    <i class="fas fa-store"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-number" data-count="50">0</div>
                    <div class="stat-label">Partner Sellers</div>
                </div>
            </div>
            
            <div class="stat-card" data-aos="fade-up" data-aos-delay="400">
                <div class="stat-icon">
                    <i class="fas fa-star"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-number" data-count="98">0</div>
                    <div class="stat-label">Satisfaction Rate</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials-section">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">What Our Customers Say</h2>
            <p class="section-subtitle">Real feedback from satisfied customers who trust Laundrify</p>
        </div>
        
        <div class="testimonials-grid">
            @foreach ($feedbacks as $feedback)
                <div class="testimonial-card">
                    <div class="testimonial-content">
                        <div class="quote-icon">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        <p class="testimonial-text">{{ $feedback->feedback }}</p>
                    </div>
                    
                    <div class="testimonial-footer">
                        <div class="customer-info">
                            <div class="customer-avatar">
                                <span>{{ substr($feedback->user ? $feedback->user->name : 'A', 0, 1) }}</span>
                            </div>
                            <div class="customer-details">
                                <h5 class="customer-name">{{ $feedback->user ? $feedback->user->name : 'Anonymous' }}</h5>
                                <p class="customer-meta">
                                    <i class="fas fa-calendar-alt"></i>
                                    {{ $feedback->order ? $feedback->order->created_at->format('M d, Y') : 'N/A' }}
                                </p>
                            </div>
                        </div>
                        
                        <div class="service-provider">
                            <span class="provider-label">Service by:</span>
                            <span class="provider-name">{{ $feedback->seller ? $feedback->seller->name : 'N/A' }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        @if($feedbacks->count() == 0)
            <div class="no-testimonials text-center py-5">
                <div class="no-testimonials-icon">
                    <i class="fas fa-comments"></i>
                </div>
                <h4>No testimonials yet</h4>
                <p>Be the first to share your experience with Laundrify!</p>
            </div>
        @endif
    </div>
</section>




<section class="about" id="about">
    <div class="container">
        <div class="about-content">
            <div class="about-text">
                <h2>About Laundrify</h2>
                <p>Laundrify was founded with a simple mission: to make laundry day stress-free for our customers. We combine cutting-edge technology with eco-friendly practices to deliver the best laundry experience possible.</p>
                <p>Our team of experienced professionals is dedicated to providing top-quality service, ensuring that your clothes are treated with the utmost care and attention to detail.</p>
            </div>
            <div class="about-image">
                <img src="{{ asset('images/about-image.jpeg') }}" alt="About Laundrify">
            </div>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content" data-aos="fade-up">
            <div class="cta-text">
                <h2 class="cta-title">Ready to Experience Premium Laundry Services?</h2>
                <p class="cta-description">
                    Join thousands of satisfied customers who trust Laundrify for their laundry needs. 
                    Get started today and enjoy the convenience of professional laundry services at your doorstep.
                </p>
                <div class="cta-actions">
                    <a href="#services" class="btn btn-primary btn-lg">
                        <i class="fas fa-rocket me-2"></i>
                        Get Started Now
                    </a>
                    <a href="#about" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-info-circle me-2"></i>
                        Learn More
                    </a>
                </div>
            </div>
            <div class="cta-visual">
                <div class="cta-image">
                    <i class="fas fa-tshirt"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Enhanced Footer -->
<footer class="footer-section">
    <div class="footer-wave">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#1a202c" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,165.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
    
    <div class="footer-content">
        <div class="container">
            <div class="footer-grid">
                <!-- Company Info -->
                <div class="footer-section">
                    <div class="footer-logo">
                        <div class="logo-container">
                            <i class="fas fa-tshirt logo-icon"></i>
                            <span class="logo-text">Laundrify</span>
                        </div>
                    </div>
                    <p class="footer-description">
                        Your trusted partner for premium laundry services. We combine technology with care to deliver exceptional results every time.
                    </p>
                    <div class="social-links">
                        <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="footer-section">
                    <h5 class="footer-title">Quick Links</h5>
                    <ul class="footer-links">
                        <li><a href="#home">Home</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#testimonials">Testimonials</a></li>
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    </ul>
                </div>

                <!-- Services -->
                <div class="footer-section">
                    <h5 class="footer-title">Our Services</h5>
                    <ul class="footer-links">
                        <li><a href="#">Dry Cleaning</a></li>
                        <li><a href="#">Wash & Iron</a></li>
                        <li><a href="#">Express Service</a></li>
                        <li><a href="#">Bulk Orders</a></li>
                        <li><a href="#">Pickup & Delivery</a></li>
                        <li><a href="#">Stain Removal</a></li>
                    </ul>
                </div>

                <!-- Contact & Newsletter -->
                <div class="footer-section">
                    <h5 class="footer-title">Stay Updated</h5>
                    <p class="newsletter-text">Subscribe to our newsletter for exclusive offers and updates.</p>
                    <form class="newsletter-form">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Enter your email" required>
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                    <div class="contact-info">
                        <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <span>+92 300 1234567</span>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <span>info@laundrify.com</span>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Lahore, Pakistan</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <div class="footer-bottom-content">
                    <p>&copy; 2025 Laundrify. All rights reserved.</p>
                    <div class="footer-bottom-links">
                        <a href="#">Privacy Policy</a>
                        <a href="#">Terms of Service</a>
                        <a href="#">Cookie Policy</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Font Awesome for Icons -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

</body>

<script>
    document.querySelector('.fas.fa-bell').addEventListener('click', function() {
        document.querySelector('.dropdown-menu').classList.toggle('show');
    });
</script>

<script>
    // Initialize AOS (Animate On Scroll)
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            offset: 100
        });
        
        // Initialize Bootstrap tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
        
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar-main');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
        
        // Counter animation
        const counters = document.querySelectorAll('.stat-number');
        const speed = 200;
        
        const animateCounter = (counter) => {
            const target = parseInt(counter.getAttribute('data-count'));
            const count = parseInt(counter.innerText);
            const increment = target / speed;
            
            if (count < target) {
                counter.innerText = Math.ceil(count + increment);
                setTimeout(() => animateCounter(counter), 1);
            } else {
                counter.innerText = target;
            }
        };
        
        // Intersection Observer for counter animation
        const observerOptions = {
            threshold: 0.5,
            rootMargin: '0px 0px -100px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counter = entry.target;
                    animateCounter(counter);
                    observer.unobserve(counter);
                }
            });
        }, observerOptions);
        
        counters.forEach(counter => {
            observer.observe(counter);
        });
        
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    });
</script>

<script>
// Initialize toasts
document.addEventListener('DOMContentLoaded', function() {
    var toastElList = [].slice.call(document.querySelectorAll('.toast'));
    var toastList = toastElList.map(function(toastEl) {
        return new bootstrap.Toast(toastEl, {
            autohide: true,
            delay: 5000
        }).show();
    });
    
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Mobile menu toggle
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    
    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', function() {
            mobileMenu.classList.toggle('active');
            mobileMenuBtn.querySelector('i').classList.toggle('fa-bars');
            mobileMenuBtn.querySelector('i').classList.toggle('fa-times');
        });
    }
});

// Function to search for services
function searchServices() {
    let searchTerm = document.getElementById('serviceSearch').value;
    let resultContainer = document.getElementById('searchResults');

    if (searchTerm.length >= 3) {
        fetch(`/search-services?q=${searchTerm}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                let results = data.services || [];
                resultContainer.innerHTML = '';

                if (results.length > 0) {
                    resultContainer.style.display = 'block';  // Show results container
                    results.forEach(service => {
                        let name = service.service_name || "Unnamed Service";
                        let description = service.service_description || "No description available";

                        resultContainer.innerHTML += `
                            <div class="service-item">
                                <h5>${name}</h5>
                                <p>${description}</p>
                            </div>
                        `;
                    });
                } else {
                    resultContainer.style.display = 'block';  // Still show container with no results message
                    resultContainer.innerHTML = '<p class="no-results">No services found.</p>';
                }
            })
            .catch(error => {
                console.error('Error fetching search results:', error);
                resultContainer.style.display = 'block';  // Show container with error message
                resultContainer.innerHTML = '<p class="search-error">An error occurred while searching. Please try again.</p>';
            });
    } else {
        resultContainer.style.display = 'none';  // Hide results if search term is too short
        resultContainer.innerHTML = '';
    }
}

// Function to toggle the visibility of search results
function toggleSearchResults() {
    let searchTerm = document.getElementById('serviceSearch').value;
    let resultContainer = document.getElementById('searchResults');
    
    if (searchTerm.length >= 3) {
        resultContainer.style.display = 'block';  // Show only if there's a valid search term
    }
}

// Function to handle click outside of search bar
document.addEventListener('click', function(event) {
    const searchBar = document.getElementById('serviceSearch');
    const resultContainer = document.getElementById('searchResults');

    // Hide results if clicked outside search bar and results container
    if (searchBar && resultContainer && !searchBar.contains(event.target) && !resultContainer.contains(event.target)) {
        resultContainer.style.display = 'none';
    }
});

var swiper = new Swiper('.swiper-container', {
    slidesPerView: 1,
    spaceBetween: 20,
    loop: true,
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    autoplay: {
        delay: 3000,
    },
    breakpoints: {
        640: {
            slidesPerView: 1,
        },
        768: {
            slidesPerView: 2,
        },
        1024: {
            slidesPerView: 3,
        },
    }
});
</script>


<script>
    document.querySelectorAll('.notification-link').forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            const notificationId = this.closest('.dropdown-item').dataset.id;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch(`/notifications/${notificationId}/mark-as-read`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ _method: 'PATCH' })
            }).then(response => {
                if (response.ok) {
                    this.closest('.dropdown-item').classList.remove('unread');
                    this.closest('.dropdown-item').classList.add('read');
                    const countElement = document.querySelector('.notification-count');
                    let count = parseInt(countElement.textContent);
                    countElement.textContent = count - 1;
                    window.location.href = this.href;
                }
            });
        });
    });

    
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        autoplay: {
            delay: 3000,
        },
    });

</script>
</html>