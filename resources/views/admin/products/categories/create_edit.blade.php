@extends('admin.layouts.app')

@section('content')
<style>
    body { font-family: 'Inter', sans-serif; }
    
    /* Variables */
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

    /* Cards */
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
        border-radius: 10px;
        background: var(--primary-light);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        margin-right: 16px;
    }
    .card-header-text h5 {
        color: var(--text-main);
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 4px;
    }
    .card-header-text p {
        color: #94a3b8;
        font-size: 13px;
        margin-bottom: 0;
    }

    /* Form Elements */
    .form-label {
        font-size: 13.5px;
        color: var(--text-main);
        font-weight: 600;
        margin-bottom: 8px;
    }
    
    .custom-input-group {
        display: flex;
        border: 1px solid var(--border-color);
        border-radius: 10px;
        background: white;
        overflow: hidden;
        transition: all 0.2s;
        box-shadow: 0 1px 2px rgba(0,0,0,0.01);
    }
    .custom-input-group:focus-within {
        border-color: #a5b4fc;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }
    .input-icon-box {
        width: 46px;
        background: #f8fafc;
        border-right: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-size: 16px;
    }
    .input-icon-box i {
        color: var(--primary);
        opacity: 0.8;
    }
    .custom-input-group .form-control, .custom-input-group .form-select {
        border: none;
        border-radius: 0;
        padding: 12px 16px;
        font-size: 14px;
        color: var(--text-main);
        background: transparent;
        box-shadow: none;
    }
    .custom-input-group .form-control::placeholder { color: #cbd5e1; }
    
    .char-count {
        text-align: right;
        font-size: 11px;
        color: #94a3b8;
        margin-top: -24px;
        margin-right: 12px;
        position: relative;
        z-index: 2;
        pointer-events: none;
    }
    
    .helper-text {
        font-size: 12px;
        color: var(--text-sub);
        margin-top: 6px;
        display: block;
    }

    /* Media Drop Area */
    .media-drop-area {
        border: 2px dashed var(--border-color);
        border-radius: 12px;
        padding: 32px 20px;
        text-align: center;
        background: var(--card-bg);
        transition: all 0.2s;
        position: relative;
        overflow: hidden;
    }
    .media-drop-area:hover {
        border-color: var(--primary);
    }
    .media-upload-icon {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: var(--primary-light);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin: 0 auto 16px;
    }
    .media-text {
        color: var(--text-sub);
        font-size: 13px;
        margin-bottom: 16px;
    }
    .btn-browse {
        background: var(--card-bg);
        color: var(--primary);
        border: 1px solid var(--primary-light);
        border-radius: 8px;
        padding: 8px 24px;
        font-size: 13px;
        font-weight: 600;
        transition: all 0.2s;
    }
    .btn-browse:hover {
        background: var(--primary-light);
    }

    /* Toggle Switch */
    .switch-container {
        display: flex;
        align-items: center;
    }
    .switch {
        position: relative;
        display: inline-block;
        width: 44px;
        height: 24px;
        margin-right: 12px;
    }
    .switch input { opacity: 0; width: 0; height: 0; }
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0; left: 0; right: 0; bottom: 0;
        background-color: var(--border-color);
        transition: .4s;
        border-radius: 34px;
    }
    .slider:before {
        position: absolute;
        content: "";
        height: 18px; width: 18px;
        left: 3px; bottom: 3px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
        box-shadow: 0 1px 2px rgba(0,0,0,0.1);
    }
    input:checked + .slider { background-color: var(--primary); }
    input:checked + .slider:before { transform: translateX(20px); }
    .switch-label { font-size: 14px; color: var(--text-main); font-weight: 600; }

    /* Tips Card */
    .tips-card {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 32px;
        position: relative;
        overflow: hidden;
    }
    .tips-header {
        display: flex;
        align-items: center;
        margin-bottom: 24px;
    }
    .tips-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--primary);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        margin-right: 16px;
        box-shadow: 0 4px 10px rgba(99, 102, 241, 0.3);
    }
    .tips-header h5 {
        color: var(--text-main);
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 0;
    }
    .tips-list {
        list-style: none;
        padding: 0;
        margin: 0;
        position: relative;
        z-index: 2;
    }
    .tips-list li {
        display: flex;
        align-items: flex-start;
        margin-bottom: 12px;
        font-size: 13px;
        color: var(--text-main);
        font-weight: 500;
    }
    .tips-list li i {
        color: var(--primary);
        margin-top: 3px;
        margin-right: 12px;
        font-size: 14px;
    }
    
    /* Illustration */
    .tips-illustration {
        position: absolute;
        bottom: -20px;
        right: -10px;
        width: 180px;
        height: 160px;
        z-index: 1;
        opacity: 0.9;
        display: flex;
        align-items: flex-end;
        justify-content: flex-end;
    }
    .ill-folder {
        width: 120px;
        height: 90px;
        background: var(--primary);
        border-radius: 12px;
        position: relative;
        box-shadow: -10px 10px 20px rgba(99, 102, 241, 0.2);
    }
    .ill-folder::before {
        content: '';
        position: absolute;
        top: -15px;
        left: 0;
        width: 50px;
        height: 25px;
        background: var(--primary);
        border-radius: 8px 8px 0 0;
    }
    .ill-paper {
        position: absolute;
        width: 70px;
        height: 80px;
        background: white;
        border-radius: 8px;
        top: -40px;
        right: 20px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        border: 1px solid #f1f5f9;
        display: flex;
        flex-direction: column;
        padding: 12px;
        transform: rotate(5deg);
    }
    .ill-line {
        height: 4px;
        background: #e2e8f0;
        border-radius: 2px;
        margin-bottom: 8px;
    }
    .ill-line.short { width: 60%; }
    .ill-dots {
        position: absolute;
        top: 20px;
        right: 30px;
        display: grid;
        grid-template-columns: repeat(4, 4px);
        gap: 6px;
    }
    .ill-dots span {
        width: 4px;
        height: 4px;
        background: #cbd5e1;
        border-radius: 50%;
    }
    .ill-leaf {
        position: absolute;
        bottom: 20px;
        left: -30px;
        color: #a5b4fc;
        font-size: 40px;
        transform: rotate(-30deg);
    }
    .ill-leaf-2 {
        position: absolute;
        bottom: 10px;
        right: -10px;
        color: #a5b4fc;
        font-size: 30px;
        transform: rotate(40deg);
    }
