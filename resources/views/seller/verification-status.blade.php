<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Status | Tiffin Time</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --primary:#E23744; --secondary:#FF6B35; --gradient:linear-gradient(135deg,#E23744 0%,#FF6B35 100%); }
        body { font-family:'Poppins',sans-serif; background:#f3f4f6; }
        .navbar-custom { background:rgba(255,255,255,.97); backdrop-filter:blur(12px); border-bottom:1px solid rgba(0,0,0,.05); padding:1rem 0; box-shadow:0 4px 20px rgba(0,0,0,.04); }
        .navbar-brand { display:flex; align-items:center; gap:12px; font-weight:700; font-size:1.4rem; color:var(--primary)!important; }
        .brand-icon { width:42px; height:42px; background:var(--gradient); border-radius:50%; display:flex; align-items:center; justify-content:center; color:white; font-size:1.1rem; }
        .nav-link-custom { font-weight:500; color:#4b5563; padding:8px 16px; border-radius:12px; transition:all .25s; text-decoration:none; display:inline-flex; align-items:center; gap:7px; }
        .nav-link-custom:hover { color:var(--primary); background:rgba(226,55,68,.08); }

        /* Hero */
        .page-hero { background:var(--gradient); padding:110px 0 60px; color:white; text-align:center; }
        .page-hero h1 { font-size:2.2rem; font-weight:800; margin-bottom:8px; }

        /* Status Card */
        .status-card { background:white; border-radius:24px; box-shadow:0 10px 40px rgba(0,0,0,.08);
            padding:2.5rem; margin-top:-30px; position:relative; z-index:10; max-width:680px; margin-left:auto; margin-right:auto; }

        /* Status indicator */
        .status-circle { width:90px; height:90px; border-radius:50%; margin:0 auto 20px; display:flex; align-items:center; justify-content:center; font-size:2.4rem; }
        .status-pending  { background:rgba(245,158,11,.12); color:#b45309; }
        .status-approved { background:rgba(16,185,129,.12); color:#059669; }
        .status-rejected { background:rgba(239,68,68,.12); color:#dc2626; }

        .status-title { font-size:1.6rem; font-weight:800; margin-bottom:8px; }
        .status-subtitle { color:#6b7280; font-size:.95rem; line-height:1.6; }

        /* Detail grid */
        .detail-grid { display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-top:24px; }
        .detail-item { background:#fafafa; border-radius:14px; padding:14px 16px; border:1px solid #f0f0f0; }
        .detail-label { font-size:.72rem; font-weight:700; text-transform:uppercase; letter-spacing:.5px; color:#9ca3af; margin-bottom:4px; }
        .detail-value { font-size:.92rem; font-weight:600; color:#1c1c1c; }

        /* Image grid */
        .image-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:12px; margin-top:20px; }
        .image-thumb { border-radius:12px; overflow:hidden; border:2px solid #e5e7eb; aspect-ratio:4/3; position:relative; }
        .image-thumb img { width:100%; height:100%; object-fit:cover; }
        .image-thumb-label { position:absolute; bottom:0; left:0; right:0; background:rgba(0,0,0,.55); color:white; font-size:.7rem; font-weight:600; text-align:center; padding:4px; }

        /* Buttons */
        .btn-apply-again { background:var(--gradient); color:white; border:none; padding:12px 30px; border-radius:50px; font-weight:700; text-decoration:none; display:inline-flex; align-items:center; gap:8px; box-shadow:0 4px 16px rgba(226,55,68,.3); transition:all .3s; }
        .btn-apply-again:hover { color:white; transform:translateY(-2px); box-shadow:0 8px 24px rgba(226,55,68,.4); }
        .btn-dashboard { background:#f3f4f6; color:#374151; border:none; padding:12px 30px; border-radius:50px; font-weight:600; text-decoration:none; display:inline-flex; align-items:center; gap:8px; transition:all .3s; }
        .btn-dashboard:hover { background:#e5e7eb; color:#1c1c1c; }

        /* Timeline */
        .timeline { display:flex; justify-content:space-between; position:relative; margin:28px 0; }
        .timeline::before { content:''; position:absolute; top:18px; left:10%; right:10%; height:3px; background:#e5e7eb; z-index:0; }
        .timeline-step { display:flex; flex-direction:column; align-items:center; z-index:1; }
        .step-dot { width:38px; height:38px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:.95rem; font-weight:700; margin-bottom:8px; }
        .step-done { background:#059669; color:white; }
        .step-active { background:var(--primary); color:white; box-shadow:0 0 0 5px rgba(226,55,68,.2); }
        .step-pending { background:#f3f4f6; color:#9ca3af; border:2px solid #e5e7eb; }
        .step-label { font-size:.72rem; font-weight:600; color:#6b7280; text-align:center; }

        /* Admin rejection note */
        .rejection-note { background:#fef2f2; border:1px solid #fecaca; border-radius:14px; padding:16px 18px; margin-top:16px; }
        .rejection-note strong { color:#b91c1c; }

        @media(max-width:576px){ .detail-grid { grid-template-columns:1fr; } .image-grid { grid-template-columns:1fr; } }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-custom fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('seller.panel') }}">
            <div class="brand-icon"><i class="fas fa-utensils"></i></div>
            <span>Tiffin Time <small class="text-muted fw-normal" style="font-size:.85rem">Partner</small></span>
        </a>
        <div class="d-flex gap-2">
            <a href="{{ route('seller.panel') }}" class="nav-link-custom"><i class="fas fa-th-large"></i> Dashboard</a>
            <form action="{{ route('logout.seller') }}" method="POST" class="d-inline">
                @csrf
                <button class="nav-link-custom border-0 bg-transparent" style="color:#dc2626;"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </form>
        </div>
    </div>
</nav>

<div class="page-hero">
    <div class="container">
        <div style="font-size:3rem; margin-bottom:12px;">🛡️</div>
        <h1>Verification Status</h1>
        <p style="opacity:.88">Track the status of your verification request</p>
    </div>
</div>

<div class="container pb-5">
    <div class="status-card">

        @if(session('success'))
            <div class="alert alert-success border-0 rounded-3 mb-4" style="background:rgba(16,185,129,.1);color:#065f46;">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            </div>
        @endif

        @if(!$verification)
            <!-- No application yet -->
            <div class="text-center py-4">
                <div style="font-size:4rem; margin-bottom:16px;">📋</div>
                <h3 class="fw-bold mb-2">No Application Found</h3>
                <p class="text-muted mb-4">You haven't applied for a verification badge yet.</p>
                <a href="{{ route('seller.verification.form') }}" class="btn-apply-again">
                    <i class="fas fa-shield-alt"></i> Apply Now
                </a>
            </div>

        @else
            <!-- Status indicator -->
            @php
                $statusMap = [
                    'pending'  => ['icon'=>'fa-clock',        'class'=>'status-pending',  'label'=>'Pending Review',  'emoji'=>'⏳'],
                    'approved' => ['icon'=>'fa-check-circle', 'class'=>'status-approved', 'label'=>'Verified ✓',      'emoji'=>'✅'],
                    'rejected' => ['icon'=>'fa-times-circle', 'class'=>'status-rejected', 'label'=>'Rejected',        'emoji'=>'❌'],
                ];
                $s = $statusMap[$verification->status] ?? $statusMap['pending'];
            @endphp

            <div class="text-center mb-4">
                <div class="status-circle {{ $s['class'] }}">
                    <i class="fas {{ $s['icon'] }}"></i>
                </div>
                <div class="status-title">{{ $s['label'] }}</div>
                @if($verification->status === 'pending')
                    <p class="status-subtitle">Your request has been submitted.<br>Please wait up to <strong>24 hours</strong>. You will be notified once the review is complete.</p>
                @elseif($verification->status === 'approved')
                    <p class="status-subtitle">🎉 Congratulations! Your seller account is now <strong>verified</strong>.<br>A badge will appear next to your name across the platform.</p>
                @elseif($verification->status === 'rejected')
                    <p class="status-subtitle">Your verification request was not approved.<br>Review the reason below and reapply.</p>
                @endif
            </div>

            <!-- Progress timeline -->
            <div class="timeline">
                <div class="timeline-step">
                    <div class="step-dot step-done"><i class="fas fa-paper-plane"></i></div>
                    <div class="step-label">Submitted</div>
                </div>
                <div class="timeline-step">
                    <div class="step-dot {{ $verification->status === 'pending' ? 'step-active' : 'step-done' }}">
                        <i class="fas fa-search"></i>
                    </div>
                    <div class="step-label">Under Review</div>
                </div>
                <div class="timeline-step">
                    @if($verification->status === 'approved')
                        <div class="step-dot step-done"><i class="fas fa-check"></i></div>
                    @elseif($verification->status === 'rejected')
                        <div class="step-dot" style="background:#dc2626;color:white;"><i class="fas fa-times"></i></div>
                    @else
                        <div class="step-dot step-pending"><i class="fas fa-flag-checkered"></i></div>
                    @endif
                    <div class="step-label">Decision</div>
                </div>
            </div>

            <!-- Rejection note -->
            @if($verification->status === 'rejected' && $verification->admin_notes)
                <div class="rejection-note">
                    <strong><i class="fas fa-exclamation-triangle me-2"></i>Rejection Reason:</strong>
                    <p class="mb-0 mt-1 text-muted small">{{ $verification->admin_notes }}</p>
                </div>
            @endif

            <!-- Submitted details -->
            <div class="detail-grid">
                <div class="detail-item">
                    <div class="detail-label">Full Name</div>
                    <div class="detail-value">{{ $verification->full_name }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">CNIC Number</div>
                    <div class="detail-value">{{ $verification->cnic_number }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Phone</div>
                    <div class="detail-value">{{ $verification->phone }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Submitted On</div>
                    <div class="detail-value">{{ $verification->created_at->format('d M Y, h:i A') }}</div>
                </div>
                <div class="detail-item" style="grid-column: 1/-1;">
                    <div class="detail-label">Address</div>
                    <div class="detail-value">{{ $verification->address }}</div>
                </div>
                @if($verification->reviewed_at)
                    <div class="detail-item" style="grid-column: 1/-1;">
                        <div class="detail-label">Reviewed On</div>
                        <div class="detail-value">{{ $verification->reviewed_at->format('d M Y, h:i A') }}</div>
                    </div>
                @endif
            </div>

            <!-- Uploaded images -->
            <div class="image-grid">
                <div class="image-thumb">
                    <img src="{{ asset('storage/' . $verification->cnic_front_image) }}" alt="CNIC Front">
                    <div class="image-thumb-label">CNIC Front</div>
                </div>
                <div class="image-thumb">
                    <img src="{{ asset('storage/' . $verification->cnic_back_image) }}" alt="CNIC Back">
                    <div class="image-thumb-label">CNIC Back</div>
                </div>
                <div class="image-thumb">
                    <img src="{{ asset('storage/' . $verification->profile_picture) }}" alt="Profile Picture">
                    <div class="image-thumb-label">Profile Photo</div>
                </div>
            </div>

            <!-- Actions -->
            <div class="d-flex gap-3 flex-wrap justify-content-center mt-4">
                <a href="{{ route('seller.panel') }}" class="btn-dashboard">
                    <i class="fas fa-th-large"></i> Back to Dashboard
                </a>
                @if($verification->status === 'rejected')
                    <a href="{{ route('seller.verification.form') }}" class="btn-apply-again">
                        <i class="fas fa-redo"></i> Reapply
                    </a>
                @endif
            </div>
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
