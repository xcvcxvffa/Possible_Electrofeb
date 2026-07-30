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
</style>

<div class="container-fluid pt-4">
    <div class="row mb-4 align-items-center">
        <div class="col-sm-6">
            <h4 class="mb-0" style="font-size: 20px; font-weight: 600; color: var(--ins-heading-color);">Jobs Trash</h4>
        </div>
        <div class="col-sm-6 text-sm-end mt-3 mt-sm-0">
            <a href="{{ route('admin.careers.index') }}" class="btn btn-light" style="border-radius: 8px;">
                <i class="fa-solid fa-arrow-left me-1"></i> Back to Jobs
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 8px;">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="custom-table-wrapper">
        <form id="bulk-action-form" action="{{ route('admin.careers.bulk_action') }}" method="POST">
            @csrf
            <input type="hidden" name="ids" id="bulk-ids" value="">
            <div class="d-flex justify-content-between mb-3 align-items-center">
                <div>
                    <select name="action" class="form-select form-select-sm d-inline-block w-auto">
                        <option value="">Bulk Actions</option>
                        <option value="restore">Restore Selected</option>
                    </select>
                    <button type="button" class="btn btn-sm btn-light ms-1" onclick="submitBulkAction()">Apply</button>
                </div>
                <div class="text-muted small">
                    Showing {{ $careers->count() }} items in trash
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th width="40"><input class="form-check-input" type="checkbox" id="check-all"></th>
                            <th>Job Title / Code</th>
                            <th>Department & Location</th>
                            <th>Deleted At</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($careers as $career)
                            <tr>
                                <td><input class="form-check-input check-item" type="checkbox" value="{{ $career->id }}"></td>
                                <td>
                                    <strong style="color: var(--ins-heading-color); font-size: 15px;">{{ $career->title }}</strong>
                                    @if($career->job_code)
                                        <div class="text-muted small">{{ $career->job_code }}</div>
                                    @endif
                                </td>
                                <td>
                                    <div>{{ $career->department?->name ?? '-' }}</div>
                                    <div class="text-muted small">{{ $career->location?->city ?? 'Remote/Any' }}</div>
                                </td>
                                <td>
                                    <div class="text-muted">{{ $career->deleted_at->format('d M, Y H:i') }}</div>
                                    <div class="small">By User #{{ $career->deleted_by }}</div>
                                </td>
                                <td class="text-end">
                                    <button type="button" class="btn btn-sm btn-soft-success me-1" onclick="restoreItem({{ $career->id }})" title="Restore">
                                        <i class="fa-solid fa-rotate-left"></i> Restore
                                    </button>
                                    <button type="button" class="btn btn-sm btn-soft-danger" onclick="deleteItem({{ $career->id }})" title="Permanently Delete">
                                        <i class="fa-regular fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="fa-solid fa-trash-can fa-2x mb-3 text-light"></i>
                                    <p class="mb-0">Trash is empty.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>

<script>
    function restoreItem(id) {
        let form = document.createElement('form');
        form.method = 'POST';
        form.action = '/admin/careers/' + id + '/restore';
        form.innerHTML = '@csrf';
        document.body.appendChild(form);
        form.submit();
    }

    function deleteItem(id) {
        if(confirm('WARNING: This will permanently delete the job. This action cannot be undone. Proceed?')) {
            let form = document.createElement('form');
            form.method = 'POST';
            form.action = '/admin/careers/' + id + '/force-delete';
            form.innerHTML = '@csrf @method("DELETE")';
            document.body.appendChild(form);
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
