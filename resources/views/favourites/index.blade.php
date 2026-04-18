<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Favourites - Tiffin Time</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/styleHome.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .page-header {
            background: linear-gradient(135deg, #E23744, #FF6B35);
            color: white;
            padding: 40px 0;
            border-radius: var(--border-radius-lg);
            margin-bottom: 40px;
        }

        .service-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            height: 100%;
            background-color: var(--white);
            position: relative;
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
            color: #e02424; /* Red color for filled heart */
        }
    </style>
</head>

<body>
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
                    <a href="{{ route('cart.view') }}" class="nav-link">
                        <i class="fas fa-shopping-cart"></i> Cart
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="container mt-5">
        <div class="page-header text-center shadow-lg">
            <h1 class="fw-bold"><i class="fas fa-heart text-white me-2"></i> My Favourites</h1>
            <p>Your saved home-cooked meals</p>
        </div>

        @if($favourites->isEmpty())
            <div class="text-center py-5">
                <i class="far fa-heart text-muted mb-3" style="font-size: 4rem; opacity: 0.5;"></i>
                <h3 class="text-muted">You have no favourites yet.</h3>
                <p class="text-muted mb-4">Start exploring services and save the ones you love!</p>
                <a href="{{ route('home') }}#services" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm">Explore Meals</a>
            </div>
        @else
            <div class="row g-4 mb-5">
                @foreach($favourites as $service)
                    <div class="col-md-6 col-lg-4 d-flex align-items-stretch" id="service-card-{{ $service->id }}">
                        <div class="service-card w-100 d-flex flex-column">
                            <div class="service-img-container position-relative">
                                @if($service->image)
                                    <img src="{{ '/storage/' . $service->image }}" alt="{{ $service->service_name }}" class="service-img w-100 h-100">
                                @else
                                    <div class="d-flex justify-content-center align-items-center h-100 bg-light">
                                        <i class="fas fa-utensils text-secondary" style="font-size: 3rem;"></i>
                                    </div>
                                @endif

                                <!-- Heart Toggle -->
                                <button class="heart-btn" onclick="toggleFavourite({{ $service->id }}, this)">
                                    <i class="fas fa-heart"></i>
                                </button>
                                
                                <div class="position-absolute bottom-0 start-0 w-100 p-2" style="background: linear-gradient(transparent, rgba(0,0,0,0.7));">
                                    <span class="badge bg-dark">{{ $service->seller->name ?? 'Unknown Seller' }}</span>
                                </div>
                            </div>

                            <div class="card-body d-flex flex-column p-4">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h3 class="service-title h5 fw-bold mb-0 text-dark">{{ $service->service_name }}</h3>
                                    <div class="service-price text-primary fw-bold h5 mb-0" style="color: black !important;">
                                        {{ $service->service_price }} <small>PKR</small>
                                    </div>
                                </div>

                                <p class="service-description text-muted small flex-grow-1">
                                    {{ Str::limit($service->service_description, 80) }}
                                </p>

                                <div class="mt-3">
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="service_id" value="{{ $service->id }}">
                                        <button type="submit" class="btn btn-primary w-100 fw-bold shadow-sm" style="border-radius: 8px;">
                                            <i class="fas fa-cart-plus me-2"></i> Add to Cart
                                        </button>
                                    </form>
                                    <a href="{{ route('sellers.services', $service->seller_id) }}" class="btn btn-outline-secondary w-100 fw-bold shadow-sm mt-2" style="border-radius: 8px;">
                                        View Seller
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <footer>
        <div class="container">
            <div class="text-center p-4 mt-5 border-top">
                <p>&copy; 2026 Tiffin Time. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleFavourite(serviceId, btnElement) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            // Optimistic UI update or disable button while loading
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
                if(data.status === 'removed') {
                    // Instantly remove card from DOM
                    const card = document.getElementById('service-card-' + serviceId);
                    if(card) {
                        card.style.transition = 'opacity 0.3s ease';
                        card.style.opacity = '0';
                        setTimeout(() => card.remove(), 300);
                        
                        // Check if it was the last item to show empty state
                        const remainingCards = document.querySelectorAll('[id^="service-card-"]');
                        if (remainingCards.length <= 1) {
                            setTimeout(() => window.location.reload(), 300);
                        }
                    }
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
            const toastMessage = document.getElementById('toastMessage');
            
            toastEl.className = `toast align-items-center text-white bg-${type} border-0`;
            
            let icon = type === 'success' ? 'fa-check-circle' : 'fa-info-circle';
            toastMessage.innerHTML = `<i class="fas ${icon} me-2"></i> ${message}`;
            
            const toast = new bootstrap.Toast(toastEl, { delay: 3000 });
            toast.show();
        }
    </script>
</body>
</html>
