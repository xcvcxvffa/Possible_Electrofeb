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
    
    .custom-search-input {
        background: rgba(var(--ins-dark-rgb), 0.03);
        border: 1px solid var(--ins-border-color, #e2e8f0);
        border-radius: 8px;
        padding: 10px 16px;
        font-size: 14px;
        color: var(--ins-body-color, #475569);
        width: 250px;
        transition: all 0.2s;
    }
    .custom-search-input:focus {
        background: var(--ins-secondary-bg, #ffffff);
        border-color: var(--ins-primary);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        outline: none;
    }

    .btn-new {
        background: var(--ins-primary);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        font-size: 14px;
        font-weight: 500;
        transition: background 0.2s;
    }
    .btn-new:hover {
        filter: brightness(0.9);
        color: white;
    }
    
    .custom-select {
        background: var(--ins-secondary-bg, #ffffff);
        border: 1px solid var(--ins-border-color, #e2e8f0);
        border-radius: 6px;
        padding: 8px 28px 8px 12px;
        font-size: 13px;
        color: var(--ins-body-color, #334155);
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 8px center;
        background-size: 14px;
        cursor: pointer;
    }
    .custom-select:focus {
        border-color: #cbd5e1;
        outline: none;
    }
    
    .custom-table {
        width: 100%;
        margin-top: 16px;
        border-collapse: collapse;
    }
    .custom-table th {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 12px 16px;
        border-bottom: 1px solid var(--ins-border-color, #e2e8f0);
        background: rgba(var(--ins-dark-rgb), 0.02);
    }
    .custom-table td {
        padding: 16px;
        vertical-align: middle;
        border-bottom: 1px solid var(--ins-border-color, #f1f5f9);
        font-size: 13.5px;
    }
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 4px 10px;
        border-radius: 9999px;
        font-size: 12px;
        font-weight: 500;
    }
    .status-active {
        background: #dcfce7;
        color: #166534;
    }
    .status-draft {
        background: #f1f5f9;
        color: #64748b;
    }
    .badge-featured {
        background: #fef3c7;
        color: #92400e;
    }
    .action-btn {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        color: #64748b;
        transition: all 0.2s;
        text-decoration: none;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
    }
    .action-btn:hover {
        background: #e2e8f0;
        color: #1e293b;
    }
    .custom-pagination-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 24px;
        padding-top: 16px;
        border-top: 1px solid #f1f5f9;
    }
    .custom-info {
        font-size: 13px;
        color: #64748b;
    }
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_paginate {
        display: none !important;
    }
    .paginate-btn {
        width: auto;
        min-width: 32px;
        height: 32px;
        padding: 0 10px;
        border-radius: 4px;
        border: 1px solid var(--ins-border-color, #e2e8f0);
        background: var(--ins-secondary-bg, #ffffff);
        color: var(--ins-body-color, #64748b);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        cursor: pointer;
        margin-left: 6px;
        text-decoration: none;
    }
    .paginate-btn.active {
        background: var(--ins-primary);
        color: white;
        border-color: var(--ins-primary);
    }
    .paginate-btn:hover:not(.active) {
        background: rgba(var(--ins-dark-rgb), 0.03);
    }
</style>

<div class="d-flex align-items-center justify-content-between mt-4 mb-4">
    <div>
        <h4 class="mb-0 font-weight-bold" style="color: #1e2340; font-family: 'Inter', sans-serif;">Blog Management</h4>
        <p class="text-muted mb-0" style="font-size: 13.5px;">Manage articles, tutorials, news, and publications</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.blogs.trash') }}" class="btn btn-light border text-decoration-none d-flex align-items-center">
            <i class="fa-solid fa-trash-can me-2"></i> Trash
        </a>
        <a href="{{ route('admin.blogs.create') }}" class="btn-new text-decoration-none">
            Add Blog Post
        </a>
    </div>
</div>



<div class="custom-table-wrapper mt-4">
    <!-- Filter Bar -->
    <form method="GET" action="{{ route('admin.blogs.index') }}" class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
        <div class="d-flex flex-wrap align-items-center gap-2">
            <span style="font-size: 14px; color: #475569;">Show</span>
            <select class="custom-select" style="width: 70px;" id="customLength">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
            </select>
            
            <select name="category_id" class="custom-select" onchange="this.form.submit()">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ ($filters['category_id'] ?? '') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>

            <select name="status" class="custom-select" onchange="this.form.submit()">
                <option value="">All Statuses</option>
                <option value="1" {{ ($filters['status'] ?? '') === '1' ? 'selected' : '' }}>Published (Active)</option>
                <option value="0" {{ ($filters['status'] ?? '') === '0' ? 'selected' : '' }}>Draft</option>
            </select>

            <select name="featured" class="custom-select" onchange="this.form.submit()">
                <option value="">All Types</option>
                <option value="1" {{ ($filters['featured'] ?? '') === '1' ? 'selected' : '' }}>Featured</option>
                <option value="0" {{ ($filters['featured'] ?? '') === '0' ? 'selected' : '' }}>Standard</option>
            </select>

            @if(!empty(array_filter($filters)))
                <a href="{{ route('admin.blogs.index') }}" class="btn btn-sm btn-outline-secondary">Reset Filters</a>
            @endif
        </div>
        
        <div class="d-flex gap-2">
            <input type="text" name="search" class="custom-search-input" value="{{ $filters['search'] ?? '' }}" placeholder="Search blogs by title, slug...">
            <button type="submit" class="btn btn-primary btn-sm px-3">Search</button>
        </div>
    </form>

    <!-- Bulk Actions Bar -->
    <form id="bulkForm" action="{{ route('admin.blogs.bulk_action') }}" method="POST">
        @csrf
        <div class="d-flex align-items-center gap-2 mb-3">
            <select name="action" class="custom-select" style="width: 160px;" required>
                <option value="">Bulk Actions</option>
                <option value="delete">Move to Trash</option>
            </select>
            <button type="button" class="btn btn-sm btn-outline-danger" id="bulkApplyBtn">Apply</button>
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table class="custom-table" id="blogsTable">
                <thead>
                    <tr>
                        <th style="width: 36px;">
                            <input type="checkbox" id="selectAll" class="form-check-input" style="cursor: pointer;">
                        </th>
                        <th style="color: var(--ins-primary);"># <i class="fa-solid fa-arrow-down-up-across-line ms-1" style="opacity: 0.5;"></i></th>
                        <th style="color: var(--ins-primary);">IMAGE <i class="fa-solid fa-arrow-down-up-across-line ms-1" style="opacity: 0.5;"></i></th>
                        <th style="color: var(--ins-primary);">TITLE & SLUG <i class="fa-solid fa-arrow-down-up-across-line ms-1" style="opacity: 0.5;"></i></th>
                        <th style="color: var(--ins-primary);">CATEGORY <i class="fa-solid fa-arrow-down-up-across-line ms-1" style="opacity: 0.5;"></i></th>
                        <th style="color: var(--ins-primary);">AUTHOR <i class="fa-solid fa-arrow-down-up-across-line ms-1" style="opacity: 0.5;"></i></th>
                        <th style="color: var(--ins-primary);">STATUS <i class="fa-solid fa-arrow-down-up-across-line ms-1" style="opacity: 0.5;"></i></th>
                        <th class="text-center" style="color: var(--ins-primary);">ACTIONS <i class="fa-solid fa-arrow-down-up-across-line ms-1" style="opacity: 0.5;"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($blogs as $blog)
                        <tr>
                            <td>
                                <input type="checkbox" name="ids[]" value="{{ $blog->id }}" class="form-check-input select-item" style="cursor: pointer;">
                            </td>
                            <td style="color: #64748b; font-weight: 500; font-size: 13px;">{{ $loop->iteration }}</td>
                            <td>
                                @if($blog->featuredMedia)
                                    <img src="{{ asset('storage/' . $blog->featuredMedia->file_path) }}" class="rounded shadow-sm" style="width: 50px; height: 50px; object-fit: cover;" alt="Img">
                                @else
                                    <div class="rounded shadow-sm d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: #e2e8f0; color: #94a3b8;">
                                        <i class="fa-solid fa-image"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div style="font-weight: 600; color: #1e293b; font-size: 14px;">
                                    {{ $blog->title }}
                                    @if($blog->featured)
                                        <span class="status-badge badge-featured ms-1">Featured</span>
                                    @endif
                                </div>
                                <div style="font-size: 12px; color: #94a3b8;">{{ $blog->slug }}</div>
                            </td>
                            <td>
                                @if($blog->category)
                                    <span class="badge bg-light text-dark border">{{ $blog->category->name }}</span>
                                @else
                                    <span class="text-muted">Uncategorized</span>
                                @endif
                            </td>
                            <td style="color: #475569;">
                                {{ $blog->author ? $blog->author->name : 'System' }}
                            </td>
                            <td>
                                @if($blog->status)
                                    <span class="status-badge status-active">Published</span>
                                @else
                                    <span class="status-badge status-draft">Draft</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="action-btn action-btn-edit" title="Edit"><i class="fa-solid fa-pen"></i></a>
                                <button type="button" onclick="deleteSingle('{{ route('admin.blogs.destroy', $blog->id) }}')" class="action-btn action-btn-delete" style="border: none;" title="Move to Trash"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </form>

    <!-- Footer / Pagination Controls -->
    <div class="custom-pagination-wrapper">
        <div class="custom-info" id="customInfo">Showing 0 to 0 of 0 entries</div>
        <div class="d-flex align-items-center" id="customPagination"></div>
    </div>
</div>

<form id="singleDeleteForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection

@section('scripts')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
    function deleteSingle(url) {
        showConfirm({
            title: 'Move to Trash?',
            message: 'This blog will be moved to the trash. You can restore it later.',
            okText: 'Move to Trash',
            type: 'danger',
            icon: 'ti-trash',
            onConfirm: function() {
                var form = document.getElementById('singleDeleteForm');
                form.action = url;
                form.submit();
            }
        });
    }

    document.getElementById('bulkApplyBtn').addEventListener('click', function() {
        showConfirm({
            title: 'Apply Bulk Action?',
            message: 'Are you sure you want to apply this action to all selected items?',
            okText: 'Apply',
            type: 'warning',
            icon: 'ti-alert-triangle',
            onConfirm: function() {
                document.getElementById('bulkForm').submit();
            }
        });
    });

    $(document).ready(function() {
        $('#selectAll').on('change', function() {
            $('.select-item').prop('checked', $(this).is(':checked'));
        });

        var table = $('#blogsTable').DataTable({
            "pageLength": 10,
            "ordering": true,
            "info": false,
            "lengthChange": false,
            "searching": false, // Handled by server/custom top filter
            "autoWidth": false,
            "order": [],
            "columnDefs": [
                { "orderable": false, "targets": [0, 2, 7] }
            ],
            "drawCallback": function(settings) {
                var api = this.api();
                var pageInfo = api.page.info();
                
                var start = pageInfo.recordsDisplay === 0 ? 0 : (pageInfo.page * pageInfo.length) + 1;
                var end = Math.min((pageInfo.page + 1) * pageInfo.length, pageInfo.recordsDisplay);
                $('#customInfo').html('Showing ' + start + ' to ' + end + ' of ' + pageInfo.recordsDisplay + ' entries');
                
                var paginationHtml = '';
                if (pageInfo.pages > 1) {
                    paginationHtml += '<button class="paginate-btn ' + (pageInfo.page === 0 ? 'disabled' : '') + '" data-page="prev"><i class="fa-solid fa-chevron-left" style="font-size: 10px;"></i></button>';
                    for (var i = 0; i < pageInfo.pages; i++) {
                        var activeClass = (pageInfo.page === i) ? 'active' : '';
                        paginationHtml += '<button class="paginate-btn ' + activeClass + '" data-page="' + i + '">' + (i + 1) + '</button>';
                    }
                    paginationHtml += '<button class="paginate-btn ' + (pageInfo.page === (pageInfo.pages - 1) ? 'disabled' : '') + '" data-page="next"><i class="fa-solid fa-chevron-right" style="font-size: 10px;"></i></button>';
                }
                $('#customPagination').html(paginationHtml);
            }
        });

        $('#customLength').on('change', function() {
            table.page.len(parseInt(this.value)).draw();
        });

        $(document).on('click', '.paginate-btn', function() {
            var page = $(this).data('page');
            if (page === 'prev') {
                table.page('previous').draw('page');
            } else if (page === 'next') {
                table.page('next').draw('page');
            } else if (typeof page === 'number') {
                table.page(page).draw('page');
            }
        });
    });
</script>
@endsection
