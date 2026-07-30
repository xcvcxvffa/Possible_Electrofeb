@extends('admin.layouts.app')

@section('content')
<style>
    body { font-family: 'Inter', sans-serif; }
    
    :root {
        --primary: var(--ins-primary);
        --primary-light: rgba(var(--ins-primary-rgb), 0.1);
        --text-main: var(--ins-heading-color, #1e293b);
        --text-sub: var(--ins-body-color, #64748b);
        --border-color: var(--ins-border-color, #e2e8f0);
        --card-bg: var(--ins-secondary-bg, #ffffff);
    }

    .top-bar-card {
        background: var(--card-bg);
        border-radius: 16px;
        padding: 24px 32px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02), 0 10px 20px -5px rgba(0,0,0,0.02);
        margin-bottom: 24px;
        border: 1px solid #f1f5f9;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }
    
    .breadcrumb-wrap {
        display: flex;
        align-items: center;
        margin-bottom: 16px;
        font-size: 13px;
        font-weight: 500;
        color: var(--text-sub);
    }
    .back-btn-icon {
        width: 28px;
        height: 28px;
        border-radius: 6px;
        background: var(--primary-light);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
        text-decoration: none;
        transition: all 0.2s;
    }
    .back-btn-icon:hover { background: #c7d2fe; color: var(--primary); }
    .breadcrumb-wrap a { color: var(--text-sub); text-decoration: none; }
    .breadcrumb-wrap a:hover { color: var(--primary); }
    .breadcrumb-wrap .separator { margin: 0 8px; font-size: 10px; color: #cbd5e1; }
    .breadcrumb-wrap .current { color: var(--text-main); font-weight: 600; }
    
    .page-title-text { color: var(--text-main); font-weight: 700; font-size: 1.5rem; margin-bottom: 4px; }
    .page-subtitle { color: #94a3b8; font-size: 14px; margin-bottom: 0; }
    
    .btn-cancel {
        background: white;
        color: var(--text-main);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 10px 20px;
        font-size: 14px;
        font-weight: 600;
        transition: all 0.2s;
        box-shadow: 0 1px 2px rgba(0,0,0,0.02);
    }
    .btn-cancel:hover { background: #f8fafc; border-color: #cbd5e1; }
    
    .btn-save {
        background: var(--primary);
        color: white;
        border: 1px solid var(--primary);
        border-radius: 8px;
        padding: 10px 24px;
        font-size: 14px;
        font-weight: 600;
        transition: all 0.2s;
        box-shadow: 0 4px 6px -1px rgba(99, 102, 241, 0.2);
    }
    .btn-save:hover { background: #4f46e5; border-color: #4f46e5; color: white; box-shadow: 0 6px 8px -1px rgba(99, 102, 241, 0.3); }

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
        margin-bottom: 28px;
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
    .card-header-text h5 {
        font-size: 16px;
        font-weight: 700;
        color: var(--text-main);
        margin: 0 0 4px 0;
    }
    .card-header-text p {
        font-size: 13px;
        color: var(--text-sub);
        margin: 0;
    }
    
    .form-label {
        font-size: 13.5px;
        font-weight: 600;
        color: var(--text-main);
        margin-bottom: 8px;
    }
    .custom-input-group {
        display: flex;
        align-items: center;
        border: 1px solid var(--border-color);
        border-radius: 10px;
        background: var(--card-bg);
        transition: all 0.2s;
        overflow: hidden;
    }
    .custom-input-group:focus-within {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }
    .input-icon-box {
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #94a3b8;
        background: rgba(var(--ins-dark-rgb), 0.02);
        border-right: 1px solid var(--border-color);
        font-size: 14px;
    }
    .form-control, .form-select {
        border: none !important;
        box-shadow: none !important;
        padding: 10px 14px;
        font-size: 14px;
        color: var(--text-main);
        background: transparent;
    }
    
    .media-drop-area {
        border: 2px dashed #cbd5e1;
        border-radius: 12px;
        padding: 32px 20px;
        text-align: center;
        background: #f8fafc;
        cursor: pointer;
        transition: all 0.2s;
        position: relative;
        overflow: hidden;
    }
    .media-drop-area:hover {
        border-color: var(--primary);
        background: #f1f5f9;
    }
    .media-upload-icon {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: #e0e7ff;
        color: var(--primary);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        margin-bottom: 12px;
    }
    .btn-browse {
        background: var(--primary);
        color: white;
        border: none;
        border-radius: 6px;
        padding: 8px 16px;
        font-size: 13px;
        font-weight: 500;
        margin-top: 8px;
    }
    
    .status-toggle-wrapper {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px;
        background: #f8fafc;
        border: 1px solid var(--border-color);
        border-radius: 12px;
    }
    .status-title { font-weight: 600; font-size: 14px; color: var(--text-main); margin-bottom: 2px; }
    .status-desc { font-size: 12px; color: var(--text-sub); margin: 0; }
    
    .char-count { font-size: 12px; color: #94a3b8; text-align: right; margin-top: 4px; }
</style>

<form id="categoryForm" action="{{ isset($category) ? route('admin.blog-categories.update', $category->id) : route('admin.blog-categories.store') }}" method="POST">
    @csrf
    @if(isset($category)) @method('PUT') @endif
    
    <!-- Top Bar -->
    <div class="top-bar-card mt-2">
        <div>
            <div class="breadcrumb-wrap">
                <a href="{{ route('admin.blog-categories.index') }}" class="back-btn-icon">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <i class="fa-solid fa-chevron-right separator"></i>
                <a href="{{ route('admin.blog-categories.index') }}">Blog Categories</a>
                <i class="fa-solid fa-chevron-right separator"></i>
                <span class="current">{{ isset($category) ? 'Edit Category' : 'Create Category' }}</span>
            </div>
            <h4 class="page-title-text">{{ isset($category) ? 'Edit Blog Category' : 'Create Blog Category' }}</h4>
            <p class="page-subtitle">Add a new category to organize your blog posts.</p>
        </div>
        <div class="d-flex gap-3 align-items-center mt-3 mt-md-0">
            <a href="{{ route('admin.blog-categories.index') }}" class="btn-cancel text-decoration-none">
                <i class="fa-solid fa-xmark me-2"></i> Cancel
            </a>
            <button type="submit" class="btn-save">
                <i class="fa-regular fa-floppy-disk me-2"></i> {{ isset($category) ? 'Update Category' : 'Save Category' }}
            </button>
        </div>
    </div>

    <div class="row">
        <!-- Left Column -->
        <div class="col-lg-7 col-xl-8">
            <div class="custom-card">
                <div class="card-header-custom">
                    <div class="card-header-icon"><i class="fa-regular fa-file-lines"></i></div>
                    <div class="card-header-text">
                        <h5>General Information</h5>
                        <p>Enter the basic details of the blog category.</p>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="form-label">Category Name <span class="text-danger">*</span></label>
                    <div class="custom-input-group">
                        <div class="input-icon-box"><i class="fa-solid fa-tag"></i></div>
                        <input type="text" name="name" id="categoryName" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $category->name ?? '') }}" required placeholder="e.g. Industrial Automation">
                    </div>
                    @error('name') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label">URL Slug <span class="text-danger">*</span></label>
                    <div class="custom-input-group">
                        <div class="input-icon-box"><i class="fa-solid fa-link"></i></div>
                        <input type="text" name="slug" id="categorySlug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', $category->slug ?? '') }}" required placeholder="e.g. industrial-automation">
                    </div>
                    @error('slug') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label">Parent Category</label>
                    <div class="custom-input-group">
                        <div class="input-icon-box"><i class="fa-regular fa-folder"></i></div>
                        <select name="parent_id" class="form-select @error('parent_id') is-invalid @enderror" style="cursor: pointer;">
                            <option value="">None (Top Level Category)</option>
                            @foreach($parentCategories as $parent)
                                @if(!isset($category) || $category->id !== $parent->id)
                                    <option value="{{ $parent->id }}" {{ old('parent_id', $category->parent_id ?? '') == $parent->id ? 'selected' : '' }}>
                                        {{ $parent->name }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    @error('parent_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                </div>

                <div class="mb-0">
                    <label class="form-label">Description</label>
                    <div class="custom-input-group" style="align-items: flex-start;">
                        <div class="input-icon-box" style="height: 100%; min-height: 120px; align-items: flex-start; padding-top: 16px;"><i class="fa-solid fa-align-left"></i></div>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4" placeholder="Optional description about this category..." onkeyup="document.getElementById('charCount').innerText = this.value.length + ' / 500'" maxlength="500">{{ old('description', $category->description ?? '') }}</textarea>
                    </div>
                    <div class="char-count" id="charCount">{{ isset($category) ? strlen($category->description ?? '') : 0 }} / 500</div>
                    @error('description') <div class="invalid-feedback d-block mt-3">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="col-lg-5 col-xl-4">
            <!-- Media -->
            <div class="custom-card">
                <div class="card-header-custom">
                    <div class="card-header-icon"><i class="fa-regular fa-image"></i></div>
                    <div class="card-header-text">
                        <h5>Category Image</h5>
                        <p>Select an image from the Media Library.</p>
                    </div>
                </div>
                
                <div class="mb-0">
                    <div class="media-drop-area" onclick="openMediaModal('image_media_id', 'imagePreview')">
                        @if(isset($category) && $category->imageMedia)
                            <img id="imagePreview" src="{{ asset('storage/' . $category->imageMedia->file_path) }}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: 2;">
                        @else
                            <img id="imagePreview" src="" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: 2; display: none;">
                        @endif
                        
                        <div style="position: relative; z-index: 1;">
                            <div class="media-upload-icon"><i class="fa-solid fa-image"></i></div>
                            <p class="media-text mb-1" style="font-size: 13px; color: var(--text-main); font-weight: 600;">Select Category Image</p>
                            <button type="button" class="btn-browse" onclick="event.stopPropagation(); openMediaModal('image_media_id', 'imagePreview')">Browse Library</button>
                        </div>  
                    </div>
                    <input type="hidden" name="image_media_id" id="image_media_id" value="{{ old('image_media_id', $category->image_media_id ?? '') }}">
                    @error('image_media_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                </div>
            </div>

            <!-- Status & Sorting -->
            <div class="custom-card">
                <div class="card-header-custom">
                    <div class="card-header-icon"><i class="fa-solid fa-sliders"></i></div>
                    <div class="card-header-text">
                        <h5>Status & Sort Order</h5>
                        <p>Control visibility and ordering.</p>
                    </div>
                </div>
                
                <div class="status-toggle-wrapper mb-4">
                    <div>
                        <div class="status-title">Category Status</div>
                        <p class="status-desc">Active categories are publicly visible.</p>
                    </div>
                    <div class="form-check form-switch m-0">
                        <input type="hidden" name="status" value="0">
                        <input class="form-check-input" type="checkbox" name="status" value="1" id="statusSwitch" style="width: 44px; height: 22px; cursor: pointer;" {{ old('status', $category->status ?? true) ? 'checked' : '' }}>
                    </div>
                </div>

                <div class="mb-0">
                    <label class="form-label">Sort Order</label>
                    <div class="custom-input-group">
                        <div class="input-icon-box"><i class="fa-solid fa-arrow-down-1-9"></i></div>
                        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $category->sort_order ?? 0) }}">
                    </div>
                    <span class="text-muted d-block mt-1" style="font-size: 12px;">Lower numbers appear first in the list.</span>
                </div>
            </div>
        </div>
    </div>
</form>

@include('admin.partials.media-modal')
@endsection

@section('scripts')
<script>
    // Auto generate slug from name if creating
    @if(!isset($category))
    document.getElementById('categoryName').addEventListener('keyup', function() {
        let slug = this.value.toLowerCase()
            .replace(/[^\w\s-]/g, '')
            .replace(/[\s_-]+/g, '-')
            .replace(/^-+|-+$/g, '');
        document.getElementById('categorySlug').value = slug;
    });
    @endif

    let currentInputId = null;
    let currentPreviewId = null;

    function openMediaModal(inputId, previewId) {
        currentInputId = inputId;
        currentPreviewId = previewId;
        var myModal = new bootstrap.Modal(document.getElementById('mediaSelectModal'));
        myModal.show();
    }

    function handleMediaSelection(mediaId, mediaUrl) {
        if(currentInputId && currentPreviewId) {
            document.getElementById(currentInputId).value = mediaId;
            let previewImg = document.getElementById(currentPreviewId);
            
            previewImg.src = mediaUrl;
            previewImg.style.display = 'block';
        }
        var modalEl = document.getElementById('mediaSelectModal');
        var modal = bootstrap.Modal.getInstance(modalEl);
        if (modal) {
            modal.hide();
        }
    }
</script>
@endsection
