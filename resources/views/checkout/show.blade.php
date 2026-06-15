<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <title>Checkout - Tiffin Time</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/styleHome.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        .checkout-container {
            margin-top: 50px;
            margin-bottom: 50px;
            min-height: calc(100vh - 300px);
        }

        .page-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark-color);
            text-align: center;
            margin-bottom: 2rem;
            position: relative;
        }

        .page-title::after {
            content: '';
            position: absolute;
            bottom: -12px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: linear-gradient(90deg, var(--primary-color), var(--primary-dark));
            border-radius: 2px;
        }

        .checkout-form {
            background-color: var(--white);
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow-md);
            padding: 30px;
            margin-bottom: 30px;
        }

        .form-label {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-control {
            height: 50px;
            border: 1px solid var(--light-gray);
            border-radius: var(--border-radius-md);
            padding: 10px 15px;
            font-size: 16px;
            transition: all var(--transition-normal);
        }

        .form-control:focus {
            box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
            border-color: var(--primary-color);
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--light-gray);
        }

        .payment-methods {
            margin-top: 20px;
        }

        .payment-option {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .payment-option input[type="radio"] {
            margin-right: 10px;
        }

        .payment-option label {
            font-weight: 500;
            color: var(--dark-color);
            cursor: pointer;
        }

        .payment-services {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }

        .payment-card {
            flex: 1;
            border: 2px solid var(--light-gray);
            border-radius: var(--border-radius-md);
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: all var(--transition-normal);
        }

        .payment-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-sm);
        }

        .payment-card.active {
            border-color: var(--primary-color);
            background-color: var(--primary-light);
        }

        .payment-card-title {
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 5px;
        }

        .payment-card-account {
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .order-summary {
            background-color: var(--white);
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow-md);
            padding: 30px;
        }

        .order-item {
            margin-bottom: 15px;
        }

        .order-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid var(--light-gray);
        }

        .order-row:last-child {
            border-bottom: none;
        }

        .item-name {
            font-weight: 500;
            color: var(--dark-color);
        }

        .item-price {
            font-weight: 600;
            color: var(--primary-color);
        }

        .order-total {
            display: flex;
            justify-content: space-between;
            padding: 15px 0;
            margin-top: 15px;
            border-top: 2px solid var(--light-gray);
        }

        .total-label {
            font-weight: 700;
            color: var(--dark-color);
            font-size: 1.1rem;
        }

        .total-value {
            font-weight: 700;
            color: var(--primary-color);
            font-size: 1.3rem;
        }

        .place-order-btn {
            background: linear-gradient(to right, var(--primary-color), var(--primary-dark));
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: var(--border-radius-md);
            font-size: 1.1rem;
            font-weight: 600;
            width: 100%;
            margin-top: 20px;
            transition: all var(--transition-normal);
        }

        .place-order-btn:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
            background: linear-gradient(to right, var(--primary-dark), var(--primary-color));
        }


        @media (max-width: 768px) {
            .payment-services {
                flex-direction: column;
            }

            .checkout-form,
            .order-summary {
                padding: 20px;
            }
        }
    </style>
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
                    <a href="{{ route('cart.view') }}" class="nav-link">
                        <i class="fas fa-shopping-cart"></i> Cart
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="container checkout-container">
        @php
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['quantity'] * $item['price'];
            }
        @endphp
        <h1 class="page-title">Checkout</h1>

        <div class="row">
            <div class="col-lg-7">
                <form action="{{ route('checkout.place') }}" method="POST" id="checkout-form">
                    @csrf
                    <div class="checkout-form">
                        <h3 class="section-title">Delivery Information</h3>

                        <div class="row mb-4">
                            <div class="col-md-12 mb-3">
                                <label for="address" class="form-label">Delivery Address</label>
                                <input type="text" name="address" id="address" class="form-control"
                                    placeholder="Enter your full address" required>
                                <div id="address-error" class="text-danger mt-1" style="display: none;">Please enter
                                    your address</div>
                            </div>

                            <div class="col-md-12">
                                <label for="phone" class="form-label">Contact Number</label>
                                <input type="text" name="phone" id="phone" class="form-control"
                                    placeholder="Enter your phone number" required>
                                <div id="phone-error" class="text-danger mt-1" style="display: none;">Please enter your
                                    phone number</div>
                            </div>
                        </div>

                        <h3 class="section-title">Payment Method</h3>

                        <div class="payment-methods">
                            <div class="payment-option mb-3">
                                <input type="radio" name="payment_method" value="cod" id="cod" checked>
                                <label for="cod" class="fs-5 ms-2" style="cursor: pointer;"><i class="fas fa-money-bill-wave text-success me-2"></i> Cash on Delivery</label>
                            </div>

                            @php
                                $hasEasypaisa = $seller && !empty($seller->easypaisa_title) && !empty($seller->easypaisa_number);
                                $hasJazzcash = $seller && !empty($seller->jazzcash_title) && !empty($seller->jazzcash_number);
                                $hasOnlinePayment = $hasEasypaisa || $hasJazzcash;
                            @endphp

                            <div class="payment-option mb-3">
                                <input type="radio" name="payment_method" value="online" id="online" {{ !$hasOnlinePayment ? 'disabled' : '' }}>
                                <label for="online" class="fs-5 ms-2 {{ !$hasOnlinePayment ? 'text-muted' : '' }}" style="cursor: {{ $hasOnlinePayment ? 'pointer' : 'not-allowed' }};">
                                    <i class="fas fa-credit-card text-primary me-2"></i> Online Payment
                                    @if(!$hasOnlinePayment)
                                        <small class="text-danger d-block ms-4 animate__animated animate__shakeX" style="font-size: 0.8rem;">(Unavailable: Seller hasn't configured payment details)</small>
                                    @endif
                                </label>
                            </div>
                        </div>

                        <!-- Online Payment Section (hidden by default) -->
                        <div id="online-payment-details" style="display: none;" class="mt-4 p-4 rounded-4 border bg-light animate__animated animate__fadeIn">
                            <h5 class="fw-bold mb-3 text-dark"><i class="fas fa-university text-primary me-2"></i> Select Payment Platform</h5>
                            
                            <div class="d-flex gap-3 mb-4">
                                @if($hasEasypaisa)
                                    <div class="flex-grow-1">
                                        <input type="radio" name="online_payment_platform" value="easypaisa" id="platform-easypaisa" class="btn-check" checked>
                                        <label class="btn btn-outline-success w-100 py-3 rounded-3 fw-bold" for="platform-easypaisa">
                                            <i class="fas fa-wallet me-2"></i> EasyPaisa
                                        </label>
                                    </div>
                                @endif
                                
                                @if($hasJazzcash)
                                    <div class="flex-grow-1">
                                        <input type="radio" name="online_payment_platform" value="jazzcash" id="platform-jazzcash" class="btn-check" {{ !$hasEasypaisa ? 'checked' : '' }}>
                                        <label class="btn btn-outline-warning w-100 py-3 rounded-3 fw-bold text-dark" for="platform-jazzcash">
                                            <i class="fas fa-wallet me-2"></i> JazzCash
                                        </label>
                                    </div>
                                @endif
                            </div>

                            <!-- EasyPaisa Account Details -->
                            @if($hasEasypaisa)
                                <div id="details-easypaisa" class="platform-details-card p-3 mb-4 rounded-3 border bg-white animate__animated animate__fadeIn" style="display: none; border-color: #2ecc71;">
                                    <div class="d-flex align-items-center gap-2 mb-2 text-success">
                                        <i class="fas fa-info-circle"></i>
                                        <strong class="text-uppercase">EasyPaisa Account</strong>
                                    </div>
                                    <div class="mb-2"><strong>Account Title:</strong> <span class="text-dark">{{ $seller->easypaisa_title }}</span></div>
                                    <div class="mb-2"><strong>Account / Mobile Number:</strong> <span class="text-dark fw-bold">{{ $seller->easypaisa_number }}</span></div>
                                    <small class="text-muted d-block mt-2"><i class="fas fa-info-circle me-1"></i> Send <strong>{{ $total }} PKR</strong> to the EasyPaisa account above, then enter the Transaction ID (UID) below.</small>
                                </div>
                            @endif

                            <!-- JazzCash Account Details -->
                            @if($hasJazzcash)
                                <div id="details-jazzcash" class="platform-details-card p-3 mb-4 rounded-3 border bg-white animate__animated animate__fadeIn" style="display: none; border-color: #f39c12;">
                                    <div class="d-flex align-items-center gap-2 mb-2 text-warning">
                                        <i class="fas fa-info-circle"></i>
                                        <strong class="text-uppercase">JazzCash Account</strong>
                                    </div>
                                    <div class="mb-2"><strong>Account Title:</strong> <span class="text-dark">{{ $seller->jazzcash_title }}</span></div>
                                    <div class="mb-2"><strong>Account / Mobile Number:</strong> <span class="text-dark fw-bold">{{ $seller->jazzcash_number }}</span></div>
                                    <small class="text-muted d-block mt-2"><i class="fas fa-info-circle me-1"></i> Send <strong>{{ $total }} PKR</strong> to the JazzCash account above, then enter the Transaction ID (UID) below.</small>
                                </div>
                            @endif

                            <!-- Transaction ID Input -->
                            <div class="mb-3">
                                <label for="transaction_id" class="form-label fw-bold"><i class="fas fa-receipt me-1"></i> Transaction ID (UID) <span class="text-danger">*</span></label>
                                <input type="text" name="transaction_id" id="transaction_id" class="form-control rounded-3" placeholder="Enter the 11 or 12 digit transaction UID">
                                <div id="transaction-error" class="text-danger mt-1" style="display: none;">Please enter the transaction UID</div>
                            </div>
                        </div>

                        <!-- No need for service_id since we process all cart items -->
                </form>
            </div>

            <div class="col-lg-5">
                <div class="order-summary">
                    <h3 class="section-title">Order Summary</h3>

                    <div class="order-item">
                        @php $total = 0; @endphp
                        @foreach ($cart as $item)
                            <div class="order-row">
                                <span class="item-name">{{ $item['name'] }} ({{ $item['quantity'] }}x)</span>
                                <span class="item-price">{{ $item['quantity'] * $item['price'] }} PKR</span>
                            </div>
                            @php $total += $item['quantity'] * $item['price']; @endphp
                        @endforeach
                    </div>

                    <div class="order-total">
                        <span class="total-label">Total</span>
                        <span class="total-value">{{ $total }} PKR</span>
                    </div>

                    <button type="submit" class="place-order-btn" form="checkout-form">
                        <i class="fas fa-check-circle me-2"></i> Place Order
                    </button>
                </div>
            </div>
        </div>
    </div>

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
        document.getElementById('checkout-form').addEventListener('submit', function (e) {
            e.preventDefault();
            const address = document.getElementById('address');
            const phone = document.getElementById('phone');
            const paymentMethodInput = document.querySelector('input[name="payment_method"]:checked');
            const paymentMethod = paymentMethodInput ? paymentMethodInput.value : 'cod';
            let isValid = true;

            // Reset validation messages
            const addressError = document.getElementById('address-error');
            const phoneError = document.getElementById('phone-error');
            const transactionError = document.getElementById('transaction-error');

            if (addressError) addressError.style.display = 'none';
            if (phoneError) phoneError.style.display = 'none';
            if (transactionError) transactionError.style.display = 'none';

            // Validate address
            if (address.value.trim() === '') {
                if (addressError) addressError.style.display = 'block';
                isValid = false;
            }

            // Validate phone
            if (phone.value.trim() === '') {
                if (phoneError) phoneError.style.display = 'block';
                isValid = false;
            }

            // Validate Transaction UID if Online payment is selected
            if (paymentMethod === 'online') {
                const transactionId = document.getElementById('transaction_id');
                if (!transactionId || transactionId.value.trim() === '') {
                    if (transactionError) {
                        transactionError.textContent = 'Transaction ID is required for online payments.';
                        transactionError.style.display = 'block';
                    }
                    isValid = false;
                } else if (transactionId.value.trim().length < 8) {
                    if (transactionError) {
                        transactionError.textContent = 'Please enter a valid Transaction ID.';
                        transactionError.style.display = 'block';
                    }
                    isValid = false;
                }
            }

            if (isValid) {
                this.submit();
            }
        });

        // Toggle payment options visibility
        const paymentMethodRadios = document.querySelectorAll('input[name="payment_method"]');
        const onlinePaymentDetails = document.getElementById('online-payment-details');
        const platformRadios = document.querySelectorAll('input[name="online_payment_platform"]');

        function togglePaymentDetails() {
            const checkedPaymentMethod = document.querySelector('input[name="payment_method"]:checked');
            if (checkedPaymentMethod && checkedPaymentMethod.value === 'online') {
                onlinePaymentDetails.style.display = 'block';
                togglePlatformDetails();
            } else {
                onlinePaymentDetails.style.display = 'none';
            }
        }

        function togglePlatformDetails() {
            const selectedPlatform = document.querySelector('input[name="online_payment_platform"]:checked');
            document.querySelectorAll('.platform-details-card').forEach(card => {
                card.style.display = 'none';
            });
            if (selectedPlatform) {
                const detailsCard = document.getElementById('details-' + selectedPlatform.value);
                if (detailsCard) {
                    detailsCard.style.display = 'block';
                }
            }
        }

        paymentMethodRadios.forEach(radio => {
            radio.addEventListener('change', togglePaymentDetails);
        });

        platformRadios.forEach(radio => {
            radio.addEventListener('change', togglePlatformDetails);
        });

        // Run toggle logic on load
        togglePaymentDetails();

    </script>
</body>

</html>