</style>

<form id="categoryForm" action="{{ isset($category) ? route('admin.product-categories.update', $category->id) : route('admin.product-categories.store') }}" method="POST">
    @csrf
    @if(isset($category)) @method('PUT') @endif
    
    <!-- Top Bar -->
    <div class="top-bar-card mt-2">
        <div>
            <div class="breadcrumb-wrap">
                <a href="{{ route('admin.product-categories.index') }}" class="back-btn-icon">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <i class="fa-solid fa-chevron-right separator"></i>
                <a href="{{ route('admin.product-categories.index') }}">Categories</a>
                <i class="fa-solid fa-chevron-right separator"></i>
                <span class="current">{{ isset($category) ? 'Edit Category' : 'Create Category' }}</span>
            </div>
            <h4 class="page-title-text">{{ isset($category) ? 'Edit Category' : 'Create Category' }}</h4>
            <p class="page-subtitle">Add a new category to organize your products and content.</p>
        </div>
        <div class="d-flex gap-3 align-items-center mt-3 mt-md-0">
            <a href="{{ route('admin.product-categories.index') }}" class="btn-cancel text-decoration-none">
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
                        <p>Enter the basic details of the category.</p>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="form-label">Category Name <span class="text-danger">*</span></label>
                    <div class="custom-input-group">
                        <div class="input-icon-box"><i class="fa-solid fa-tag"></i></div>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $category->name ?? '') }}" required placeholder="e.g. LT Panels">
                    </div>
                    @error('name') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
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
                    <div class="char-count" id="charCount">{{ isset($category) ? strlen($category->description) : 0 }} / 500</div>
                    @error('description') <div class="invalid-feedback d-block mt-3">{{ $message }}</div> @enderror
                </div>
            </div>
            
            <!-- Tips Card -->
            <div class="tips-card d-none d-lg-block">
                <div class="ill-dots">
                    <span></span><span></span><span></span><span></span>
                    <span></span><span></span><span></span><span></span>
                    <span></span><span></span><span></span><span></span>
                </div>
                
                <div class="tips-header">
                    <div class="tips-icon"><i class="fa-regular fa-lightbulb"></i></div>
                    <h5>Category Tips</h5>
                </div>
                
                <ul class="tips-list">
                    <li><i class="fa-solid fa-check"></i> Choose a clear and descriptive name for your category.</li>
                    <li><i class="fa-solid fa-check"></i> Set the parent category if this is a sub-category.</li>
                    <li><i class="fa-solid fa-check"></i> Add an image and icon to make the category more attractive.</li>
                    <li><i class="fa-solid fa-check"></i> Use sort order to control the display position.</li>
                </ul>
                
                <div class="tips-illustration">
                    <i class="fa-solid fa-leaf ill-leaf"></i>
                    <i class="fa-solid fa-leaf ill-leaf-2"></i>
                    <div class="ill-folder">
                        <div class="ill-paper">
                            <div class="ill-line short" style="margin-bottom: 12px; width: 30px; height: 30px; border-radius: 50%; background: #e0e7ff; border: 2px solid var(--primary);"></div>
                            <div class="ill-line"></div>
                            <div class="ill-line short"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="col-lg-5 col-xl-4">
            <!-- Media & Icon -->
            <div class="custom-card">
                <div class="card-header-custom">
                    <div class="card-header-icon"><i class="fa-regular fa-image"></i></div>
                    <div class="card-header-text">
                        <h5>Media & Icon</h5>
                        <p>Add an image and icon for the category.</p>
                    </div>
                </div>
                
                <div class="mb-0">
                    <label class="form-label">Category Image</label>
                    <div class="media-drop-area" id="mediaDropArea" onclick="document.getElementById('categoryImageInput').click();">
                        @if(isset($category) && $category->image)
                            <img id="imagePreview" src="{{ asset('storage/' . $category->image->file_path) }}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: 2;">
                        @else
                            <img id="imagePreview" src="" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: 2; display: none;">
                        @endif
                        
                        <div style="position: relative; z-index: 1;" id="mediaUploadContent">
                            <div class="media-upload-icon"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                            <p class="media-text">Click to upload from computer<br>or</p>
                            <button type="button" class="btn-browse" onclick="event.stopPropagation(); openMediaModal('image_id', 'imagePreview')">Browse Library</button>
                        </div>  
                        
                        <!-- Uploading Indicator -->
                        <div id="mediaUploadingIndicator" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255,255,255,0.9); z-index: 3; display: none; align-items: center; justify-content: center; flex-direction: column;">
                            <div class="spinner-border text-primary mb-2" role="status"></div>
                            <span style="font-size: 13px; font-weight: 600; color: var(--primary);">Uploading to Library...</span>
                        </div>
                    </div>
                    
                    <input type="file" id="categoryImageInput" class="d-none" accept="image/*" onchange="uploadToMediaLibrary(this)">
                    <input type="hidden" name="image_id" id="image_id" value="{{ old('image_id', $category->image_id ?? '') }}">
                    
                    <span class="helper-text text-center">Recommended size: 1200 x 800px (Max: 2MB)</span>
                </div>
            </div>

            <!-- Settings -->
            <div class="custom-card">
                <div class="card-header-custom">
                    <div class="card-header-icon"><i class="fa-solid fa-gear"></i></div>
                    <div class="card-header-text">
                        <h5>Settings</h5>
                        <p>Configure additional category settings.</p>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="form-label">Status</label>
                    <div class="switch-container">
                        <label class="switch">
                            <input type="checkbox" name="status" id="status" value="1" {{ old('status', $category->status ?? true) ? 'checked' : '' }}>
                            <span class="slider"></span>
                        </label>
                        <span class="switch-label">Active (Visible)</span>
                    </div>
                    <span class="helper-text mt-2">Inactive categories will be hidden from the front end.</span>
                </div>

                <div class="mb-0">
                    <label class="form-label">Sort Order</label>
                    <div class="custom-input-group">
                        <div class="input-icon-box"><i class="fa-solid fa-arrow-down-up-across-line"></i></div>
                        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $category->sort_order ?? 0) }}">
                    </div>
                    <span class="helper-text">Lower numbers appear first in the list.</span>
                </div>
            </div>
        </div>
    </div>
