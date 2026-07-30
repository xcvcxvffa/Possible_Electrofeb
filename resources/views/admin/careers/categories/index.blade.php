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
    .btn-new:hover { filter: brightness(0.9); color: white; }
    
    .cat-icon-preview {
        width: 32px;
        height: 32px;
        border-radius: 6px;
        object-fit: contain;
        background: #f8f9fa;
        border: 1px solid #e9ecef;
    }
</style>

<div class="container-fluid pt-4">
    <div class="row mb-4 align-items-center">
        <div class="col-sm-6">
            <h4 class="mb-0" style="font-size: 20px; font-weight: 600; color: var(--ins-heading-color);">Career Categories</h4>
        </div>
        <div class="col-sm-6 text-sm-end mt-3 mt-sm-0">
            <a href="{{ route('admin.career-categories.create') }}" class="btn-new">
                <i class="fa-regular fa-plus me-1"></i> Add Category
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
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="career-categories-table">
                <thead class="bg-light">
                    <tr>
                        <th width="60">Icon</th>
                        <th>Name</th>
                        <th>Parent Category</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td>
                                @if($category->iconMedia)
                                    <img src="{{ $category->iconMedia->thumbnail_url }}" alt="icon" class="cat-icon-preview">
                                @else
                                    <div class="cat-icon-preview d-flex align-items-center justify-content-center text-muted">
                                        <i class="fa-regular fa-image"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <strong style="color: var(--ins-heading-color);">{{ $category->name }}</strong>
                                <div class="text-muted small">{{ $category->slug }}</div>
                            </td>
                            <td>
                                @if($category->parent)
                                    <span class="badge bg-light text-dark border">{{ $category->parent->name }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($category->status)
                                    <span class="badge bg-success" style="padding: 6px 12px; border-radius: 20px;">Active</span>
                                @else
                                    <span class="badge bg-danger" style="padding: 6px 12px; border-radius: 20px;">Inactive</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.career-categories.edit', $category->id) }}" class="btn btn-sm btn-soft-primary me-2" style="border-radius: 6px; padding: 6px 12px;">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-soft-danger" style="border-radius: 6px; padding: 6px 12px;" 
                                    onclick="showConfirm('Are you sure you want to delete this category?', function() { document.getElementById('delete-form-{{ $category->id }}').submit(); })">
                                    <i class="fa-regular fa-trash"></i>
                                </button>
                                <form id="delete-form-{{ $category->id }}" action="{{ route('admin.career-categories.destroy', $category->id) }}" method="POST" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">No career categories found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
