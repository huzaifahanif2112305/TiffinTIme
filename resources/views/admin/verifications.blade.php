@extends('admin.layouts.app')

@section('title', 'Seller Verifications')

@section('styles')
<style>
    .vr-card { background:white; border-radius:18px; box-shadow:0 4px 20px rgba(0,0,0,.06); overflow:hidden; margin-bottom:20px; border:1px solid rgba(0,0,0,.04); transition:box-shadow .2s; }
    .vr-card:hover { box-shadow:0 8px 32px rgba(0,0,0,.1); }

    /* Header */
    .vr-header { display:flex; justify-content:space-between; align-items:center; padding:16px 22px; border-bottom:1px solid #f3f4f6; flex-wrap:wrap; gap:10px; background:#fafafa; }
    .vr-seller-info { display:flex; align-items:center; gap:14px; }
    .vr-avatar { width:44px; height:44px; border-radius:50%; background:linear-gradient(135deg,#E23744,#FF6B35); display:flex; align-items:center; justify-content:center; color:white; font-weight:700; font-size:1.1rem; flex-shrink:0; }
    .vr-seller-name { font-weight:700; font-size:.97rem; color:#1c1c1c; margin-bottom:2px; }
    .vr-seller-email { font-size:.78rem; color:#9ca3af; }

    /* Status Badges */
    .badge-pending  { background:#fff7ed; color:#c2410c; border:1px solid rgba(194,65,12,.2); }
    .badge-approved { background:#f0fdf4; color:#15803d; border:1px solid rgba(21,128,61,.2); }
    .badge-rejected { background:#fef2f2; color:#b91c1c; border:1px solid rgba(185,28,28,.2); }
    .status-pill { display:inline-flex; align-items:center; gap:6px; padding:5px 14px; border-radius:50px; font-size:.78rem; font-weight:700; }

    /* Body */
    .vr-body { padding:20px 22px; }
    .vr-detail-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(160px,1fr)); gap:12px; margin-bottom:18px; }
    .vr-detail { background:#f8f9fa; border-radius:10px; padding:10px 14px; }
    .vr-detail-label { font-size:.68rem; font-weight:700; text-transform:uppercase; letter-spacing:.5px; color:#9ca3af; margin-bottom:3px; }
    .vr-detail-value { font-size:.88rem; font-weight:600; color:#1c1c1c; }

    /* Images */
    .vr-images { display:flex; gap:10px; flex-wrap:wrap; margin-bottom:18px; }
    .vr-img-wrap { position:relative; border-radius:10px; overflow:hidden; border:2px solid #e5e7eb; cursor:pointer; }
    .vr-img-wrap img { width:110px; height:80px; object-fit:cover; display:block; }
    .vr-img-label { position:absolute; bottom:0; left:0; right:0; background:rgba(0,0,0,.55); color:white; font-size:.65rem; font-weight:700; text-align:center; padding:3px; }
    .vr-img-wrap:hover img { opacity:.85; }

    /* Actions */
    .vr-actions { display:flex; gap:10px; align-items:center; flex-wrap:wrap; }
    .btn-approve { background:linear-gradient(135deg,#059669,#10b981); color:white; border:none; padding:10px 22px; border-radius:50px; font-weight:600; font-size:.87rem; display:inline-flex; align-items:center; gap:7px; cursor:pointer; transition:all .25s; }
    .btn-approve:hover { transform:translateY(-2px); box-shadow:0 6px 18px rgba(5,150,105,.35); }
    .btn-reject { background:#fef2f2; color:#b91c1c; border:1.5px solid #fecaca; padding:10px 22px; border-radius:50px; font-weight:600; font-size:.87rem; display:inline-flex; align-items:center; gap:7px; cursor:pointer; transition:all .25s; }
    .btn-reject:hover { background:#fee2e2; transform:translateY(-2px); }

    /* Stats row */
    .stats-row { display:flex; gap:16px; margin-bottom:28px; flex-wrap:wrap; }
    .stat-box { background:white; border-radius:14px; padding:16px 22px; box-shadow:0 4px 16px rgba(0,0,0,.06); display:flex; align-items:center; gap:14px; flex:1; min-width:140px; border:1px solid rgba(0,0,0,.04); }
    .stat-icon-box { width:44px; height:44px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:1.2rem; }
    .stat-val { font-size:1.5rem; font-weight:800; color:#1c1c1c; line-height:1; }
    .stat-lbl { font-size:.75rem; color:#9ca3af; }

    /* filter tabs */
    .filter-tabs { display:flex; gap:8px; margin-bottom:20px; flex-wrap:wrap; }
    .f-tab { padding:7px 18px; border-radius:50px; font-size:.82rem; font-weight:600; border:1.5px solid #e5e7eb; color:#6b7280; cursor:pointer; text-decoration:none; transition:all .2s; }
    .f-tab:hover { border-color:#E23744; color:#E23744; }
    .f-tab.active { background:#E23744; color:white; border-color:#E23744; }

    /* Image lightbox */
    .lightbox-overlay { display:none; position:fixed; inset:0; background:rgba(0,0,0,.8); z-index:9999; align-items:center; justify-content:center; cursor:pointer; }
    .lightbox-overlay.open { display:flex; }
    .lightbox-overlay img { max-width:90vw; max-height:90vh; border-radius:12px; object-fit:contain; }
</style>
@endsection

@section('content')
<div class="container-fluid">

    <!-- Stats -->
    <div class="stats-row">
        <div class="stat-box">
            <div class="stat-icon-box" style="background:rgba(245,158,11,.12);color:#b45309;"><i class="fas fa-clock"></i></div>
            <div>
                <div class="stat-val">{{ $verifications->where('status','pending')->count() }}</div>
                <div class="stat-lbl">Pending</div>
            </div>
        </div>
        <div class="stat-box">
            <div class="stat-icon-box" style="background:rgba(16,185,129,.12);color:#059669;"><i class="fas fa-check-circle"></i></div>
            <div>
                <div class="stat-val">{{ $verifications->where('status','approved')->count() }}</div>
                <div class="stat-lbl">Approved</div>
            </div>
        </div>
        <div class="stat-box">
            <div class="stat-icon-box" style="background:rgba(239,68,68,.12);color:#dc2626;"><i class="fas fa-times-circle"></i></div>
            <div>
                <div class="stat-val">{{ $verifications->where('status','rejected')->count() }}</div>
                <div class="stat-lbl">Rejected</div>
            </div>
        </div>
        <div class="stat-box">
            <div class="stat-icon-box" style="background:rgba(226,55,68,.1);color:#E23744;"><i class="fas fa-shield-alt"></i></div>
            <div>
                <div class="stat-val">{{ $verifications->total() }}</div>
                <div class="stat-lbl">Total Requests</div>
            </div>
        </div>
    </div>

    <!-- Filter tabs -->
    <div class="filter-tabs">
        <a href="{{ route('admin.verifications') }}" class="f-tab {{ !request('status') ? 'active' : '' }}">All</a>
        <a href="{{ route('admin.verifications', ['status'=>'pending']) }}" class="f-tab {{ request('status')=='pending' ? 'active' : '' }}">⏳ Pending</a>
        <a href="{{ route('admin.verifications', ['status'=>'approved']) }}" class="f-tab {{ request('status')=='approved' ? 'active' : '' }}">✅ Approved</a>
        <a href="{{ route('admin.verifications', ['status'=>'rejected']) }}" class="f-tab {{ request('status')=='rejected' ? 'active' : '' }}">❌ Rejected</a>
    </div>

    @if($verifications->isEmpty())
        <div class="text-center py-5 bg-white rounded-4" style="color:#9ca3af;">
            <i class="fas fa-shield-alt" style="font-size:3rem; margin-bottom:12px; display:block;"></i>
            <p>No verification requests found.</p>
        </div>
    @else
        @foreach($verifications as $v)
        <div class="vr-card">
            <!-- Header -->
            <div class="vr-header">
                <div class="vr-seller-info">
                    <div class="vr-avatar">{{ substr($v->seller->name ?? 'S', 0, 1) }}</div>
                    <div>
                        <div class="vr-seller-name">{{ $v->seller->name ?? 'Unknown Seller' }}</div>
                        <div class="vr-seller-email">{{ $v->seller->email ?? '' }}</div>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3 flex-wrap">
                    @php
                        $badgeCls = ['pending'=>'badge-pending','approved'=>'badge-approved','rejected'=>'badge-rejected'][$v->status] ?? 'badge-pending';
                        $badgeIco = ['pending'=>'fa-clock','approved'=>'fa-check-circle','rejected'=>'fa-times-circle'][$v->status] ?? 'fa-clock';
                    @endphp
                    <span class="status-pill {{ $badgeCls }}">
                        <i class="fas {{ $badgeIco }}"></i> {{ ucfirst($v->status) }}
                    </span>
                    <span style="font-size:.78rem;color:#9ca3af;">
                        <i class="fas fa-calendar me-1"></i>{{ $v->created_at->format('d M Y, h:i A') }}
                    </span>
                </div>
            </div>

            <!-- Body -->
            <div class="vr-body">
                <!-- Details -->
                <div class="vr-detail-grid">
                    <div class="vr-detail">
                        <div class="vr-detail-label">Full Name</div>
                        <div class="vr-detail-value">{{ $v->full_name }}</div>
                    </div>
                    <div class="vr-detail">
                        <div class="vr-detail-label">CNIC</div>
                        <div class="vr-detail-value" style="font-family:monospace;">{{ $v->cnic_number }}</div>
                    </div>
                    <div class="vr-detail">
                        <div class="vr-detail-label">Phone</div>
                        <div class="vr-detail-value">{{ $v->phone }}</div>
                    </div>
                    <div class="vr-detail" style="grid-column:span 2;">
                        <div class="vr-detail-label">Address</div>
                        <div class="vr-detail-value">{{ $v->address }}</div>
                    </div>
                    @if($v->reviewed_at)
                        <div class="vr-detail">
                            <div class="vr-detail-label">Reviewed At</div>
                            <div class="vr-detail-value">{{ $v->reviewed_at->format('d M Y') }}</div>
                        </div>
                    @endif
                </div>

                <!-- Admin notes -->
                @if($v->admin_notes)
                    <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:10px;padding:12px 16px;margin-bottom:16px;">
                        <span style="font-size:.75rem;font-weight:700;color:#b91c1c;text-transform:uppercase;letter-spacing:.5px;">Rejection Reason:</span>
                        <p class="mb-0 mt-1 text-muted small">{{ $v->admin_notes }}</p>
                    </div>
                @endif

                <!-- Images -->
                <div class="vr-images">
                    <div class="vr-img-wrap" onclick="openLightbox('{{ asset('storage/'.$v->cnic_front_image) }}')">
                        <img src="{{ asset('storage/'.$v->cnic_front_image) }}" alt="CNIC Front" loading="lazy">
                        <div class="vr-img-label">CNIC Front</div>
                    </div>
                    <div class="vr-img-wrap" onclick="openLightbox('{{ asset('storage/'.$v->cnic_back_image) }}')">
                        <img src="{{ asset('storage/'.$v->cnic_back_image) }}" alt="CNIC Back" loading="lazy">
                        <div class="vr-img-label">CNIC Back</div>
                    </div>
                    <div class="vr-img-wrap" onclick="openLightbox('{{ asset('storage/'.$v->profile_picture) }}')">
                        <img src="{{ asset('storage/'.$v->profile_picture) }}" alt="Profile" loading="lazy">
                        <div class="vr-img-label">Profile Photo</div>
                    </div>
                </div>

                <!-- Actions (only for pending) -->
                @if($v->status === 'pending')
                    <div class="vr-actions">
                        <!-- Approve -->
                        <form action="{{ route('admin.verification.approve', $v->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-approve"
                                onclick="return confirm('Approve this seller verification?')">
                                <i class="fas fa-check-circle"></i> Approve
                            </button>
                        </form>

                        <!-- Reject (with reason modal) -->
                        <button type="button" class="btn-reject" onclick="showRejectModal({{ $v->id }})">
                            <i class="fas fa-times-circle"></i> Reject
                        </button>
                    </div>
                @endif
            </div>
        </div>
        @endforeach

        {{ $verifications->links() }}
    @endif

    <!-- Rejection Modal (shared) -->
    <div class="modal fade" id="rejectModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0" style="border-radius:20px;overflow:hidden;">
                <div class="modal-header border-0" style="background:#fef2f2;padding:20px 24px;">
                    <h5 class="modal-title fw-bold"><i class="fas fa-times-circle text-danger me-2"></i>Reject Verification</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="rejectForm" method="POST">
                    @csrf
                    <div class="modal-body p-4">
                        <p class="text-muted small mb-3">Provide a reason for rejection. This will be shown to the seller.</p>
                        <textarea name="admin_notes" rows="4" class="form-control" style="border-radius:12px;border:1.5px solid #e5e7eb;"
                            placeholder="e.g. CNIC image is unclear, details do not match records..."></textarea>
                    </div>
                    <div class="modal-footer border-0 px-4 pb-4 gap-2">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger rounded-pill px-4 fw-semibold">
                            <i class="fas fa-times me-1"></i> Confirm Rejection
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Lightbox -->
    <div class="lightbox-overlay" id="lightbox" onclick="closeLightbox()">
        <img src="" id="lightboxImg" alt="Preview">
    </div>

</div>
@endsection

@section('scripts')
<script>
function showRejectModal(id) {
    document.getElementById('rejectForm').action = `/admin/verifications/${id}/reject`;
    new bootstrap.Modal(document.getElementById('rejectModal')).show();
}

function openLightbox(src) {
    document.getElementById('lightboxImg').src = src;
    document.getElementById('lightbox').classList.add('open');
}
function closeLightbox() {
    document.getElementById('lightbox').classList.remove('open');
}
</script>
@endsection
