<!-- Media Library Modal -->
<div class="modal fade" id="mediaSelectModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 10px 40px rgba(0,0,0,0.1); background-color: #eef2f6;">
            <div class="modal-header border-bottom-0 p-4 pb-0">
                <h5 class="modal-title font-weight-bold" style="color: #1e293b; font-size: 16px; font-family: 'Inter', sans-serif;">
                    <i class="fa-regular fa-image me-2" style="color: #4f46e5;"></i> Select Media
                </h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close" style="opacity: 0.5;"></button>
            </div>
            
            <div class="modal-body p-4 pt-3" style="background-color: #f8fafc;">
                <!-- Media Search -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="input-group shadow-sm" style="background: white; border-radius: 8px; overflow: hidden; padding: 4px 8px; border: 1px solid #e2e8f0;">
                            <span class="input-group-text bg-white border-0 ps-2"><i class="fa-solid fa-magnifying-glass text-muted" style="font-size: 14px;"></i></span>
                            <input type="text" class="form-control border-0 shadow-none" id="mediaSearchInput" placeholder="Search files..." onkeyup="filterMediaModal()" style="font-size: 14px;">
                        </div>
                    </div>
                </div>

                <div class="row g-4" id="mediaGridContainer">
                    @php
                        $mediaFiles = \App\Models\MediaFile::latest()->get();
                    @endphp
                    
                    @forelse($mediaFiles as $file)
                        <div class="col-xl-3 col-lg-3 col-md-6 col-12 media-item" data-title="{{ strtolower($file->original_name) }}">
                            <div class="card h-100 border-0 overflow-hidden position-relative media-selectable skeleton-target" 
                                 onclick="handleMediaSelection('{{ $file->id }}', '{{ asset('storage/' . $file->file_path) }}')">
                                 
                                <div style="height: 160px; background: #f1f5f9; display: flex; align-items: center; justify-content: center; overflow: hidden; border-bottom: 1px solid #f1f5f9;">
                                    @if(Str::startsWith($file->mime_type, 'image/'))
                                        <img src="{{ asset('storage/' . $file->file_path) }}" alt="{{ $file->original_name }}" loading="lazy" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;">
                                    @else
                                        <i class="fa-solid fa-file-pdf fs-1 text-muted"></i>
                                    @endif
                                </div>
                                <div class="p-3 bg-white">
                                    <p class="text-truncate mb-1" style="font-size: 14px; font-weight: 600; color: #1e2340;" title="{{ $file->original_name }}">{{ $file->original_name }}</p>
                                    <small class="text-muted fw-medium" style="font-size: 11px; letter-spacing: 0.05em;">{{ strtoupper(pathinfo($file->file_path, PATHINFO_EXTENSION)) }}</small>
                                </div>
                                
                                <!-- Hover Overlay -->
                                <div class="position-absolute w-100 h-100 top-0 start-0 d-flex align-items-center justify-content-center opacity-0 hover-overlay" style="transition: all 0.2s;">
                                    <div class="bg-white rounded-circle shadow d-flex align-items-center justify-content-center hover-icon-circle" style="width: 44px; height: 44px;">
                                        <i class="fa-solid fa-check fs-5"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <div class="d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 90px; height: 90px; background: rgba(0, 151, 160, 0.08); border-radius: 24px; color: var(--tl-color-theme-primary);">
                                <i class="fa-regular fa-folder-open" style="font-size: 40px;"></i>
                            </div>
                            <h5 class="fw-bold" style="color: #1e2340;">No media files found</h5>
                            <p class="text-muted fs-14">Upload files from the File Manager first.</p>
                        </div>
                    @endforelse
                </div>
            </div>
            
            <div class="modal-footer border-top-0 p-4 pt-3 bg-white" style="border-radius: 0 0 12px 12px;">
                <a href="{{ route('admin.media.index') }}" target="_blank" class="btn btn-outline-primary-theme me-2" style="border-radius: 8px;">
                    <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Open File Manager
                </a>
                <button type="button" class="btn btn-primary-theme" data-bs-dismiss="modal" style="border-radius: 8px;">Cancel</button>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-outline-primary-theme {
        color: var(--tl-color-theme-primary);
        border: 1px solid var(--tl-color-theme-primary);
        background: transparent;
        padding: 10px 20px;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.2s ease;
    }
    .btn-outline-primary-theme:hover {
        background: rgba(0, 151, 160, 0.05);
        color: var(--tl-color-theme-primary);
        transform: translateY(-1px);
    }
    
    .btn-primary-theme {
        color: white;
        background: var(--tl-color-theme-primary);
        border: 1px solid var(--tl-color-theme-primary);
        padding: 10px 28px;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.2s ease;
    }
    .btn-primary-theme:hover {
        background: var(--tl-color-theme-primary);
        filter: brightness(0.9);
        border-color: var(--tl-color-theme-primary);
        color: white;
        transform: translateY(-1px);
    }

    .media-selectable {
        border-radius: 12px;
        border: 1px solid #e2e8f0 !important;
        background: #fff;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0,0,0,0.02);
    }
    .media-selectable img {
        transition: transform 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
    }
    .media-selectable:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.08) !important;
        border-color: #cbd5e1 !important;
    }
    .media-selectable:hover img {
        transform: scale(1.05);
    }
    
    /* Click/Select Active State simulation */
    .media-selectable:active {
        border-color: var(--tl-color-theme-primary) !important;
        box-shadow: 0 0 0 3px rgba(0, 151, 160, 0.2) !important;
    }

    .media-selectable:hover .hover-overlay {
        opacity: 1 !important;
        background-color: rgba(0, 0, 0, 0.4) !important;
    }
    .media-selectable .hover-icon-circle {
        color: var(--tl-color-theme-primary) !important;
        transform: translateY(10px);
        transition: all 0.2s ease;
    }
    .media-selectable:hover .hover-icon-circle {
        transform: translateY(0);
    }
