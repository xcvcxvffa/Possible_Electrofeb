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
        width: 280px;
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
        padding: 6px 28px 6px 12px;
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
        <h4 class="mb-0 font-weight-bold" style="color: #1e2340; font-family: 'Inter', sans-serif;">Blog Categories</h4>
        <p class="text-muted mb-0" style="font-size: 13.5px;">Manage all unlimited nested blog categories</p>
    </div>
    <a href="{{ route('admin.blog-categories.create') }}" class="btn-new text-decoration-none">
        Add Category
    </a>
</div>



<div class="custom-table-wrapper mt-4">
    <!-- Top Bar -->
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
        <div class="d-flex align-items-center gap-2">
            <span style="font-size: 14px; color: #475569;">Show</span>
            <select class="custom-select" style="width: 70px;" id="customLength">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
            </select>
            <span style="font-size: 14px; color: #475569;">entries</span>
        </div>
        
        <div>
            <input type="text" class="custom-search-input" id="customSearch" placeholder="Search categories...">
        </div>
    </div>

    <!-- Table -->
    <div class="table-responsive">
        <table class="custom-table" id="categoriesTable">
            <thead>
                <tr>
                    <th style="color: var(--ins-primary);"># <i class="fa-solid fa-arrow-down-up-across-line ms-1" style="opacity: 0.5;"></i></th>
                    <th style="color: var(--ins-primary);">IMAGE <i class="fa-solid fa-arrow-down-up-across-line ms-1" style="opacity: 0.5;"></i></th>
                    <th style="color: var(--ins-primary);">CATEGORY NAME <i class="fa-solid fa-arrow-down-up-across-line ms-1" style="opacity: 0.5;"></i></th>
                    <th style="color: var(--ins-primary);">PARENT <i class="fa-solid fa-arrow-down-up-across-line ms-1" style="opacity: 0.5;"></i></th>
                    <th style="color: var(--ins-primary);">STATUS <i class="fa-solid fa-arrow-down-up-across-line ms-1" style="opacity: 0.5;"></i></th>
                    <th class="text-center" style="color: var(--ins-primary);">ACTIONS <i class="fa-solid fa-arrow-down-up-across-line ms-1" style="opacity: 0.5;"></i></th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td style="color: #64748b; font-weight: 500; font-size: 13px;">{{ $loop->iteration }}</td>
                        <td>
                            @if($category->imageMedia)
                                <img src="{{ asset('storage/' . $category->imageMedia->file_path) }}" class="rounded shadow-sm" style="width: 45px; height: 45px; object-fit: cover;" alt="Img">
                            @else
                                <div class="rounded shadow-sm d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background: #e2e8f0; color: #94a3b8;">
                                    <i class="fa-solid fa-image"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <div style="font-weight: 600; color: #1e293b; font-size: 14px;">{{ $category->name }}</div>
                            <div style="font-size: 12px; color: #94a3b8;">{{ $category->slug }}</div>
                        </td>
                        <td style="color: #475569;">{{ $category->parent ? $category->parent->name : '--' }}</td>
                        <td>
                            @if($category->status)
                                <span class="status-badge status-active">Active</span>
                            @else
                                <span class="status-badge status-draft">Draft</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.blog-categories.edit', $category->id) }}" class="action-btn action-btn-edit" title="Edit"><i class="fa-solid fa-pen"></i></a>
                            <form action="{{ route('admin.blog-categories.destroy', $category->id) }}" method="POST" class="d-inline-block" id="catDelForm_{{ $category->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="action-btn action-btn-delete" style="border: none;" title="Delete"
                                    onclick="confirmDeleteCategory('{{ route('admin.blog-categories.destroy', $category->id) }}', '{{ addslashes($category->name) }}')"
                                ><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Footer / Pagination Controls -->
    <div class="custom-pagination-wrapper">
        <div class="custom-info" id="customInfo">Showing 0 to 0 of 0 entries</div>
        <div class="d-flex align-items-center" id="customPagination"></div>
    </div>
</div>
@endsection

@section('scripts')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        var table = $('#categoriesTable').DataTable({
            "pageLength": 10,
            "ordering": true,
            "info": false,
            "lengthChange": false,
            "searching": true,
            "autoWidth": false,
            "order": [],
            "columnDefs": [
                { "orderable": false, "targets": [1, 5] }
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

        $('#customSearch').on('keyup', function() {
            table.search(this.value).draw();
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

<script>
    function confirmDeleteCategory(url, name) {
        showConfirm({
            title: 'Delete Category?',
            message: '"' + name + '" will be permanently deleted.',
            okText: 'Delete',
            type: 'danger',
            icon: 'ti-trash',
            onConfirm: function() {
                var csrf = document.createElement('input');
                csrf.type = 'hidden'; csrf.name = '_token'; csrf.value = '{{ csrf_token() }}';
                var method = document.createElement('input');
                method.type = 'hidden'; method.name = '_method'; method.value = 'DELETE';
                var form = document.createElement('form');
                form.method = 'POST'; form.action = url;
                form.appendChild(csrf); form.appendChild(method);
                document.body.appendChild(form); form.submit();
            }
        });
    }
</script>
@endsection
