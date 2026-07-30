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
    .btn-restore {
        background: #dcfce7;
        color: #166534;
        border: 1px solid #bbf7d0;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
    }
    .btn-restore:hover {
        background: #bbf7d0;
    }
    .btn-delete-permanent {
        background: #fee2e2;
        color: #991b1b;
        border: 1px solid #fecaca;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
    }
    .btn-delete-permanent:hover {
        background: #fecaca;
    }
</style>

<div class="d-flex align-items-center justify-content-between mt-4 mb-4">
    <div>
        <h4 class="mb-0 font-weight-bold" style="color: #1e2340; font-family: 'Inter', sans-serif;">Blog Trash</h4>
        <p class="text-muted mb-0" style="font-size: 13.5px;">Restore or permanently delete soft-deleted blogs</p>
    </div>
    <div>
        <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="fa-solid fa-arrow-left me-1"></i> Back to Blogs
        </a>
    </div>
</div>



<div class="custom-table-wrapper mt-4">
    <div class="table-responsive">
        <table class="custom-table">
            <thead>
                <tr>
                    <th style="color: var(--ins-primary);">#</th>
                    <th style="color: var(--ins-primary);">TITLE & SLUG</th>
                    <th style="color: var(--ins-primary);">CATEGORY</th>
                    <th style="color: var(--ins-primary);">DELETED AT</th>
                    <th class="text-center" style="color: var(--ins-primary);">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @forelse($trashedBlogs as $blog)
                    <tr>
                        <td style="color: #64748b; font-weight: 500; font-size: 13px;">{{ $loop->iteration }}</td>
                        <td>
                            <div style="font-weight: 600; color: #1e293b; font-size: 14px;">{{ $blog->title }}</div>
                            <div style="font-size: 12px; color: #94a3b8;">{{ $blog->slug }}</div>
                        </td>
                        <td>
                            {{ $blog->category ? $blog->category->name : 'Uncategorized' }}
                        </td>
                        <td style="color: #64748b; font-size: 12.5px;">
                            {{ $blog->deleted_at->format('d M Y, h:i A') }}
                        </td>
                        <td class="text-center">
                            <form action="{{ route('admin.blogs.restore', $blog->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                <button type="submit" class="btn-restore me-1" title="Restore"><i class="fa-solid fa-arrow-rotate-left me-1"></i> Restore</button>
                            </form>
                            <form action="{{ route('admin.blogs.force_delete', $blog->id) }}" method="POST" class="d-inline-block" id="forceDeleteForm_{{ $blog->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn-delete-permanent" title="Permanent Delete"
                                    onclick="confirmForceDelete('{{ route('admin.blogs.force_delete', $blog->id) }}', '{{ addslashes($blog->title) }}')">
                                    <i class="fa-solid fa-trash-can me-1"></i> Delete Permanently
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="fa-regular fa-folder-open mb-2 d-block" style="font-size: 24px;"></i>
                            Trash is empty. No deleted blogs found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function confirmForceDelete(url, title) {
        showConfirm({
            title: 'Permanently Delete?',
            message: '"' + title + '" will be permanently deleted and cannot be recovered.',
            okText: 'Delete Permanently',
            type: 'danger',
            icon: 'ti-trash-x',
            onConfirm: function() {
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = url;
                form.innerHTML = '@csrf @method("DELETE")';
                // Re-build CSRF & method fields
                var csrf = document.createElement('input');
                csrf.type = 'hidden'; csrf.name = '_token';
                csrf.value = '{{ csrf_token() }}';
                var method = document.createElement('input');
                method.type = 'hidden'; method.name = '_method'; method.value = 'DELETE';
                form.appendChild(csrf); form.appendChild(method);
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
</script>
@endsection
