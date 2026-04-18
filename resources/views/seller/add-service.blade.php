<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Add New Menu | Tiffin Time</title>

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

        /* Form Container */
        .form-container {
            max-width: 900px;
            margin: 120px auto 60px;
            background: white;
            border-radius: 24px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            position: relative;
        }

        .form-header {
            background: var(--gradient);
            padding: 3rem 2rem;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .form-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('https://img.freepik.com/free-photo/fresh-ingredients-wooden-table_23-2148019331.jpg?w=1380&t=st=1672691234~exp=1672691834~hmac=d2432ec42831e5f8f87e5b2287950c45582f6e90196726391038166d11de067c');
            background-size: cover;
            background-position: center;
            opacity: 0.15;
        }

        .form-header-content {
            position: relative;
            z-index: 2;
        }

        .form-title {
            font-size: 2.2rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
        }

        .form-body {
            padding: 3rem 2.5rem;
        }

        .form-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }

        .form-control,
        .form-select {
            padding: 0.8rem 1rem;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            font-size: 1rem;
            transition: all 0.3s ease;
            background-color: #f9fafb;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(226, 55, 68, 0.1);
            background-color: white;
        }

        .input-group-text {
            border-radius: 12px;
            background-color: #f3f4f6;
            border: 1px solid #e5e7eb;
            color: #6b7280;
        }

        .btn-check:checked+.btn-outline-primary {
            background-color: var(--primary);
            border-color: var(--primary);
            color: white;
            box-shadow: 0 4px 10px rgba(226, 55, 68, 0.3);
        }

        .btn-outline-primary {
            color: #6b7280;
            border-color: #e5e7eb;
            font-weight: 500;
            padding: 0.6rem 1.2rem;
        }

        .btn-outline-primary:hover {
            background-color: #f3f4f6;
            color: var(--primary);
            border-color: var(--primary);
        }

        .form-switch .form-check-input {
            width: 3em;
            height: 1.5em;
        }

        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .image-upload-area {
            border: 2px dashed #e5e7eb;
            border-radius: 16px;
            padding: 2rem;
            text-align: center;
            background: #f9fafb;
            transition: all 0.3s;
            cursor: pointer;
            position: relative;
        }

        .image-upload-area:hover {
            border-color: var(--primary);
            background: #fff5f5;
        }

        .image-upload-icon {
            font-size: 3rem;
            color: #9ca3af;
            margin-bottom: 1rem;
        }

        .btn-submit {
            background: var(--gradient);
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 14px;
            font-weight: 700;
            font-size: 1.1rem;
            width: 100%;
            box-shadow: 0 10px 20px -5px rgba(226, 55, 68, 0.4);
            transition: all 0.3s;
        }

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px -5px rgba(226, 55, 68, 0.5);
            color: white;
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
                        <a class="nav-link active" href="{{ route('add.service') }}">
                            <i class="fas fa-plus-circle"></i> Add Menu
                        </a>
                    </li>

                    <!-- User Profile -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle border-0 bg-transparent p-0" href="#" role="button"
                            data-bs-toggle="dropdown">
                            <div class="d-flex align-items-center gap-2">
                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center text-dark fw-bold"
                                    style="width: 40px; height: 40px;">
                                    {{ substr(auth()->guard('seller')->user()->name, 0, 1) }}
                                </div>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-2" style="border-radius: 16px;">
                            <li>
                                <form action="{{ route('logout.seller') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item rounded-3 py-2 text-danger fw-medium"><i
                                            class="fas fa-sign-out-alt me-2"></i> Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <div class="form-container animate__animated animate__fadeInUp">
            <div class="form-header">
                <div class="form-header-content">
                    <div
                        class="welcome-badge bg-white bg-opacity-25 text-white d-inline-block px-3 py-1 rounded-pill mb-3 backdrop-blur">
                        <i class="fas fa-star me-1"></i> Create New Listing
                    </div>
                    <h1 class="form-title">Add New Menu Item</h1>
                    <p class="mb-0 opacity-90">Expand your offerings with delicious new tiffins</p>
                </div>
            </div>

            <div class="form-body">
                @if (session('success'))
                    <div class="alert alert-success rounded-3 mb-4">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger rounded-3 mb-4">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('store.service') }}" enctype="multipart/form-data"
                    class="needs-validation" novalidate>
                    @csrf

                    <div class="row g-4">
                        <!-- Seller Info (Read-only) -->
                        <div class="col-md-6">
                            <label class="form-label">Seller Name</label>
                            <input type="text" class="form-control" value="{{ $seller->name }}" readonly disabled
                                style="background-color: #f3f4f6; opacity: 0.7;">
                        </div>

                        <!-- Basic Details -->
                        <div class="col-md-6">
                            <label for="service_name" class="form-label">Menu Item Name</label>
                            <input type="text" class="form-control" id="service_name" name="service_name"
                                placeholder="e.g. Special Chicken Biryani" required>
                        </div>

                        <div class="col-12">
                            <label for="service_description" class="form-label">Description</label>
                            <textarea class="form-control" id="service_description" name="service_description" rows="4"
                                placeholder="Describe the ingredients, taste, and portion size..." required></textarea>
                        </div>

                        <div class="col-md-6">
                            <label for="category_tag" class="form-label">Category</label>
                            <select class="form-select" id="category_tag" name="category_tag" required>
                                <option value="" selected disabled>Select Meal Type</option>
                                <option value="Breakfast">Breakfast</option>
                                <option value="Lunch">Lunch</option>
                                <option value="Dinner">Dinner</option>
                                <option value="All-Day">All Day</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="service_price" class="form-label">Price (PKR)</label>
                            <div class="input-group">
                                <span class="input-group-text">PKR</span>
                                <input type="number" class="form-control" id="service_price" name="service_price"
                                    min="1" placeholder="0.00" required>
                            </div>
                        </div>

                        <!-- Location -->
                        <div class="col-md-6">
                            <label for="seller_city" class="form-label">City</label>
                            <input type="text" class="form-control" id="seller_city" name="seller_city"
                                placeholder="Your City" required>
                        </div>
                        <div class="col-md-6">
                            <label for="seller_area" class="form-label">Area / Location</label>
                            <input type="text" class="form-control" id="seller_area" name="seller_area"
                                placeholder="e.g. Gulberg III" required>
                        </div>

                        <!-- Availability -->
                        <div class="col-12">
                            <label class="form-label d-block mb-3">Availability Days</label>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach(['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] as $day)
                                    <input type="checkbox" class="btn-check" name="availability_days[]" id="day_{{ $day }}"
                                        value="{{ $day }}" checked>
                                    <label class="btn btn-outline-primary rounded-pill px-4"
                                        for="day_{{ $day }}">{{ $day }}</label>
                                @endforeach
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Time Slot</label>
                            <div class="input-group mb-3">
                                <input type="time" class="form-control" name="start_time" id="start_time">
                                <span class="input-group-text bg-white border-start-0 border-end-0">to</span>
                                <input type="time" class="form-control" name="end_time" id="end_time">
                            </div>
                            <div class="form-check form-switch ps-0">
                                <div class="d-flex align-items-center gap-3">
                                    <input class="form-check-input ms-0" type="checkbox" id="all_day" name="all_day"
                                        value="1">
                                    <label class="form-check-label pt-1" for="all_day">Available All Day</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="service_delivery_time" class="form-label">Delivery Time</label>
                            <input type="text" class="form-control" id="service_delivery_time"
                                name="service_delivery_time" placeholder="e.g. 45-60 mins" required>
                        </div>

                        <div class="col-md-6">
                            <label for="stock_quantity" class="form-label">Daily Stock Limit</label>
                            <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" min="0"
                                placeholder="Leave empty for unlimited">
                        </div>

                        <div class="col-md-6">
                            <label for="seller_contact_no" class="form-label">Contact Number</label>
                            <input type="text" class="form-control" id="seller_contact_no" name="seller_contact_no"
                                placeholder="0300-1234567" required>
                        </div>

                        <!-- Image Upload -->
                        <div class="col-12">
                            <label class="form-label">Menu Image</label>
                            <div class="image-upload-area" onclick="document.getElementById('image').click()">
                                <i class="fas fa-cloud-upload-alt image-upload-icon bg-gradient text-white rounded-circle p-3"
                                    style="font-size: 1.5rem; background: var(--gradient);"></i>
                                <h5 class="fw-bold mt-2">Click to upload image</h5>
                                <p class="text-muted mb-0">SVG, PNG, JPG or GIF (MAX. 2MB)</p>
                                <input type="file" class="d-none" id="image" name="image" accept="image/*" required
                                    onchange="previewImage(this)">
                            </div>
                            <div id="image-preview" class="mt-3 d-none text-center">
                                <img src="" alt="Preview"
                                    style="max-height: 200px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="col-12 mt-4 pt-3 border-top">
                            <div class="row g-3">
                                <div class="col-md-6 order-md-2">
                                    <button type="submit" class="btn btn-submit">
                                        <i class="fas fa-plus-circle me-2"></i> Publish Menu
                                    </button>
                                </div>
                                <div class="col-md-6 order-md-1">
                                    <a href="{{ route('seller.panel') }}"
                                        class="btn btn-light w-100 py-3 fw-bold rounded-4"
                                        style="color: #6b7280;">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Form Validation
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })()

        // All Day Toggle Logic
        const allDaySwitch = document.getElementById('all_day');
        const startTimeInput = document.getElementById('start_time');
        const endTimeInput = document.getElementById('end_time');

        if (allDaySwitch) {
            allDaySwitch.addEventListener('change', function () {
                if (this.checked) {
                    startTimeInput.disabled = true;
                    endTimeInput.disabled = true;
                    startTimeInput.value = '';
                    endTimeInput.value = '';
                    startTimeInput.removeAttribute('required');
                    endTimeInput.removeAttribute('required');
                } else {
                    startTimeInput.disabled = false;
                    endTimeInput.disabled = false;
                    startTimeInput.setAttribute('required', 'required');
                    endTimeInput.setAttribute('required', 'required');
                }
            });
        }

        // Image Preview
        function previewImage(input) {
            const preview = document.getElementById('image-preview');
            const img = preview.querySelector('img');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    img.src = e.target.result;
                    preview.classList.remove('d-none');
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.classList.add('d-none');
            }
        }
    </script>
</body>

</html>