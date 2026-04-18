<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiffin Time - Home-cooked Meal Service</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/styleHome.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
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
            background: linear-gradient(135deg, #E23744, #FF6B35);
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
            background: linear-gradient(135deg, #E23744, #FF6B35);
            border-radius: 8px;
        }
    </style>
</head>

<body>
    {{--
    <pre>{{ var_dump(session()->all()) }}</pre> --}}
    <!-- Toast notification container - fixed position that doesn't overflow -->
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1080; margin-top: 70px;">
        @if(session('success'))
            <div class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
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
                            <i class="fas fa-utensils logo-icon"></i>
                            <span class="logo-text">Tiffin Time</span>
                            <span class="logo-badge">Pro</span>
                        </div>
                    </a>
                </div>

                <div class="search-bar">
                    <div class="search-wrapper">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" id="serviceSearch" placeholder="Search for services..."
                            onkeyup="searchServices()" onclick="toggleSearchResults()" />
                    </div>
                    <div id="searchResults" class="search-results" style="display: none;"></div>
                </div>

                <div class="nav-links">
                    <a href="#home" class="nav-link active">Home</a>
                    <a href="#sellers" class="nav-link">Sellers</a>
                    <a href="#services" class="nav-link">Services</a>
                    <a href="#about" class="nav-link">About</a>
                </div>

                <div class="header-cta d-none d-md-flex">
                    <a href="{{ route('register.seller') }}" class="btn btn-cta-primary">
                        <i class="fas fa-store me-2"></i>Become a Vendor
                    </a>
                    <a href="#app" class="btn btn-cta-outline">
                        <i class="fas fa-mobile-alt me-2"></i>Get App
                    </a>
                </div>

                <div class="nav-actions">

                    <!-- User profile dropdown with improved styling -->
                    <div class="profile-dropdown dropdown">
                        @auth
                            @php
                                $profileUpdate = \App\Models\UserProfileUpdate::where('user_id', Auth::id())->first();
                            @endphp
                            <button class="profile-btn" type="button" id="profileDropdown" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                @if ($profileUpdate && $profileUpdate->profile_image)
                                    <img src="{{ asset('storage/' . $profileUpdate->profile_image) }}" alt="Profile Image"
                                        class="profile-img">
                                @else
                                    <div class="profile-avatar">
                                        <i class="fas fa-user"></i>
                                    </div>
                                @endif
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end profile-menu" aria-labelledby="profileDropdown">
                                <li class="dropdown-header">Welcome, {{ Auth::user()->name }}!</li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('favourites.index') }}"><i class="fas fa-heart text-danger me-2"></i>My Favourites</a></li>
                                <li><a class="dropdown-item" href="{{ route('order.all') }}"><i class="fas fa-shopping-bag me-2"></i>My Orders</a></li>
                                <li><a class="dropdown-item" href="{{ route('order.history') }}"><i class="fas fa-history me-2"></i>Order History</a></li>
                                <li><hr class="dropdown-divider"></li>
                                @if(Auth::user()->sellerType == 1)
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i
                                                class="fas fa-tachometer-alt me-2"></i>Admin Dashboard</a></li>
                                @elseif(Auth::user()->sellerType == 3)
                                    <li><a class="dropdown-item" href="{{ route('seller.panel') }}"><i
                                                class="fas fa-store me-2"></i>Seller Panel</a></li>
                                @endif
                                <li><a class="dropdown-item" href="{{ route('register.seller') }}"><i
                                            class="fas fa-user-plus me-2"></i>Register as Seller</a></li>
                                <li><a class="dropdown-item" href="{{ route('login.seller') }}"><i
                                            class="fas fa-sign-in-alt me-2"></i>Login as Seller</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item"><i
                                                class="fas fa-sign-out-alt me-2"></i>Logout</button>
                                    </form>
                                </li>
                            </ul>
                        @else
                            <button class="profile-btn" type="button" id="profileDropdown" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <div class="profile-avatar">
                                    <i class="fas fa-user"></i>
                                </div>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end profile-menu" aria-labelledby="profileDropdown">
                                <li><a class="dropdown-item" href="{{ route('login') }}"><i
                                            class="fas fa-sign-in-alt me-2"></i>Login</a></li>
                                <li><a class="dropdown-item" href="{{ route('register') }}"><i
                                            class="fas fa-user-plus me-2"></i>Register</a></li>
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
                    <a href="{{ route('favourites.index') }}"><i class="fas fa-heart text-danger me-1"></i>My Favourites</a>
                    <a href="{{ route('order.all') }}">My Orders</a>
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

    <!-- Zomato Style Hero Section -->
    <section class="zomato-hero-section" id="home">
        <div class="zomato-hero-container">
            <div class="zomato-hero-content">
                <h1 class="zomato-hero-title">Find the best Tiffin Services</h1>
                <p class="zomato-hero-subtitle">Discover home-cooked meals from verified vendors</p>

                <!-- Zomato Style Search Bar -->
                <div class="zomato-search-container">
                    <div class="zomato-location-selector">
                        <i class="fas fa-map-marker-alt"></i>
                        <select class="zomato-location-dropdown">
                            <option>Karachi, Pakistan</option>
                            <option>Lahore, Pakistan</option>
                            <option>Islamabad, Pakistan</option>
                        </select>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="zomato-search-divider"></div>
                    <div class="zomato-search-input-wrapper">
                        <i class="fas fa-search"></i>
                        <input type="text" class="zomato-search-input"
                            placeholder="Search for tiffin services, meals, cuisines..." id="serviceSearch"
                            onkeyup="searchServices()" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Categories Grid (Zomato Style) -->
    <section class="zomato-categories-section">
        <div class="container">
            <div class="zomato-categories-grid">
                <a class="zomato-category-card zomato-category-card--bg"
                    style="--cat-img:url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQQOQY51mHZNUxClEfPmhIPByh_oa-XHHoMDw&s');">
                    <span class="zomato-category-name">All Meals</span>
                </a>
                <a class="zomato-category-card zomato-category-card--bg"
                    style="--cat-img:url('https://images.unsplash.com/photo-1498654200943-1088dd4438ae?q=80&w=1200&auto=format&fit=crop');">
                    <span class="zomato-category-name">Lunch</span>
                </a>
                <a class="zomato-category-card zomato-category-card--bg"
                    style="--cat-img:url('https://images.unsplash.com/photo-1504754524776-8f4f37790ca0?q=80&w=1200&auto=format&fit=crop');">
                    <span class="zomato-category-name">Breakfast</span>
                </a>
                <a class="zomato-category-card zomato-category-card--bg"
                    style="--cat-img:url('https://images.unsplash.com/photo-1551218808-94e220e084d2?q=80&w=1200&auto=format&fit=crop');">
                    <span class="zomato-category-name">Dinner</span>
                </a>
                <a class="zomato-category-card zomato-category-card--bg"
                    style="--cat-img:url('https://images.unsplash.com/photo-1555939594-58d7cb561ad1?q=80&w=1200&auto=format&fit=crop');">
                    <span class="zomato-category-name">Quick Meals</span>
                </a>
                <a class="zomato-category-card zomato-category-card--bg"
                    style="--cat-img:url('https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?q=80&w=1200&auto=format&fit=crop');">
                    <span class="zomato-category-name">Healthy</span>
                </a>
                <a class="zomato-category-card zomato-category-card--bg"
                    style="--cat-img:url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQci9Ye-TyGngL4SGmAlVobiJOLxbb37T5lIQ&s');">
                    <span class="zomato-category-name">Spicy</span>
                </a>
                <a class="zomato-category-card zomato-category-card--bg"
                    style="--cat-img:url('https://batonrougeclinic.com/wp-content/uploads/2021/10/Baldwin-10.-The-Pros-and-Cons-of-Vegetarian-Diets.jpg');">
                    <span class="zomato-category-name">Vegetarian</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Featured Dishes Carousel -->
    <section class="featured-dishes-section">
        <div class="container">
            <div class="section-header text-center">
                <h2 class="section-title">Featured Dishes</h2>
                <p class="section-subtitle">Popular picks from our top tiffin providers</p>
            </div>

            <div class="swiper-container featured-dishes-swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="dish-card">
                            <img src="https://images.unsplash.com/photo-1498654896293-37aacf113fd9?q=80&w=1200&auto=format&fit=crop"
                                alt="Biryani" class="dish-image">
                            <div class="dish-info">
                                <h5 class="dish-title">Chicken Biryani</h5>
                                <p class="dish-meta">Spiced rice with tender chicken</p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="dish-card">
                            <img src="https://i.ytimg.com/vi/3rkXplTcAOA/maxresdefault.jpg" alt="Paratha"
                                class="dish-image">
                            <div class="dish-info">
                                <h5 class="dish-title">Aloo Paratha</h5>
                                <p class="dish-meta">Stuffed flatbread with yogurt</p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="dish-card">
                            <img src="https://images.unsplash.com/photo-1567188040759-fb8a883dc6d8?q=80&w=1200&auto=format&fit=crop"
                                alt="Curry" class="dish-image">
                            <div class="dish-info">
                                <h5 class="dish-title">Paneer Curry</h5>
                                <p class="dish-meta">Rich tomato-based gravy</p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="dish-card">
                            <img src="https://vegecravings.com/wp-content/uploads/2018/01/Dal-Tadka-Recipe-Step-By-Step-Instructions-1024x822.jpg.webp"
                                alt="Daal" class="dish-image">
                            <div class="dish-info">
                                <h5 class="dish-title">Daal Tadka</h5>
                                <p class="dish-meta">Comforting lentils with tempering</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    <!-- Trending Collections (large visual tiles) -->
    <section class="trending-collections-section">
        <div class="container">
            <div class="section-header d-flex justify-content-between align-items-end flex-wrap gap-2">
                <div>
                    <h2 class="section-title mb-1">Trending Collections</h2>
                    <p class="section-subtitle mb-0">Curated sets of dishes you’ll love</p>
                </div>
                <a href="#" class="btn btn-outline-light-emphasis btn-sm">View all</a>
            </div>

            <div class="collections-grid">
                <a class="collection-card"
                    style="--bg:url('https://images.unsplash.com/photo-1525755662778-989d0524087e?q=80&w=1400&auto=format&fit=crop');">
                    <div class="collection-overlay"></div>
                    <div class="collection-info">
                        <h3>Comfort Curries</h3>
                        <span>12 places</span>
                    </div>
                </a>
                <a class="collection-card"
                    style="--bg:url('https://images.unsplash.com/photo-1544025162-d76694265947?q=80&w=1400&auto=format&fit=crop');">
                    <div class="collection-overlay"></div>
                    <div class="collection-info">
                        <h3>Paratha & Chai</h3>
                        <span>9 places</span>
                    </div>
                </a>
                <a class="collection-card"
                    style="--bg:url('https://images.unsplash.com/photo-1512058564366-18510be2db19?q=80&w=1400&auto=format&fit=crop');">
                    <div class="collection-overlay"></div>
                    <div class="collection-info">
                        <h3>Healthy Veg Bowls</h3>
                        <span>14 places</span>
                    </div>
                </a>
                <a class="collection-card"
                    style="--bg:url('https://images.unsplash.com/photo-1550547660-d9450f859349?q=80&w=1400&auto=format&fit=crop');">
                    <div class="collection-overlay"></div>
                    <div class="collection-info">
                        <h3>Quick Office Lunch</h3>
                        <span>18 places</span>
                    </div>
                </a>
            </div>
        </div>
        <div class="soft-divider"></div>

        <!-- Vendor logos strip -->
        <div class="container">
            <div class="vendor-strip">
                <div class="vendor-title">Trusted by local vendors</div>
                <div class="vendor-logos">
                    <img src="https://dummyimage.com/100x36/edeef2/111&text=Chef+A" alt="Vendor" />
                    <img src="https://dummyimage.com/100x36/edeef2/111&text=Home+Kitchen" alt="Vendor" />
                    <img src="https://dummyimage.com/100x36/edeef2/111&text=Desi+Meals" alt="Vendor" />
                    <img src="https://dummyimage.com/100x36/edeef2/111&text=Healthy+Bites" alt="Vendor" />
                    <img src="https://dummyimage.com/100x36/edeef2/111&text=Quick+Tiffin" alt="Vendor" />
                </div>
            </div>
        </div>
    </section>

    <!-- App Promo Banner -->
    <section class="app-promo">
        <div class="app-promo-bg"></div>
        <div class="container">
            <div class="app-promo-content">
                <div class="app-promo-text">
                    <h2>Order faster with the Tiffin Time app</h2>
                    <p>Save your favorites, track orders, and get notified about deals.</p>
                    <div class="store-badges">
                        <a href="#" class="badge-store">Get it on Google Play</a>
                        <a href="#" class="badge-store">Download on the App Store</a>
                    </div>
                </div>
                <div class="app-promo-visual">
                    <div class="phone-mock"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <div class="section-header text-center">
                <h2 class="section-title">Why Choose Tiffin Time?</h2>
                <p class="section-subtitle">Experience the joy of home-cooked meals delivered to your doorstep</p>
            </div>

            <div class="features-grid">
                <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-icon">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <h3 class="feature-title">Authentic Taste</h3>
                    <p class="feature-description">
                        Savor the authentic taste of home with meals prepared by passionate home chefs using traditional recipes.
                    </p>
                    <div class="feature-highlight">
                        <i class="fas fa-check"></i>
                        <span>Home-Cooked Goodness</span>
                    </div>
                </div>

                <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3 class="feature-title">Punctual Delivery</h3>
                    <p class="feature-description">
                        Never miss a meal with our reliable delivery service. Lunch and dinner delivered hot and on time.
                    </p>
                    <div class="feature-highlight">
                        <i class="fas fa-check"></i>
                        <span>Timely Service</span>
                    </div>
                </div>

                <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-icon">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <h3 class="feature-title">Healthy & Fresh</h3>
                    <p class="feature-description">
                        We prioritize your health with fresh ingredients, minimal oil, and zero preservatives in every meal.
                    </p>
                    <div class="feature-highlight">
                        <i class="fas fa-check"></i>
                        <span>Freshly Prepared</span>
                    </div>
                </div>

                <div class="feature-card" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-icon">
                        <i class="fas fa-sliders-h"></i>
                    </div>
                    <h3 class="feature-title">Flexible Subscriptions</h3>
                    <p class="feature-description">
                        Customize your meal plans. Choose from daily, weekly, or monthly subscriptions that suit your schedule.
                    </p>
                    <div class="feature-highlight">
                        <i class="fas fa-check"></i>
                        <span>Custom Plans</span>
                    </div>
                </div>

                <div class="feature-card" data-aos="fade-up" data-aos-delay="500">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="feature-title">Verified Kitchens</h3>
                    <p class="feature-description">
                        All our home chefs endure a strict verification process to ensure the highest standards of hygiene and safety.
                    </p>
                    <div class="feature-highlight">
                        <i class="fas fa-check"></i>
                        <span>100% Safe</span>
                    </div>
                </div>

                <div class="feature-card" data-aos="fade-up" data-aos-delay="600">
                    <div class="feature-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3 class="feature-title">Dedicated Support</h3>
                    <p class="feature-description">
                        Our friendly customer support team is always ready to assist you with your orders and preferences.
                    </p>
                    <div class="feature-highlight">
                        <i class="fas fa-check"></i>
                        <span>Instant Help</span>
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
                                        <img src="{{ asset('storage/' . $seller->profile_image) }}" alt="{{ $seller->name }}"
                                            class="img-fluid" style="object-fit: cover; width: 100%; height: 100%;">
                                    @else
                                        <i class="fas fa-user" style="font-size: 70px; color: #aaa;"></i>
                                    @endif
                                </div>
                                <div class="card-body text-center">
                                    <h5 class="card-title mb-1">{{ $seller->name }}
                                        @if($seller->isVerified())
                                            <i class="fas fa-circle-check" style="color:#1d4ed8;font-size:1rem;margin-left:4px;" title="Verified Seller"></i>
                                        @endif
                                    </h5>
                                    <p class="card-text"><strong>City:</strong> {{ $seller->city }}</p>
                                    <p class="card-text"><strong>Area:</strong> {{ $seller->area }}</p>
                                    <a href="{{ route('sellers.services', $seller->id) }}" class="btn btn-primary mt-3 w-100">
                                        <i class="fas fa-utensils me-2"></i>View Menu
                                    </a>
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
                <p class="section-subtitle">Discover a wide range of homemade tiffin meals tailored to your needs</p>
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
                        <i class="fas fa-utensils"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number" data-count="50000">0</div>
                        <div class="stat-label">Order Delivered</div>
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

    <!-- Testimonials Section removed -->




    <section class="about" id="about">
        <div class="container">
            <div class="about-content">
                <div class="about-text">
                    <h2>About Tiffin Time</h2>
                    <p>Tiffin Time connects customers with verified home chefs and tiffin providers, making healthy,
                        home-cooked meals accessible and convenient.</p>
                    <p>Our team of experienced professionals is dedicated to providing top-quality service, ensuring
                        that every meal is prepared with the utmost care and attention to detail.</p>
                </div>
                <div class="about-image">
                    <img src="{{ asset('https://5.imimg.com/data5/SELLER/Default/2021/5/UI/BS/UU/96558411/tiffin-service-500x500.jpg') }}"
                        alt="About Tiffin Time">
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content" data-aos="fade-up">
                <div class="cta-text">
                    <h2 class="cta-title">Ready to Enjoy Premium Home-cooked Meals?</h2>
                    <p class="cta-description">
                        Join thousands of satisfied customers who trust Tiffin Time for their daily meals.
                        Get started today and enjoy the convenience of fresh, homemade meals delivered to your door.
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
                        <i class="fas fa-utensils"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Enhanced Footer -->
    <footer class="footer-section">
        <div class="footer-wave">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#1a202c" fill-opacity="1"
                    d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,165.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
                </path>
            </svg>
        </div>

        <div class="footer-content">
            <div class="container">
                <div class="footer-grid">
                    <!-- Company Info -->
                    <div class="footer-section">
                        <div class="footer-logo">
                            <div class="logo-container">
                                <i class="fas fa-utensils logo-icon"></i>
                                <span class="logo-text">Tiffin Time</span>
                            </div>
                        </div>
                        <p class="footer-description">
                            Your trusted partner for premium home-cooked meals. We connect you with verified local
                            tiffin providers.
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
                            <li><a href="#">Tiffin Service</a></li>
                            <li><a href="#">Home Made Meal</a></li>
                            <li><a href="#">More Choices</a></li>
                            <li><a href="#">Bulk Orders</a></li>
                            <li><a href="#">Pickup & Delivery</a></li>
                            <li><a href="#">Healthy</a></li>
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
                                <span>info@tiffintime.com</span>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Karachi, Pakistan</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Bottom -->
                <div class="footer-bottom">
                    <div class="footer-bottom-content">
                        <p>&copy; 2026 Tiffin Time. All rights reserved.</p>
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
    document.querySelector('.fas.fa-bell').addEventListener('click', function () {
        document.querySelector('.dropdown-menu').classList.toggle('show');
    });
