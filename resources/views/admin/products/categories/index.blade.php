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
        text-transform: uppercase;
        color: var(--ins-primary); /* Dynamic primary color */
        font-weight: 700;
        letter-spacing: 0.5px;
        padding: 16px 12px;
        border-bottom: 1px solid var(--ins-border-color, #f1f5f9);
        white-space: nowrap;
    }
    .custom-table td {
        padding: 16px 12px;
        border-bottom: 1px solid rgba(var(--ins-dark-rgb), 0.02);
        vertical-align: middle;
        font-size: 14px;
        color: var(--ins-body-color, #334155);
    }
    .custom-table tr:hover td {
        background-color: rgba(var(--ins-dark-rgb), 0.01);
    }
    
    .status-badge {
        padding: 4px 10px;
        border-radius: 4px;
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 0.3px;
        display: inline-block;
    }
    .status-active {
        background: #ecfdf5;
        color: #10b981;
    }
    .status-draft {
        background: #fff7ed;
        color: #f97316;
    }
    
    .action-btn {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        transition: all 0.2s;
        margin-right: 6px;
        text-decoration: none;
    }
    .action-btn-edit {
        background: rgba(var(--ins-primary-rgb), 0.15);
        color: var(--ins-primary);
    }
    .action-btn-edit:hover {
        background: rgba(var(--ins-primary-rgb), 0.25);
        color: var(--ins-primary);
    }
    .action-btn-delete {
        background: rgba(var(--bs-danger-rgb), 0.15);
        color: var(--bs-danger);
    }
    .action-btn-delete:hover {
        background: rgba(var(--bs-danger-rgb), 0.25);
        color: var(--bs-danger);
    }
    .action-btn:last-child {
        margin-right: 0;
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
    
    /* Override DataTables DOM */
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
        <h4 class="mb-0 font-weight-bold" style="color: #1e2340; font-family: 'Inter', sans-serif;">Product Categories</h4>
        <p class="text-muted mb-0" style="font-size: 13.5px;">Manage all unlimited nested categories</p>
    </div>
    <a href="{{ route('admin.product-categories.create') }}" class="btn-new text-decoration-none">
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
                            @if($category->image)
                                <img src="{{ asset('storage/' . $category->image->file_path) }}" class="rounded shadow-sm" style="width: 45px; height: 45px; object-fit: cover;" alt="Img">
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
                            <a href="{{ route('admin.product-categories.edit', $category->id) }}" class="action-btn action-btn-edit" title="Edit"><i class="fa-solid fa-pen"></i></a>
                            <form action="{{ route('admin.product-categories.destroy', $category->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="action-btn action-btn-delete" style="border: none;" title="Delete"
                                    onclick="confirmDeleteProdCat('{{ route('admin.product-categories.destroy', $category->id) }}', '{{ addslashes($category->name) }}')"
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
        <div class="custom-info" id="customInfo">Showing 1 to 1 of 1 entries</div>
        <div class="d-flex align-items-center" id="customPagination">
            <!-- Rendered via JS -->
        </div>
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
            "order": [],
            "columnDefs": [
                { "orderable": false, "targets": [1, 5] } // Disable sorting on image and actions
            ],
            "pageLength": 10,
            "dom": '<"top">rt<"bottom"><"clear">',
            "language": {
                "emptyTable": "No categories found."
            }
        });

        $('#customSearch').on('keyup', function() { table.search(this.value).draw(); });
        $('#customLength').on('change', function() { table.page.len($(this).val()).draw(); });

        function updateCustomPagination() {
            var info = table.page.info();
            var recordsText = info.recordsDisplay === 0 ? 0 : info.start + 1;
            $('#customInfo').text('Showing ' + recordsText + ' to ' + info.end + ' of ' + info.recordsDisplay + ' entries');

            var paginateHtml = '';
            
            // Prev Button
            if (info.page > 0) {
                paginateHtml += '<a class="paginate-btn" data-page="prev">Previous</a>';
            } else {
                paginateHtml += '<a class="paginate-btn" style="opacity: 0.5; cursor: not-allowed;">Previous</a>';
            }

            for (var i = 0; i < info.pages; i++) {
                var activeClass = (i === info.page) ? 'active' : '';
                paginateHtml += '<a class="paginate-btn ' + activeClass + '" data-page="' + i + '">' + (i + 1) + '</a>';
            }

            // Next Button
            if (info.page < info.pages - 1) {
                paginateHtml += '<a class="paginate-btn" data-page="next">Next</a>';
            } else {
                paginateHtml += '<a class="paginate-btn" style="opacity: 0.5; cursor: not-allowed;">Next</a>';
            }

            $('#customPagination').html(paginateHtml);
        }

        $('#customPagination').on('click', '.paginate-btn[data-page]', function() {
            var action = $(this).data('page');
            if(action === 'prev') { table.page('previous').draw('page'); } 
            else if (action === 'next') { table.page('next').draw('page'); } 
            else { table.page(action).draw('page'); }
        });

        table.on('draw', function() { updateCustomPagination(); });
        updateCustomPagination();
    });
</script>

<script>
    function confirmDeleteProdCat(url, name) {
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
