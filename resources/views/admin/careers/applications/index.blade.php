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
    .stat-card {
        background: #fff;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.03);
        border: 1px solid #e9ecef;
        text-align: center;
    }
    .stat-number { font-size: 24px; font-weight: 700; color: var(--ins-primary); }
    .stat-label { font-size: 13px; color: #6c757d; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px; }
    
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
    .btn-action-pdf { background: #ebe9fe; color: #6366f1; }
    .btn-action-pdf:hover { background: #6366f1; color: #fff; }
    .btn-action-view { background: #e2e8f0; color: #475569; }
    .btn-action-view:hover { background: #cbd5e1; }
    .btn-action-delete { background: #ef4444; color: #fff; }
    .btn-action-delete:hover { background: #dc2626; }

    /* Custom Row Styles for Duplicates */
    .row-duplicate {
        background-color: #fffbeb !important; /* light yellow */
    }
    .table-hover > tbody > tr.row-duplicate:hover {
        background-color: #fef3c7 !important; /* slightly darker yellow on hover */
    }
    .table-hover > tbody > tr.row-duplicate:hover > td {
        background-color: transparent !important;
        box-shadow: none !important;
    }
    
    /* Fix default table hover if needed */
    .table-hover > tbody > tr:hover > td {
        background-color: #f8fafc !important;
        box-shadow: none !important;
    }
</style>

<div class="container-fluid pt-4">
    <div class="row mb-4 align-items-center">
        <div class="col-sm-6">
            <h4 class="mb-0" style="font-size: 20px; font-weight: 600; color: var(--ins-heading-color);">Job Applications</h4>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 8px;">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Analytics Summary -->
    <div class="row mb-4">
        <div class="col-md-2 col-6 mb-3">
            <div class="stat-card">
                <div class="stat-number">{{ $analytics['total'] }}</div>
                <div class="stat-label">Total</div>
            </div>
        </div>
        <div class="col-md-2 col-6 mb-3">
            <div class="stat-card">
                <div class="stat-number" style="color: {{ $statusColors['applied'] }};">{{ $analytics['applied'] }}</div>
                <div class="stat-label">New</div>
            </div>
        </div>
        <div class="col-md-2 col-6 mb-3">
            <div class="stat-card">
                <div class="stat-number" style="color: {{ $statusColors['shortlisted'] }};">{{ $analytics['shortlisted'] }}</div>
                <div class="stat-label">Shortlisted</div>
            </div>
        </div>
        <div class="col-md-2 col-6 mb-3">
            <div class="stat-card">
                <div class="stat-number" style="color: {{ $statusColors['interview_scheduled'] }};">{{ $analytics['interview_scheduled'] }}</div>
                <div class="stat-label">Interviews</div>
            </div>
        </div>
        <div class="col-md-2 col-6 mb-3">
            <div class="stat-card">
                <div class="stat-number" style="color: {{ $statusColors['selected'] }};">{{ $analytics['selected'] }}</div>
                <div class="stat-label">Hired</div>
            </div>
        </div>
        <div class="col-md-2 col-6 mb-3">
            <div class="stat-card">
                <div class="stat-number" style="color: {{ $statusColors['rejected'] }};">{{ $analytics['rejected'] }}</div>
                <div class="stat-label">Rejected</div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="filter-card">
        <form action="{{ route('admin.job-applications.index') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label small text-muted mb-1">Search Candidate</label>
                <input type="text" name="search" class="form-control" placeholder="Name, Email, or Phone" value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label small text-muted mb-1">Job Profile</label>
                <select name="career_id" class="form-select">
                    <option value="">All Jobs</option>
                    @foreach($careers as $job)
                        <option value="{{ $job->id }}" {{ request('career_id') == $job->id ? 'selected' : '' }}>{{ $job->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label small text-muted mb-1">Status</label>
                <select name="status" class="form-select">
                    <option value="">All Statuses</option>
                    @foreach($statuses as $key => $label)
                        <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label small text-muted mb-1">Filter</label>
                <select name="duplicate_flag" class="form-select">
                    <option value="">All Applications</option>
                    <option value="1" {{ request('duplicate_flag') === '1' ? 'selected' : '' }}>Duplicates Only</option>
                    <option value="0" {{ request('duplicate_flag') === '0' ? 'selected' : '' }}>Exclude Duplicates</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100" style="border-radius: 8px;">Apply</button>
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="custom-table-wrapper" style="border: none;">
        <div class="d-flex justify-content-between mb-3 align-items-center">
            <h5 class="mb-0" style="font-size: 15px; font-weight: 600; color: #64748b;">Recent Applications</h5>
            <div class="text-muted small">
                Showing {{ $applications->firstItem() ?? 0 }} to {{ $applications->lastItem() ?? 0 }} of {{ $applications->total() }} applications
            </div>
        </div>

        <div class="table-responsive" style="border: 1px solid #f1f5f9; border-radius: 8px;">
            <table class="table table-hover align-middle mb-0">
                <thead style="background-color: #f1f5f9; border-bottom: none;">
                    <tr>
                        <th class="border-0" style="font-weight: 600; color: #475569; font-size: 13px;">Candidate Info</th>
                        <th class="border-0" style="font-weight: 600; color: #475569; font-size: 13px;">Applied Job</th>
                        <th class="border-0" style="font-weight: 600; color: #475569; font-size: 13px;">Status</th>
                        <th class="border-0" style="font-weight: 600; color: #475569; font-size: 13px;">Applied On</th>
                        <th class="text-end border-0" style="font-weight: 600; color: #475569; font-size: 13px;">Actions</th>
                    </tr>
                </thead>
                <tbody style="border-top: none;">
                    @forelse($applications as $app)
                        <tr class="{{ $app->duplicate_flag ? 'row-duplicate' : '' }}">
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar bg-light text-dark rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; font-weight: 600; border: 1px solid #e2e8f0;">
                                        {{ substr($app->full_name, 0, 1) }}
                                    </div>
                                    <div>
                                        <a href="{{ route('admin.job-applications.show', $app->id) }}" class="text-decoration-none">
                                            <strong style="color: var(--ins-heading-color); font-size: 15px;">{{ $app->full_name }}</strong>
                                        </a>
                                        @if($app->duplicate_flag)
                                            <span class="badge bg-warning text-dark ms-1" style="font-size: 10px;">Duplicate</span>
                                        @endif
                                        <div class="text-muted small">
                                            <i class="fa-regular fa-envelope me-1"></i>{{ $app->email }} <br>
                                            <i class="fa-solid fa-phone me-1"></i>{{ $app->phone }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <strong class="d-block" style="color: #111827; font-size: 14px;">{{ $app->career->title }}</strong>
                                <span class="text-muted" style="font-size: 12px;">{{ $app->career->department?->name ?? 'General' }} &bull; {{ $app->career->location?->city ?? 'Remote' }}</span>
                            </td>
                            <td>
                                <span class="status-badge" style="background-color: {{ $statusColors[$app->application_status] }}20; color: {{ $statusColors[$app->application_status] }};">
                                    {{ $app->status_label }}
                                </span>
                            </td>
                            <td>
                                <div class="text-dark">{{ $app->applied_at->format('d M, Y') }}</div>
                                <div class="text-muted small">{{ $app->applied_at->format('h:i A') }}</div>
                                <div class="text-muted small" style="font-size: 11px;">{{ $app->applied_at->diffForHumans() }}</div>
                            </td>
                            <td class="text-end">
                                @if($app->resumeMedia)
                                    <a href="{{ $app->resumeMedia->url }}" target="_blank" class="btn-action btn-action-pdf me-1" title="View Resume">
                                        <i class="fa-regular fa-file-pdf"></i>
                                    </a>
                                @endif
                                <a href="{{ route('admin.job-applications.show', $app->id) }}" class="btn-action btn-action-view me-1" title="View Details">
                                    <i class="fa-regular fa-eye"></i>
                                </a>
                                <button type="button" class="btn-action btn-action-delete" onclick="deleteItem('{{ $app->id }}')" title="Delete Application">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                                <form id="delete-form-{{ $app->id }}" action="{{ route('admin.job-applications.destroy', $app->id) }}" method="POST" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-users fa-2x mb-3 text-light"></i>
                                <p class="mb-0">No applications found matching your criteria.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-4">
            {{ $applications->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

<script>
    function deleteItem(id) {
        if(confirm('Are you sure you want to permanently delete this application?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>
@endsection
