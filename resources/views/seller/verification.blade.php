<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for Verification | Tiffin Time</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #E23744; --secondary: #FF6B35;
            --gradient: linear-gradient(135deg, #E23744 0%, #FF6B35 100%);
            --dark: #1c1c1c;
        }
        body { font-family: 'Poppins', sans-serif; background: #f3f4f6; }

        /* Navbar */
        .navbar-custom { background: rgba(255,255,255,0.97); backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0,0,0,0.05); padding: 1rem 0; box-shadow: 0 4px 20px rgba(0,0,0,0.04); }
        .navbar-brand { display: flex; align-items: center; gap: 12px; font-weight: 700; font-size: 1.4rem; color: var(--primary) !important; }
        .brand-icon { width: 42px; height: 42px; background: var(--gradient); border-radius: 50%; display: flex;
            align-items: center; justify-content: center; color: white; font-size: 1.1rem; }
        .nav-link-custom { font-weight: 500; color: #4b5563; padding: 8px 16px; border-radius: 12px;
            transition: all 0.25s; text-decoration: none; display: inline-flex; align-items: center; gap: 7px; }
        .nav-link-custom:hover { color: var(--primary); background: rgba(226,55,68,0.08); }

        /* Hero */
        .page-hero { background: var(--gradient); padding: 110px 0 50px; color: white; text-align: center; }
        .page-hero h1 { font-size: 2.2rem; font-weight: 800; margin-bottom: 8px; }
        .page-hero p { opacity: 0.88; font-size: 1rem; }

        /* Form Card */
        .form-card { background: white; border-radius: 20px; box-shadow: 0 10px 40px rgba(0,0,0,0.08);
            padding: 2.5rem; margin-top: -30px; position: relative; z-index: 10; max-width: 760px; margin-left: auto; margin-right: auto; }

        /* Section divider */
        .form-section-title { font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;
            color: #9ca3af; margin-bottom: 16px; display: flex; align-items: center; gap: 10px; }
        .form-section-title::after { content: ''; flex: 1; height: 1px; background: #e5e7eb; }

        /* Upload area */
        .upload-area { border: 2px dashed #e5e7eb; border-radius: 14px; padding: 1.5rem; text-align: center;
            cursor: pointer; transition: all 0.3s; position: relative; background: #fafafa; }
        .upload-area:hover, .upload-area.dragover { border-color: var(--primary); background: rgba(226,55,68,0.04); }
        .upload-area input[type="file"] { position: absolute; inset: 0; opacity: 0; cursor: pointer; }
        .upload-icon { font-size: 2rem; color: #d1d5db; margin-bottom: 8px; }
        .upload-label { font-size: 0.88rem; font-weight: 600; color: #6b7280; }
        .upload-sub { font-size: 0.75rem; color: #9ca3af; margin-top: 3px; }
        .upload-preview { display: none; margin-top: 10px; }
        .upload-preview img { max-height: 120px; border-radius: 10px; object-fit: cover; border: 2px solid #e5e7eb; }

        /* Form controls */
        .form-floating .form-control { border-radius: 12px; border: 1.5px solid #e5e7eb; padding-top: 1.5rem; }
        .form-floating .form-control:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(226,55,68,0.12); }
        .form-floating label { color: #9ca3af; }
        .form-select { border-radius: 12px; border: 1.5px solid #e5e7eb; padding: 12px 16px; }
        .form-select:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(226,55,68,0.12); }

        /* Submit */
        .btn-submit { background: var(--gradient); color: white; border: none; padding: 14px 36px; border-radius: 50px;
            font-weight: 700; font-size: 1rem; display: inline-flex; align-items: center; gap: 8px;
            box-shadow: 0 4px 20px rgba(226,55,68,0.35); transition: all 0.3s; width: 100%; justify-content: center; }
        .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 8px 28px rgba(226,55,68,0.45); color: white; }

        /* Info note */
        .info-note { background: rgba(59,130,246,0.08); border: 1px solid rgba(59,130,246,0.2); border-radius: 14px;
            padding: 14px 18px; display: flex; align-items: flex-start; gap: 12px; margin-bottom: 24px; }
        .info-note i { color: #3b82f6; margin-top: 2px; flex-shrink: 0; }
        .info-note p { margin: 0; font-size: 0.87rem; color: #374151; }

        /* Validation errors */
        .error-box { background: #fef2f2; border: 1px solid #fecaca; border-radius: 14px; padding: 14px 18px; margin-bottom: 20px; }
        .error-box ul { margin: 0; padding-left: 20px; font-size: 0.87rem; color: #b91c1c; }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-custom fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('seller.panel') }}">
            <div class="brand-icon"><i class="fas fa-utensils"></i></div>
            <span>Tiffin Time <small class="text-muted fw-normal" style="font-size:.85rem">Partner</small></span>
        </a>
        <div class="d-flex gap-2">
            <a href="{{ route('seller.panel') }}" class="nav-link-custom">
                <i class="fas fa-th-large"></i> Dashboard
            </a>
            <form action="{{ route('logout.seller') }}" method="POST" class="d-inline">
                @csrf
                <button class="nav-link-custom border-0 bg-transparent" style="color:#dc2626;">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </div>
</nav>

<!-- Hero -->
<div class="page-hero">
    <div class="container">
        <div style="font-size:3rem; margin-bottom:12px;">🛡️</div>
        <h1>Apply for Verification Badge</h1>
        <p>Complete identity verification to display a badge on your seller profile</p>
    </div>
</div>

<!-- Form -->
<div class="container pb-5">
    <div class="form-card">

        <!-- Info note -->
        <div class="info-note">
            <i class="fas fa-info-circle fa-lg"></i>
            <p>
                Your information is stored securely and only reviewed by the admin team.
                After submission, allow up to <strong>24 hours</strong> for review.
                You'll be notified once a decision is made.
            </p>
        </div>

        <!-- Validation errors -->
        @if($errors->any())
            <div class="error-box">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('seller.verification.submit') }}" method="POST" enctype="multipart/form-data" id="verificationForm">
            @csrf

            <!-- Personal Information -->
            <div class="form-section-title">Personal Information</div>
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control @error('full_name') is-invalid @enderror"
                            id="full_name" name="full_name"
                            value="{{ old('full_name', $seller->name) }}"
                            placeholder="Full Name" required>
                        <label for="full_name"><i class="fas fa-user me-1"></i> Full Name</label>
                        @error('full_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control @error('cnic_number') is-invalid @enderror"
                            id="cnic_number" name="cnic_number"
                            value="{{ old('cnic_number') }}"
                            placeholder="CNIC Number" maxlength="15" required>
                        <label for="cnic_number"><i class="fas fa-id-card me-1"></i> CNIC (12345-1234567-1)</label>
                        @error('cnic_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                            id="phone" name="phone"
                            value="{{ old('phone') }}"
                            placeholder="Phone Number" required>
                        <label for="phone"><i class="fas fa-phone me-1"></i> Phone Number</label>
                        @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <textarea class="form-control @error('address') is-invalid @enderror"
                            id="address" name="address"
                            placeholder="Address" style="height:58px" required>{{ old('address') }}</textarea>
                        <label for="address"><i class="fas fa-map-marker-alt me-1"></i> Address</label>
                        @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <!-- Document Uploads -->
            <div class="form-section-title">Required Documents</div>
            <div class="row g-3 mb-4">
                <!-- CNIC Front -->
                <div class="col-md-4">
                    <p class="mb-2 fw-semibold" style="font-size:.88rem">CNIC Front <span class="text-danger">*</span></p>
                    <div class="upload-area" id="frontArea">
                        <input type="file" name="cnic_front_image" accept="image/*" id="frontInput" required onchange="previewImage(this,'frontPreview','frontArea')">
                        <div class="upload-icon"><i class="fas fa-id-card"></i></div>
                        <div class="upload-label">Click or drag CNIC front</div>
                        <div class="upload-sub">JPG, PNG · Max 3MB</div>
                        <div class="upload-preview" id="frontPreview">
                            <img src="" alt="Preview">
                        </div>
                    </div>
                    @error('cnic_front_image')<p class="text-danger small mt-1">{{ $message }}</p>@enderror
                </div>
                <!-- CNIC Back -->
                <div class="col-md-4">
                    <p class="mb-2 fw-semibold" style="font-size:.88rem">CNIC Back <span class="text-danger">*</span></p>
                    <div class="upload-area" id="backArea">
                        <input type="file" name="cnic_back_image" accept="image/*" id="backInput" required onchange="previewImage(this,'backPreview','backArea')">
                        <div class="upload-icon"><i class="fas fa-id-card-alt"></i></div>
                        <div class="upload-label">Click or drag CNIC back</div>
                        <div class="upload-sub">JPG, PNG · Max 3MB</div>
                        <div class="upload-preview" id="backPreview">
                            <img src="" alt="Preview">
                        </div>
                    </div>
                    @error('cnic_back_image')<p class="text-danger small mt-1">{{ $message }}</p>@enderror
                </div>
                <!-- Profile Picture -->
                <div class="col-md-4">
                    <p class="mb-2 fw-semibold" style="font-size:.88rem">Profile Picture <span class="text-danger">*</span></p>
                    <div class="upload-area" id="profileArea">
                        <input type="file" name="profile_picture" accept="image/*" id="profileInput" required onchange="previewImage(this,'profilePreview','profileArea')">
                        <div class="upload-icon"><i class="fas fa-user-circle"></i></div>
                        <div class="upload-label">Click or drag profile photo</div>
                        <div class="upload-sub">JPG, PNG · Max 3MB</div>
                        <div class="upload-preview" id="profilePreview">
                            <img src="" alt="Preview">
                        </div>
                    </div>
                    @error('profile_picture')<p class="text-danger small mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <!-- Terms -->
            <div class="mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="agree" required>
                    <label class="form-check-label small text-muted" for="agree">
                        I confirm that all submitted information is accurate and I agree to the
                        <a href="#" style="color:var(--primary)">Verification Terms &amp; Conditions</a>.
                    </label>
                </div>
            </div>

            <button type="submit" class="btn-submit" id="submitBtn">
                <i class="fas fa-paper-plane"></i> Submit Verification Request
            </button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
function previewImage(input, previewId, areaId) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById(previewId);
            preview.querySelector('img').src = e.target.result;
            preview.style.display = 'block';
            document.getElementById(areaId).style.borderColor = '#E23744';
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// CNIC auto-format
document.getElementById('cnic_number').addEventListener('input', function(e) {
    let val = e.target.value.replace(/[^0-9]/g, '');
    let formatted = '';
    if (val.length > 0) formatted = val.substring(0, Math.min(5, val.length));
    if (val.length > 5) formatted += '-' + val.substring(5, Math.min(12, val.length));
    if (val.length > 12) formatted += '-' + val.substring(12, 13);
    e.target.value = formatted;
});

// Prevent double submission
document.getElementById('verificationForm').addEventListener('submit', function() {
    const btn = document.getElementById('submitBtn');
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting...';
});
</script>
</body>
</html>
