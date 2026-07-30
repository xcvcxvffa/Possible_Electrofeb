@extends('admin.layouts.app')

@section('content')
<style>
    .detail-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.03);
        border: none;
        margin-bottom: 24px;
    }
    .detail-header {
        padding: 24px;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .detail-body {
        padding: 24px;
    }
    .info-label {
        font-size: 13px;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
        margin-bottom: 6px;
    }
    .info-value {
        font-size: 15px;
        color: #1e293b;
        font-weight: 500;
        margin-bottom: 20px;
    }
    .message-box {
        background: #f8fafc;
        border-radius: 8px;
        padding: 20px;
        font-size: 15px;
        color: #334155;
        line-height: 1.6;
        border: 1px solid #e2e8f0;
        white-space: pre-wrap;
    }
</style>

<div class="container-fluid pt-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1" style="font-size: 20px; font-weight: 600; color: var(--ins-heading-color);">Inquiry Details</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0" style="font-size: 14px;">
                    <li class="breadcrumb-item"><a href="{{ route('admin.contact-inquiries.index') }}" class="text-decoration-none text-muted">All Inquiries</a></li>
                    <li class="breadcrumb-item active" aria-current="page">#{{ substr($inquiry->id, 0, 8) }}</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('admin.contact-inquiries.index') }}" class="btn btn-light" style="border-radius: 8px;">
                <i class="fa-solid fa-arrow-left me-2"></i>Back to List
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 8px;">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <!-- Main Info -->
        <div class="col-lg-8">
            <div class="detail-card">
                <div class="detail-header">
                    <h5 class="mb-0" style="font-size: 16px; font-weight: 600;">Customer Information</h5>
                    @php
                        $statusColor = match($inquiry->status) {
                            'New' => '#3b82f6',
                            'Contacted' => '#eab308',
                            'Closed' => '#22c55e',
                            default => '#6b7280',
                        };
                    @endphp
                    <span style="background-color: {{ $statusColor }}20; color: {{ $statusColor }}; padding: 6px 12px; border-radius: 20px; font-weight: 500; font-size: 13px;">
                        <i class="fa-solid fa-circle me-1" style="font-size: 8px;"></i> {{ $inquiry->status }}
                    </span>
                </div>
                <div class="detail-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-label">Full Name</div>
                            <div class="info-value">{{ $inquiry->full_name }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-label">Submitted On</div>
                            <div class="info-value">{{ $inquiry->created_at->format('d M, Y h:i A') }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-label">Email Address</div>
                            <div class="info-value"><a href="mailto:{{ $inquiry->email }}">{{ $inquiry->email }}</a></div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-label">Phone Number</div>
                            <div class="info-value"><a href="tel:{{ $inquiry->phone }}">{{ $inquiry->phone }}</a></div>
                        </div>
                        <div class="col-md-12 mt-2">
                            <div class="info-label">Subject / Service Requested</div>
                            <div class="info-value" style="font-size: 16px;">{{ $inquiry->subject }}</div>
                        </div>
                        
                        @if($inquiry->product)
                        <div class="col-md-12 mt-2">
                            <div class="info-label">Matched Product</div>
                            <div class="info-value">
                                <span class="badge bg-info text-dark p-2" style="font-size: 13px;">
                                    <i class="fa-solid fa-box me-1"></i> {{ $inquiry->product->name }}
                                </span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="detail-card">
                <div class="detail-header">
                    <h5 class="mb-0" style="font-size: 16px; font-weight: 600;">Message</h5>
                </div>
                <div class="detail-body">
                    @if($inquiry->message)
                        <div class="message-box">{{ $inquiry->message }}</div>
                    @else
                        <div class="text-muted text-center py-4">
                            <i class="fa-regular fa-comment-dots fa-2x mb-2 text-light"></i>
                            <p class="mb-0">No message provided.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar / Actions -->
        <div class="col-lg-4">
            <div class="detail-card">
                <div class="detail-header">
                    <h5 class="mb-0" style="font-size: 16px; font-weight: 600;">Update Status</h5>
                </div>
                <div class="detail-body">
                    <form action="{{ route('admin.contact-inquiries.update_status', $inquiry->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label text-muted small">Current Status</label>
                            <select name="status" class="form-select" style="border-radius: 8px;">
                                <option value="New" {{ $inquiry->status == 'New' ? 'selected' : '' }}>New</option>
                                <option value="Contacted" {{ $inquiry->status == 'Contacted' ? 'selected' : '' }}>Contacted</option>
                                <option value="Closed" {{ $inquiry->status == 'Closed' ? 'selected' : '' }}>Closed</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100" style="border-radius: 8px;">Update Status</button>
                    </form>
                </div>
            </div>

            <div class="detail-card border border-danger">
                <div class="detail-body text-center">
                    <h5 class="text-danger mb-3" style="font-size: 16px; font-weight: 600;">Danger Zone</h5>
                    <p class="text-muted small mb-3">Deleting this inquiry will move it to the trash.</p>
                    
                    @if(!$inquiry->trashed())
                        <form action="{{ route('admin.contact-inquiries.destroy', $inquiry->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this inquiry?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger w-100" style="border-radius: 8px;">
                                <i class="fa-regular fa-trash-can me-2"></i>Delete Inquiry
                            </button>
                        </form>
                    @else
                        <form action="{{ route('admin.contact-inquiries.restore', $inquiry->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success w-100" style="border-radius: 8px;">
                                <i class="fa-solid fa-rotate-left me-2"></i>Restore Inquiry
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
