@extends('admin.layouts.app')

@section('content')
<style>
    .custom-table-wrapper {
        background: var(--ins-secondary-bg, #ffffff);
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.03);
        padding: 24px;
        font-family: 'Inter', sans-serif;
    }
    
    .filter-card {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 24px;
        border: 1px solid #e9ecef;
    }
    
    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 500;
        font-size: 12px;
        display: inline-block;
    }
    
    .btn-action {
        border-radius: 6px;
        padding: 5px 9px;
        border: none;
        font-size: 13px;
        transition: 0.2s;
    }
    .btn-action-view { background: #e2e8f0; color: #475569; }
    .btn-action-view:hover { background: #cbd5e1; }
    .btn-action-delete { background: #ef4444; color: #fff; }
    .btn-action-delete:hover { background: #dc2626; }
</style>

<div class="container-fluid pt-4">
    <div class="row mb-4 align-items-center">
        <div class="col-sm-6">
            <h4 class="mb-0" style="font-size: 20px; font-weight: 600; color: var(--ins-heading-color);">Contact Inquiries</h4>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 8px;">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Filters -->
    <div class="filter-card">
        <form action="{{ route('admin.contact-inquiries.index') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label small text-muted mb-1">Search Inquiry</label>
                <input type="text" name="search" class="form-control" placeholder="Name, Email, Phone, or Subject" value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label small text-muted mb-1">Status</label>
                <select name="status" class="form-select">
                    <option value="">All Statuses</option>
                    @foreach($statuses as $key => $label)
                        <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label small text-muted mb-1">Filter Trashed</label>
                <select name="trashed" class="form-select">
                    <option value="">Active Inquiries</option>
                    <option value="with" {{ request('trashed') === 'with' ? 'selected' : '' }}>Include Trashed</option>
                    <option value="only" {{ request('trashed') === 'only' ? 'selected' : '' }}>Trashed Only</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100" style="border-radius: 8px;">Apply Filters</button>
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="custom-table-wrapper" style="border: none;">
        <div class="d-flex justify-content-between mb-3 align-items-center">
            <h5 class="mb-0" style="font-size: 15px; font-weight: 600; color: #64748b;">All Inquiries</h5>
            <div class="text-muted small">
                Showing {{ $inquiries->firstItem() ?? 0 }} to {{ $inquiries->lastItem() ?? 0 }} of {{ $inquiries->total() }} inquiries
            </div>
        </div>

        <div class="table-responsive" style="border: 1px solid #f1f5f9; border-radius: 8px;">
            <table class="table table-hover align-middle mb-0">
                <thead style="background-color: #f1f5f9; border-bottom: none;">
                    <tr>
                        <th class="border-0" style="font-weight: 600; color: #475569; font-size: 13px;">Ref / Date</th>
                        <th class="border-0" style="font-weight: 600; color: #475569; font-size: 13px;">Customer Info</th>
                        <th class="border-0" style="font-weight: 600; color: #475569; font-size: 13px;">Subject / Product</th>
                        <th class="border-0" style="font-weight: 600; color: #475569; font-size: 13px;">Status</th>
                        <th class="text-end border-0" style="font-weight: 600; color: #475569; font-size: 13px;">Actions</th>
                    </tr>
                </thead>
                <tbody style="border-top: none;">
                    @forelse($inquiries as $inquiry)
                        <tr class="{{ $inquiry->trashed() ? 'table-danger' : '' }}">
                            <td>
                                <div class="text-dark" style="font-size: 14px; font-weight: 500;">#{{ substr($inquiry->id, 0, 8) }}</div>
                                <div class="text-muted small">{{ $inquiry->created_at->format('d M, Y') }}</div>
                            </td>
                            <td>
                                <strong style="color: var(--ins-heading-color); font-size: 15px;">{{ $inquiry->full_name }}</strong>
                                <div class="text-muted small">
                                    <i class="fa-regular fa-envelope me-1"></i>{{ $inquiry->email }} <br>
                                    <i class="fa-solid fa-phone me-1"></i>{{ $inquiry->phone }}
                                </div>
                            </td>
                            <td>
                                <strong class="d-block" style="color: #111827; font-size: 14px;">{{ $inquiry->subject }}</strong>
                                @if($inquiry->product)
                                    <span class="badge bg-info text-dark" style="font-size: 11px;"><i class="fa-solid fa-box me-1"></i> {{ $inquiry->product->name }}</span>
                                @endif
                            </td>
                            <td>
                                @php
                                    $statusColor = match($inquiry->status) {
                                        'New' => '#3b82f6', // Blue
                                        'Contacted' => '#eab308', // Yellow
                                        'Closed' => '#22c55e', // Green
                                        default => '#6b7280', // Gray
                                    };
                                @endphp
                                <span class="status-badge" style="background-color: {{ $statusColor }}20; color: {{ $statusColor }};">
                                    {{ $inquiry->status }}
                                </span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.contact-inquiries.show', $inquiry->id) }}" class="btn-action btn-action-view me-1" title="View Details">
                                    <i class="fa-regular fa-eye"></i>
                                </a>
                                @if(!$inquiry->trashed())
                                    <button type="button" class="btn-action btn-action-delete" onclick="deleteItem('{{ $inquiry->id }}', '{{ addslashes($inquiry->full_name) }}')" title="Delete Inquiry">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                    <form id="delete-form-{{ $inquiry->id }}" action="{{ route('admin.contact-inquiries.destroy', $inquiry->id) }}" method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                @else
                                    <button type="button" class="btn btn-sm btn-success" onclick="restoreItem('{{ $inquiry->id }}', '{{ addslashes($inquiry->full_name) }}')" title="Restore Inquiry">
                                        <i class="fa-solid fa-rotate-left"></i> Restore
                                    </button>
                                    <form id="restore-form-{{ $inquiry->id }}" action="{{ route('admin.contact-inquiries.restore', $inquiry->id) }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="fa-regular fa-envelope-open fa-2x mb-3 text-light"></i>
                                <p class="mb-0">No contact inquiries found.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-4">
            {{ $inquiries->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

<script>
    function deleteItem(id, name) {
        showConfirm({
            title: 'Delete Inquiry?',
            message: 'Inquiry from "' + name + '" will be deleted.',
            okText: 'Delete',
            type: 'danger',
            icon: 'ti-trash',
            onConfirm: function() {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
    
    function restoreItem(id, name) {
        showConfirm({
            title: 'Restore Inquiry?',
            message: 'Inquiry from "' + name + '" will be restored.',
            okText: 'Restore',
            type: 'success',
            icon: 'ti-reload',
            onConfirm: function() {
                document.getElementById('restore-form-' + id).submit();
            }
        });
    }
</script>
@endsection