</form>

@include('admin.partials.media-modal')
@endsection

@section('scripts')
<script>
    let currentInputId = null;
    let currentPreviewId = null;

    function openMediaModal(inputId, previewId) {
        currentInputId = inputId;
        currentPreviewId = previewId;
        var myModal = new bootstrap.Modal(document.getElementById('mediaSelectModal'));
        myModal.show();
    }

    function uploadToMediaLibrary(input) {
        if (!input.files || !input.files[0]) return;
        
        let formData = new FormData();
        formData.append('files[]', input.files[0]);
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('folder_name', 'Product Categories');
        
        document.getElementById('mediaUploadingIndicator').style.display = 'flex';
        
        fetch('{{ route('admin.media.store') }}', {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('mediaUploadingIndicator').style.display = 'none';
            if (data.success && data.files && data.files.length > 0) {
                let uploadedMedia = data.files[0];
                document.getElementById('image_id').value = uploadedMedia.id;
                let previewImg = document.getElementById('imagePreview');
                previewImg.src = '{{ asset('storage') }}/' + uploadedMedia.file_path;
                previewImg.style.display = 'block';
                
                if(typeof showToast === 'function') {
                    showToast('Success', 'Image uploaded to Library successfully!', 'success');
                }
            } else {
                alert('Upload failed: ' + (data.message || 'Unknown error'));
            }
        })
        .catch(error => {
            document.getElementById('mediaUploadingIndicator').style.display = 'none';
            alert('Upload failed. Please try again.');
            console.error('Error:', error);
        });
        
        // Reset input so the same file can be selected again if needed
        input.value = '';
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