</style>

<script>
    function filterMediaModal() {
        let input = document.getElementById('mediaSearchInput').value.toLowerCase();
        let items = document.getElementsByClassName('media-item');
        
        for (let i = 0; i < items.length; i++) {
            let title = items[i].getAttribute('data-title');
            if (title.indexOf(input) > -1) {
                items[i].style.display = "";
            } else {
                items[i].style.display = "none";
            }
        }
    }

    // Global Media Selection State
    let currentInputId = null;
    let currentPreviewId = null;
    let editorMediaCallback = null;

    function openMediaModal(inputId, previewId) {
        currentInputId = inputId;
        currentPreviewId = previewId;
        editorMediaCallback = null; // Clear any editor callback
        var myModal = new bootstrap.Modal(document.getElementById('mediaSelectModal'));
        myModal.show();
    }

    function openMediaModalForEditor(callback) {
        editorMediaCallback = callback;
        currentInputId = null;
        currentPreviewId = null;
        var myModal = new bootstrap.Modal(document.getElementById('mediaSelectModal'));
        myModal.show();
    }

    function handleMediaSelection(mediaId, mediaUrl) {
        // Handle Editor Callback
        if (editorMediaCallback) {
            editorMediaCallback(mediaUrl, { alt: 'Media Image' });
            editorMediaCallback = null;
        } 
        // Handle Standard Input & Preview update
        else if(currentInputId && currentPreviewId) {
            document.getElementById(currentInputId).value = mediaId;
            let previewImg = document.getElementById(currentPreviewId);
            if (previewImg) {
                previewImg.src = mediaUrl;
                previewImg.style.display = 'block';
            }
        }
        
        // Hide Modal
        var modalEl = document.getElementById('mediaSelectModal');
        var modal = bootstrap.Modal.getInstance(modalEl);
        if (modal) {
            modal.hide();
        }
    }
</script>
