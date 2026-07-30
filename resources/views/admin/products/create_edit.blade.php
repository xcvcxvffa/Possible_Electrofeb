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
    .back-btn-icon:hover { background: #bae6fd; color: var(--primary); }
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
        box-shadow: 0 4px 6px -1px rgba(0, 188, 212, 0.2);
    }
    .btn-save:hover { background: #00acc1; border-color: #00acc1; color: white; box-shadow: 0 6px 8px -1px rgba(0, 188, 212, 0.3); }

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
        border-color: #38bdf8;
        box-shadow: 0 0 0 4px rgba(56, 189, 248, 0.1);
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
    .custom-input-group .form-control, .custom-input-group .form-select, .form-control {
        border: none;
        border-radius: 0;
        padding: 12px 16px;
        font-size: 14px;
        color: var(--text-main);
        background: transparent;
        box-shadow: none;
    }
    .form-control.standalone {
        border: 1px solid var(--border-color);
        border-radius: 10px;
    }
    .form-control.standalone:focus {
        border-color: #38bdf8;
        box-shadow: 0 0 0 4px rgba(56, 189, 248, 0.1);
    }
    .custom-input-group .form-control::placeholder, .form-control::placeholder { color: #cbd5e1; }
    
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
        cursor: pointer;
    }
    .media-drop-area:hover {
        background: #f1f5f9;
        border-color: #94a3b8;
    }
    .media-upload-icon {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: white;
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        margin: 0 auto 16px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    }
    .media-text {
        font-size: 13px;
        color: var(--text-sub);
        margin-bottom: 12px;
        line-height: 1.5;
    }
    .btn-browse {
        background: white;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        padding: 6px 16px;
        font-size: 12px;
        font-weight: 600;
        color: var(--text-main);
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-browse:hover {
        background: #f8fafc;
        border-color: #94a3b8;
    }

    /* Switch */
    .switch-container {
        display: flex;
        align-items: center;
    }
    .switch {
        position: relative;
        display: inline-block;
        width: 44px;
        height: 24px;
        margin: 0;
    }
    .switch input { opacity: 0; width: 0; height: 0; }
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0; left: 0; right: 0; bottom: 0;
        background-color: #cbd5e1;
        transition: .3s;
        border-radius: 24px;
    }
    .slider:before {
        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        transition: .3s;
        border-radius: 50%;
        box-shadow: 0 1px 2px rgba(0,0,0,0.1);
    }
    input:checked + .slider { background-color: #10b981; }
    input:checked + .slider:before { transform: translateX(20px); }
    .switch-label {
        margin-left: 12px;
        font-size: 14px;
        font-weight: 500;
        color: var(--text-main);
    }

    /* Dynamic Rows */
    .repeater-row {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
        background: #f8fafc;
        padding: 12px;
        border-radius: 8px;
        border: 1px solid #f1f5f9;
    }
    .drag-handle {
        cursor: grab;
        color: #94a3b8;
        padding: 0 8px;
    }
    .drag-handle:active {
        cursor: grabbing;
    }
    .btn-remove-row {
        background: #fee2e2;
        color: #ef4444;
        border: none;
        border-radius: 6px;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-remove-row:hover {
        background: #fca5a5;
    }
    .btn-add-row {
        background: var(--primary-light);
        color: var(--primary);
        border: none;
        border-radius: 6px;
        padding: 8px 16px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .btn-add-row:hover {
        background: #bae6fd;
    }
</style>

<form id="productForm" action="{{ isset($product) ? route('admin.products.update', $product->id) : route('admin.products.store') }}" method="POST">
    @csrf
    @if(isset($product)) @method('PUT') @endif
    
    <div class="top-bar-card mt-4">
        <div>
            <div class="breadcrumb-wrap">
                <a href="{{ route('admin.products.index') }}" class="back-btn-icon"><i class="fa-solid fa-arrow-left"></i></a>
                <a href="{{ route('admin.products.index') }}">Products</a>
                <span class="separator"><i class="fa-solid fa-chevron-right"></i></span>
                <span class="current">{{ isset($product) ? 'Edit Product' : 'New Product' }}</span>
            </div>
            <h2 class="page-title-text">{{ isset($product) ? 'Edit Product' : 'Create Product' }}</h2>
            <p class="page-subtitle">{{ isset($product) ? 'Update the details for ' . $product->name : 'Add a new product to your catalog.' }}</p>
        </div>
        <div class="d-flex gap-3">
            <a href="{{ route('admin.products.index') }}" class="btn-cancel text-decoration-none">Cancel</a>
            <button type="submit" class="btn-save">
                <i class="fa-solid fa-floppy-disk me-2"></i> {{ isset($product) ? 'Save Changes' : 'Save Product' }}
            </button>
        </div>
    </div>

    <div class="row">
        <!-- Left Column -->
        <div class="col-lg-7 col-xl-8">
            <!-- General Info -->
            <div class="custom-card">
                <div class="card-header-custom">
                    <div class="card-header-icon"><i class="fa-solid fa-cube"></i></div>
                    <div class="card-header-text">
                        <h5>General Information</h5>
                        <p>Basic details about this product.</p>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Product Name <span class="text-danger">*</span></label>
                        <div class="custom-input-group">
                            <div class="input-icon-box"><i class="fa-solid fa-font"></i></div>
                            <input type="text" name="name" id="product_name" class="form-control" placeholder="Enter product name" value="{{ old('name', $product->name ?? '') }}" required>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <label class="form-label">URL Slug <span class="text-danger">*</span></label>
                        <div class="custom-input-group">
                            <div class="input-icon-box"><i class="fa-solid fa-link"></i></div>
                            <input type="text" name="slug" id="product_slug" class="form-control" placeholder="product-url-slug" value="{{ old('slug', $product->slug ?? '') }}" required>
                        </div>
                        <span class="helper-text">Auto-generated from name. Must be unique.</span>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Short Description</label>
                    <textarea name="short_description" class="form-control standalone" rows="3" placeholder="Brief summary of the product...">{{ old('short_description', $product->short_description ?? '') }}</textarea>
                </div>

                <div class="mb-0">
                    <label class="form-label">Full Description</label>
                    <x-admin.editor name="description" :value="$product->description ?? ''" id="productDescriptionEditor" placeholder="Detailed product description..." />
                </div>
            </div>
            
            <!-- Features -->
            <div class="custom-card">
                <div class="card-header-custom">
                    <div class="card-header-icon"><i class="fa-solid fa-list-check"></i></div>
                    <div class="card-header-text">
                        <h5>Key Features <span class="text-danger">*</span></h5>
                        <p>Add the main features of this product (minimum 1 required).</p>
                    </div>
                </div>
                
                <div id="featuresList" class="sortable-list">
                    @php $features = old('features', isset($product) ? $product->features : [['feature_text' => '']]); @endphp
                    @foreach($features as $index => $feature)
                        <div class="repeater-row">
                            <i class="fa-solid fa-grip-vertical drag-handle"></i>
                            <input type="text" name="features[{{ $index }}][feature_text]" class="form-control standalone w-100" placeholder="Enter feature..." value="{{ is_array($feature) ? $feature['feature_text'] : $feature->feature_text }}" required>
                            <button type="button" class="btn-remove-row"><i class="fa-solid fa-xmark"></i></button>
                        </div>
                    @endforeach
                </div>
                <button type="button" class="btn-add-row mt-2" onclick="addRepeaterRow('featuresList', 'features', 'feature_text', 'Enter feature...')">
                    <i class="fa-solid fa-plus"></i> Add Feature
                </button>
            </div>

            <!-- Applications -->
            <div class="custom-card">
                <div class="card-header-custom">
                    <div class="card-header-icon"><i class="fa-solid fa-layer-group"></i></div>
                    <div class="card-header-text">
                        <h5>Applications <span class="text-danger">*</span></h5>
                        <p>Where is this product applied? (minimum 1 required).</p>
                    </div>
                </div>
                
                <div id="applicationsList" class="sortable-list">
                    @php $applications = old('applications', isset($product) ? $product->applications : [['application_text' => '']]); @endphp
                    @foreach($applications as $index => $app)
                        <div class="repeater-row">
                            <i class="fa-solid fa-grip-vertical drag-handle"></i>
                            <input type="text" name="applications[{{ $index }}][application_text]" class="form-control standalone w-100" placeholder="Enter application..." value="{{ is_array($app) ? $app['application_text'] : $app->application_text }}" required>
                            <button type="button" class="btn-remove-row"><i class="fa-solid fa-xmark"></i></button>
                        </div>
                    @endforeach
                </div>
                <button type="button" class="btn-add-row mt-2" onclick="addRepeaterRow('applicationsList', 'applications', 'application_text', 'Enter application...')">
                    <i class="fa-solid fa-plus"></i> Add Application
                </button>
            </div>

            <!-- Specifications -->
            <div class="custom-card">
                <div class="card-header-custom">
                    <div class="card-header-icon"><i class="fa-solid fa-sliders"></i></div>
                    <div class="card-header-text">
                        <h5>Technical Specifications <span class="text-danger">*</span></h5>
                        <p>Key-value pairs for technical specs.</p>
                    </div>
                </div>
                
                <div id="specificationsList" class="sortable-list">
                    @php $specifications = old('specifications', isset($product) ? $product->specifications : [['spec_label' => '', 'spec_value' => '']]); @endphp
                    @foreach($specifications as $index => $spec)
                        <div class="repeater-row">
                            <i class="fa-solid fa-grip-vertical drag-handle"></i>
                            <input type="text" name="specifications[{{ $index }}][spec_label]" class="form-control standalone w-50" placeholder="Label (e.g., Weight)" value="{{ is_array($spec) ? $spec['spec_label'] : $spec->spec_label }}" required>
                            <input type="text" name="specifications[{{ $index }}][spec_value]" class="form-control standalone w-50" placeholder="Value (e.g., 5kg)" value="{{ is_array($spec) ? $spec['spec_value'] : $spec->spec_value }}">
                            <button type="button" class="btn-remove-row"><i class="fa-solid fa-xmark"></i></button>
                        </div>
                    @endforeach
                </div>
                <button type="button" class="btn-add-row mt-2" onclick="addSpecRow()">
                    <i class="fa-solid fa-plus"></i> Add Specification
                </button>
            </div>
            
            <!-- SEO -->
            <div class="custom-card">
                <div class="card-header-custom">
                    <div class="card-header-icon"><i class="fa-solid fa-magnifying-glass"></i></div>
                    <div class="card-header-text">
                        <h5>SEO Settings</h5>
                        <p>Search engine optimization fields.</p>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="form-label">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control standalone" placeholder="Enter meta title" value="{{ old('meta_title', $product->meta_title ?? '') }}">
                </div>
                <div class="mb-0">
                    <label class="form-label">Meta Description</label>
                    <textarea name="meta_description" class="form-control standalone" rows="3" placeholder="Enter meta description">{{ old('meta_description', $product->meta_description ?? '') }}</textarea>
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
                        <h5>Media</h5>
                        <p>Banner and card images.</p>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="form-label">Banner Image <span class="text-danger">*</span></label>
                    <div class="media-drop-area" onclick="document.getElementById('bannerImageInput').click();">

                        
                        <div style="position: relative; z-index: 1;">
                            <div class="media-upload-icon"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                            <p class="media-text">Click to upload from computer<br>or</p>
                            <button type="button" class="btn-browse" onclick="event.stopPropagation(); openMediaModal('banner_image', 'bannerPreview')">Browse Library</button>
                        </div>  
                        
                        <div id="bannerUploadingIndicator" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255,255,255,0.9); z-index: 3; display: none; align-items: center; justify-content: center; flex-direction: column;">
                            <div class="spinner-border text-primary mb-2" role="status"></div>
                            <span style="font-size: 13px; font-weight: 600; color: var(--primary);">Uploading...</span>
                        </div>
                    </div>
                    
                    <input type="file" id="bannerImageInput" class="d-none" accept="image/*" onchange="uploadToMediaLibrary(this, 'banner_image', 'bannerPreview', 'bannerUploadingIndicator')">
                    <input type="hidden" name="banner_image" id="banner_image" value="{{ old('banner_image', $product->banner_image ?? '') }}" required>
                    
                    <div class="mt-3 text-center">
                        @if(isset($product) && $product->bannerMedia)
                            <img id="bannerPreview" src="{{ asset('storage/' . $product->bannerMedia->file_path) }}" style="max-width: 100%; max-height: 200px; border-radius: 8px; border: 1px solid #e2e8f0; object-fit: contain;">
                        @else
                            <img id="bannerPreview" src="" style="max-width: 100%; max-height: 200px; border-radius: 8px; border: 1px solid #e2e8f0; object-fit: contain; display: none;">
                        @endif
                    </div>
                </div>
                
                <div class="mb-0">
                    <label class="form-label">Card Image</label>
                    <div class="media-drop-area" onclick="document.getElementById('cardImageInput').click();">

                        
                        <div style="position: relative; z-index: 1;">
                            <div class="media-upload-icon"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                            <p class="media-text">Click to upload from computer<br>or</p>
                            <button type="button" class="btn-browse" onclick="event.stopPropagation(); openMediaModal('card_image', 'cardPreview')">Browse Library</button>
                        </div>  
                        
                        <div id="cardUploadingIndicator" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255,255,255,0.9); z-index: 3; display: none; align-items: center; justify-content: center; flex-direction: column;">
                            <div class="spinner-border text-primary mb-2" role="status"></div>
                            <span style="font-size: 13px; font-weight: 600; color: var(--primary);">Uploading...</span>
                        </div>
                    </div>
                    
                    <input type="file" id="cardImageInput" class="d-none" accept="image/*" onchange="uploadToMediaLibrary(this, 'card_image', 'cardPreview', 'cardUploadingIndicator')">
                    <input type="hidden" name="card_image" id="card_image" value="{{ old('card_image', $product->card_image ?? '') }}">
                    
                    <div class="mt-3 text-center">
                        @if(isset($product) && $product->cardMedia)
                            <img id="cardPreview" src="{{ asset('storage/' . $product->cardMedia->file_path) }}" style="max-width: 100%; max-height: 200px; border-radius: 8px; border: 1px solid #e2e8f0; object-fit: contain;">
                        @else
                            <img id="cardPreview" src="" style="max-width: 100%; max-height: 200px; border-radius: 8px; border: 1px solid #e2e8f0; object-fit: contain; display: none;">
                        @endif
                    </div>
                </div>
            </div>

            <!-- Settings -->
            <div class="custom-card">
                <div class="card-header-custom">
                    <div class="card-header-icon"><i class="fa-solid fa-gear"></i></div>
                    <div class="card-header-text">
                        <h5>Settings</h5>
                        <p>Additional configuration.</p>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="form-label">Status</label>
                    <div class="switch-container">
                        <label class="switch">
                            <input type="checkbox" name="status" id="status" value="1" {{ old('status', $product->status ?? true) ? 'checked' : '' }}>
                            <span class="slider"></span>
                        </label>
                        <span class="switch-label">Active (Visible)</span>
                    </div>
                </div>

                <div class="mb-0">
                    <label class="form-label">Sort Order</label>
                    <div class="custom-input-group">
                        <div class="input-icon-box"><i class="fa-solid fa-arrow-down-up-across-line"></i></div>
                        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $product->sort_order ?? 0) }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@include('admin.partials.media-modal')
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
    // Slug Generation
    $('#product_name').on('keyup', function() {
        if(!$('#product_slug').attr('data-touched')) {
            var slug = $(this).val().toLowerCase().replace(/[^\w ]+/g,'').replace(/ +/g,'-');
            $('#product_slug').val(slug);
        }
    });
    $('#product_slug').on('input', function() { $(this).attr('data-touched', 'true'); });


    function uploadToMediaLibrary(input, inputId, previewId, indicatorId) {
        if (!input.files || !input.files[0]) return;
        
        let formData = new FormData();
        formData.append('files[]', input.files[0]);
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('folder_name', 'Products');
        
        document.getElementById(indicatorId).style.display = 'flex';
        
        fetch('{{ route('admin.media.store') }}', {
            method: 'POST',
            body: formData,
            headers: { 'Accept': 'application/json' }
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById(indicatorId).style.display = 'none';
            if (data.success && data.files && data.files.length > 0) {
                let uploadedMedia = data.files[0];
                document.getElementById(inputId).value = uploadedMedia.id;
                let previewImg = document.getElementById(previewId);
                previewImg.src = '{{ asset('storage') }}/' + uploadedMedia.file_path;
                previewImg.style.display = 'block';
            } else {
                alert('Upload failed: ' + (data.message || 'Unknown error'));
            }
        })
        .catch(error => {
            document.getElementById(indicatorId).style.display = 'none';
            alert('Upload failed.');
        });
        
        input.value = '';
    }

    // Dynamic Rows Logic
    function getNextIndex(listId) {
        return document.querySelectorAll('#' + listId + ' .repeater-row').length;
    }

    function addRepeaterRow(listId, name, field, placeholder) {
        let index = getNextIndex(listId);
        let html = `
            <div class="repeater-row">
                <i class="fa-solid fa-grip-vertical drag-handle"></i>
                <input type="text" name="${name}[${index}][${field}]" class="form-control standalone w-100" placeholder="${placeholder}" required>
                <button type="button" class="btn-remove-row"><i class="fa-solid fa-xmark"></i></button>
            </div>
        `;
        $('#' + listId).append(html);
    }

    function addSpecRow() {
        let index = getNextIndex('specificationsList');
        let html = `
            <div class="repeater-row">
                <i class="fa-solid fa-grip-vertical drag-handle"></i>
                <input type="text" name="specifications[${index}][spec_label]" class="form-control standalone w-50" placeholder="Label (e.g., Weight)" required>
                <input type="text" name="specifications[${index}][spec_value]" class="form-control standalone w-50" placeholder="Value (e.g., 5kg)">
                <button type="button" class="btn-remove-row"><i class="fa-solid fa-xmark"></i></button>
            </div>
        `;
        $('#specificationsList').append(html);
    }

    $(document).on('click', '.btn-remove-row', function() {
        $(this).closest('.repeater-row').remove();
    });

    // Initialize Sortable for drag and drop reordering
    document.querySelectorAll('.sortable-list').forEach(function(el) {
        new Sortable(el, {
            handle: '.drag-handle',
            animation: 150
        });
    });
</script>
@endsection
