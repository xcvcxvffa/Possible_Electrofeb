@extends('admin.layouts.app')

@section('content')
<style>
    :root {
        --primary: var(--ins-primary);
        --primary-light: rgba(var(--ins-primary-rgb), 0.1);
        --text-main: var(--ins-heading-color, #1e293b);
        --text-sub: var(--ins-body-color, #64748b);
        --border-color: var(--ins-border-color, #e2e8f0);
        --card-bg: var(--ins-secondary-bg, #ffffff);
    }

    /* Top Bar */
    .top-bar-card {
        background: var(--card-bg);
        border-radius: 16px;
        padding: 24px 32px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02), 0 10px 20px -5px rgba(0,0,0,0.02);
        margin-bottom: 24px;
        border: 1px solid #f1f5f9;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
    }
    .page-title-text { color: var(--text-main); font-weight: 700; font-size: 1.5rem; margin-bottom: 4px; }
    .page-subtitle { color: #94a3b8; font-size: 14px; margin-bottom: 0; }

    .btn-post-new {
        background: var(--primary);
        color: white;
        border: 1px solid var(--primary);
        border-radius: 10px;
        padding: 11px 24px;
        font-size: 14px;
        font-weight: 600;
        transition: all 0.2s;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-post-new:hover { filter: brightness(0.9); color: white; box-shadow: 0 6px 16px rgba(99, 102, 241, 0.3); }

    /* Stat Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }
    @media (max-width: 991px) { .stats-grid { grid-template-columns: repeat(3, 1fr); } }
    @media (max-width: 575px) { .stats-grid { grid-template-columns: repeat(2, 1fr); } }

    .stat-card-v2 {
        background: var(--card-bg);
        border-radius: 14px;
        padding: 22px 20px;
        border: 1px solid #f1f5f9;
        box-shadow: 0 2px 10px rgba(0,0,0,0.02);
        display: flex;
        align-items: center;
        gap: 16px;
        transition: all 0.2s ease;
    }
    .stat-card-v2:hover { box-shadow: 0 8px 24px rgba(0,0,0,0.06); transform: translateY(-2px); }
    .stat-icon-box {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }
    .stat-card-v2 .stat-number { font-size: 22px; font-weight: 700; color: var(--text-main); line-height: 1.2; }
    .stat-card-v2 .stat-label { font-size: 12px; color: var(--text-sub); font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px; }

    .stat-total .stat-icon-box { background: #eef2ff; color: #6366f1; }
    .stat-active .stat-icon-box { background: #ecfdf5; color: #10b981; }
    .stat-active .stat-number { color: #059669; }
    .stat-draft .stat-icon-box { background: #fefce8; color: #eab308; }
    .stat-draft .stat-number { color: #ca8a04; }
    .stat-expired .stat-icon-box { background: #fef2f2; color: #ef4444; }
    .stat-expired .stat-number { color: #dc2626; }
    .stat-views .stat-icon-box { background: #f0f9ff; color: #0ea5e9; }
    .stat-views .stat-number { color: #0284c7; }

    /* Custom Card */
    .custom-card {
        background: var(--card-bg);
        border: 1px solid #f1f5f9;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
        padding: 28px;
        margin-bottom: 24px;
    }
    .card-header-custom {
        display: flex;
        align-items: center;
        margin-bottom: 24px;
    }
    .card-header-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: var(--primary-light);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        margin-right: 16px;
    }
    .card-header-text h5 { font-size: 16px; font-weight: 700; color: var(--text-main); margin: 0 0 4px 0; }
    .card-header-text p { font-size: 13px; color: var(--text-sub); margin: 0; }

    /* Filter Section */
    .filter-grid {
        display: grid;
        grid-template-columns: 2fr 1.2fr 1.2fr 1.2fr auto;
        gap: 14px;
        align-items: end;
    }
    @media (max-width: 991px) { .filter-grid { grid-template-columns: 1fr 1fr; } }
    @media (max-width: 575px) { .filter-grid { grid-template-columns: 1fr; } }

    .filter-label { font-size: 12px; font-weight: 600; color: var(--text-sub); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px; }
    .filter-input, .filter-select {
        border: 1px solid var(--border-color);
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 14px;
        color: var(--text-main);
        background: var(--card-bg);
        transition: all 0.2s;
        width: 100%;
        height: 44px;
    }
    .filter-input:focus, .filter-select:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1); outline: none; }
    .btn-filter {
        background: var(--primary);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 10px 28px;
        font-size: 14px;
        font-weight: 600;
        height: 44px;
        transition: all 0.2s;
        white-space: nowrap;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-filter:hover { filter: brightness(0.9); color: white; }

    /* Bulk Actions Bar */
    .bulk-actions-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }
    .bulk-select { border-radius: 8px; font-size: 13px; padding: 6px 12px; border-color: var(--border-color); height: 36px; }
    .btn-apply-bulk {
        background: #f8fafc;
        color: var(--text-sub);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 6px 16px;
        font-size: 13px;
        font-weight: 500;
        transition: all 0.2s;
        height: 36px;
    }
    .btn-apply-bulk:hover { background: #f1f5f9; color: var(--text-main); }

    /* Table */
    .jobs-table { border-radius: 12px; overflow: hidden; border: 1px solid #f1f5f9; }
    .jobs-table table { margin-bottom: 0; }
    .jobs-table thead th {
        background: #f8fafc;
        font-weight: 600;
        color: var(--text-sub);
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 14px 16px;
        border: none;
        border-bottom: 1px solid #f1f5f9;
    }
    .jobs-table tbody td {
        padding: 16px;
        vertical-align: middle;
        border-bottom: 1px solid #f8fafc;
        font-size: 14px;
        color: var(--text-main);
    }
    .jobs-table tbody tr { transition: background 0.15s; }
    .jobs-table tbody tr:hover { background: #fafbfe; }
    .jobs-table tbody tr:last-child td { border-bottom: none; }

    .job-title-link {
        text-decoration: none;
        color: var(--text-main);
        font-weight: 600;
        font-size: 15px;
        transition: color 0.2s;
    }
    .job-title-link:hover { color: var(--primary); }

    .badge-tag {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 3px 8px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
        line-height: 1.4;
    }
    .badge-code { background: #f1f5f9; color: #475569; }
    .badge-featured { background: #fef9c3; color: #a16207; }
    .badge-urgent { background: #fee2e2; color: #dc2626; }
    .badge-active { background: #dcfce7; color: #16a34a; }
    .badge-draft { background: #f1f5f9; color: #64748b; }
    .badge-expired { background: #fee2e2; color: #dc2626; }

    .badge-type {
        display: inline-flex;
        align-items: center;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 500;
    }

    .views-count {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 13px;
        color: var(--text-sub);
        background: #f8fafc;
        padding: 4px 10px;
        border-radius: 6px;
    }

    .posted-date { font-size: 11px; color: #94a3b8; margin-top: 4px; }

    /* Action Buttons */
    .btn-action {
        width: 34px;
        height: 34px;
        border-radius: 8px;
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        transition: all 0.2s;
        text-decoration: none;
    }
    .btn-action-users { background: #ecfdf5; color: #10b981; }
    .btn-action-users:hover { background: #d1fae5; color: #059669; }
    .btn-action-edit { background: #eef2ff; color: #6366f1; }
    .btn-action-edit:hover { background: #e0e7ff; color: #4f46e5; }
    .btn-action-delete { background: #fef2f2; color: #ef4444; }
    .btn-action-delete:hover { background: #fee2e2; color: #dc2626; }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }
    .empty-state-icon {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        background: #f8fafc;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        color: #cbd5e1;
        margin-bottom: 16px;
    }
    .empty-state p { color: var(--text-sub); font-size: 14px; margin: 0; }

    .count-badge {
        font-size: 13px;
        color: var(--text-sub);
        font-weight: 500;
    }
</style>

<div class="container-fluid pt-3 pb-5">

    <!-- Top Bar -->
    <div class="top-bar-card mt-1">
        <div>
            <h4 class="page-title-text">Jobs Management</h4>
            <p class="page-subtitle">Create, manage and track all career openings.</p>
        </div>
        <a href="{{ route('admin.careers.create') }}" class="btn-post-new">
            <i class="fa-regular fa-plus"></i> Post New Job
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 12px; border: 1px solid #bbf7d0; background: #f0fdf4; color: #166534; font-size: 14px;">
            <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Analytics Stats -->
    <div class="stats-grid">
        <div class="stat-card-v2 stat-total">
            <div class="stat-icon-box"><i class="fa-solid fa-briefcase"></i></div>
            <div>
                <div class="stat-number">{{ $analytics['total'] }}</div>
                <div class="stat-label">Total Jobs</div>
            </div>
        </div>
        <div class="stat-card-v2 stat-active">
            <div class="stat-icon-box"><i class="fa-solid fa-circle-check"></i></div>
            <div>
                <div class="stat-number">{{ $analytics['active'] }}</div>
                <div class="stat-label">Active</div>
            </div>
        </div>
        <div class="stat-card-v2 stat-draft">
            <div class="stat-icon-box"><i class="fa-solid fa-pen-to-square"></i></div>
            <div>
                <div class="stat-number">{{ $analytics['draft'] }}</div>
                <div class="stat-label">Draft</div>
            </div>
        </div>
        <div class="stat-card-v2 stat-expired">
            <div class="stat-icon-box"><i class="fa-solid fa-clock-rotate-left"></i></div>
            <div>
                <div class="stat-number">{{ $analytics['expired'] }}</div>
                <div class="stat-label">Expired</div>
            </div>
        </div>
        <div class="stat-card-v2 stat-views">
            <div class="stat-icon-box"><i class="fa-solid fa-eye"></i></div>
            <div>
                <div class="stat-number">{{ $analytics['total_views'] }}</div>
                <div class="stat-label">Total Views</div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="custom-card">
        <div class="card-header-custom">
            <div class="card-header-icon"><i class="fa-solid fa-filter"></i></div>
            <div class="card-header-text">
                <h5>Filter Jobs</h5>
                <p>Search and filter to find specific job postings.</p>
            </div>
        </div>
        <form action="{{ route('admin.careers.index') }}" method="GET">
            <div class="filter-grid">
                <div>
                    <div class="filter-label">Search</div>
                    <input type="text" name="search" class="filter-input" placeholder="Search by title or code..." value="{{ request('search') }}">
                </div>
                <div>
                    <div class="filter-label">Status</div>
                    <select name="status" class="filter-select">
                        <option value="">All Statuses</option>
                        <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>
                <div>
                    <div class="filter-label">Department</div>
                    <select name="department_id" class="filter-select">
                        <option value="">All Departments</option>
                        @foreach($departments as $dept)
                            <option value="{{ $dept->id }}" {{ request('department_id') == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <div class="filter-label">Location</div>
                    <select name="job_location_id" class="filter-select">
                        <option value="">All Locations</option>
                        @foreach($locations as $loc)
                            <option value="{{ $loc->id }}" {{ request('job_location_id') == $loc->id ? 'selected' : '' }}>{{ $loc->city }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <div class="filter-label">&nbsp;</div>
                    <button type="submit" class="btn-filter">
                        <i class="fa-solid fa-magnifying-glass"></i> Filter
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Jobs Table -->
    <div class="custom-card" style="padding-bottom: 8px;">
        <form id="bulk-action-form" action="{{ route('admin.careers.bulk_action') }}" method="POST">
            @csrf
            <input type="hidden" name="ids" id="bulk-ids" value="">

            <div class="bulk-actions-bar">
                <div class="d-flex align-items-center gap-2">
                    <select name="action" class="form-select bulk-select">
                        <option value="">Bulk Actions</option>
                        <option value="delete">Move to Trash</option>
                    </select>
                    <button type="button" class="btn-apply-bulk" onclick="submitBulkAction()">Apply</button>
                </div>
                <span class="count-badge">
                    <i class="fa-solid fa-list me-1"></i> Showing {{ $careers->count() }} {{ Str::plural('job', $careers->count()) }}
                </span>
            </div>

            <div class="jobs-table">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th width="40"><input class="form-check-input" type="checkbox" id="check-all"></th>
                            <th>Job Title / Code</th>
                            <th>Dept. & Location</th>
                            <th>Job Type</th>
                            <th>Views</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($careers as $career)
                            <tr>
                                <td><input class="form-check-input check-item" type="checkbox" value="{{ $career->id }}"></td>
                                <td>
                                    <div>
                                        <a href="{{ route('admin.careers.edit', $career->id) }}" class="job-title-link">
                                            {{ $career->title }}
                                        </a>
                                        <div class="d-flex align-items-center gap-2 mt-1 flex-wrap">
                                            @if($career->job_code)
                                                <span class="badge-tag badge-code"><i class="fa-solid fa-hashtag" style="font-size: 9px;"></i> {{ $career->job_code }}</span>
                                            @endif
                                            @if($career->featured)
                                                <span class="badge-tag badge-featured"><i class="fa-solid fa-star" style="font-size: 9px;"></i> Featured</span>
                                            @endif
                                            @if($career->urgent)
                                                <span class="badge-tag badge-urgent"><i class="fa-solid fa-bolt" style="font-size: 9px;"></i> Urgent</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div style="font-weight: 500;">{{ $career->department?->name ?? '-' }}</div>
                                    <div class="text-muted" style="font-size: 12px;"><i class="fa-solid fa-location-dot me-1" style="font-size: 10px;"></i>{{ $career->location?->city ?? 'Remote/Any' }}</div>
                                </td>
                                <td>
                                    @if($career->jobType)
                                        <span class="badge-type" style="background-color: {{ $career->jobType->color }}15; color: {{ $career->jobType->color }};">
                                            {{ $career->jobType->name }}
                                        </span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="views-count"><i class="fa-regular fa-eye" style="font-size: 12px;"></i> {{ $career->views_count }}</span>
                                </td>
                                <td>
                                    @if($career->isExpired())
                                        <span class="badge-tag badge-expired"><i class="fa-solid fa-circle" style="font-size: 6px;"></i> Expired</span>
                                    @elseif($career->status)
                                        <span class="badge-tag badge-active"><i class="fa-solid fa-circle" style="font-size: 6px;"></i> Active</span>
                                    @else
                                        <span class="badge-tag badge-draft"><i class="fa-solid fa-circle" style="font-size: 6px;"></i> Draft</span>
                                    @endif
                                    <div class="posted-date">
                                        {{ $career->published_at ? $career->published_at->format('d M, Y') : '-' }}
                                    </div>
                                </td>
                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('admin.job-applications.index', ['career_id' => $career->id]) }}" class="btn-action btn-action-users" title="View Applications">
                                            <i class="fa-solid fa-user-group" style="font-size: 13px;"></i>
                                        </a>
                                        <a href="{{ route('admin.careers.edit', $career->id) }}" class="btn-action btn-action-edit" title="Edit">
                                            <i class="fa-regular fa-pen-to-square" style="font-size: 13px;"></i>
                                        </a>
                                        <button type="button" class="btn-action btn-action-delete" onclick="deleteItem({{ $career->id }})" title="Move to Trash">
                                            <i class="fa-regular fa-trash-can" style="font-size: 13px;"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">
                                    <div class="empty-state">
                                        <div class="empty-state-icon"><i class="fa-solid fa-briefcase"></i></div>
                                        <p>No jobs found matching your criteria.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>

<form id="master-delete-form" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>

<script>
    function deleteItem(id) {
        if(confirm('Move this job to trash?')) {
            let form = document.getElementById('master-delete-form');
            form.action = '/admin/careers/' + id;
            form.submit();
        }
    }

    document.getElementById('check-all').addEventListener('change', function() {
        let checkboxes = document.querySelectorAll('.check-item');
        checkboxes.forEach(cb => cb.checked = this.checked);
    });

    function submitBulkAction() {
        let checked = Array.from(document.querySelectorAll('.check-item:checked')).map(cb => cb.value);
        if (checked.length === 0) {
            alert('Please select at least one item.');
            return;
        }
        let action = document.querySelector('select[name="action"]').value;
        if (!action) {
            alert('Please select an action.');
            return;
        }
        if (confirm('Are you sure you want to perform this action?')) {
            document.getElementById('bulk-ids').value = checked.join(',');
            document.getElementById('bulk-action-form').submit();
        }
    }
</script>
@endsection