</script>

<script>
    // Initialize AOS (Animate On Scroll)
    document.addEventListener('DOMContentLoaded', function () {
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            offset: 100
        });

        // Initialize Bootstrap tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function () {
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
    document.addEventListener('DOMContentLoaded', function () {
        var toastElList = [].slice.call(document.querySelectorAll('.toast'));
        var toastList = toastElList.map(function (toastEl) {
            return new bootstrap.Toast(toastEl, {
                autohide: true,
                delay: 5000
            }).show();
        });

        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');

        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', function () {
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
    document.addEventListener('click', function (event) {
        const searchBar = document.getElementById('serviceSearch');
        const resultContainer = document.getElementById('searchResults');

        // Hide results if clicked outside search bar and results container
        if (searchBar && resultContainer && !searchBar.contains(event.target) && !resultContainer.contains(event.target)) {
            resultContainer.style.display = 'none';
        }
    });

    // Home sliders
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

    // Featured dishes slider
    var dishesSwiper = new Swiper('.featured-dishes-swiper', {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        pagination: {
            el: '.featured-dishes-swiper .swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.featured-dishes-swiper .swiper-button-next',
            prevEl: '.featured-dishes-swiper .swiper-button-prev',
        },
        autoplay: {
            delay: 3500,
        },
        breakpoints: {
            640: { slidesPerView: 1 },
            768: { slidesPerView: 2 },
            1024: { slidesPerView: 3 }
        }
    });
</script>


<script>
    document.querySelectorAll('.notification-link').forEach(link => {
        link.addEventListener('click', function (event) {
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