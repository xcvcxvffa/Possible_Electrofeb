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
    .custom-input-group .form-control, .custom-input-group .form-select {
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
        padding: 24px 16px;
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
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #e0e7ff;
        color: var(--primary);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        margin-bottom: 8px;
    }
    .btn-browse {
        background: var(--primary);
        color: white;
        border: none;
        border-radius: 6px;
        padding: 6px 14px;
        font-size: 12.5px;
        font-weight: 500;
        margin-top: 8px;
    }
    
    .status-toggle-wrapper {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 14px;
        background: #f8fafc;
        border: 1px solid var(--border-color);
        border-radius: 12px;
        margin-bottom: 12px;
    }
    .status-title { font-weight: 600; font-size: 13.5px; color: var(--text-main); margin-bottom: 2px; }
    .status-desc { font-size: 12px; color: var(--text-sub); margin: 0; }
    
    .repeater-row {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
        background: #f8fafc;
        border: 1px solid var(--border-color);
        border-radius: 10px;
        padding: 10px 14px;
    }
    .btn-remove-row {
        width: 36px;
        height: 36px;
        border: 1px solid #fee2e2;
        background: #fff5f5;
        color: #ef4444;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .btn-add-row {
        background: var(--primary-light);
        color: var(--primary);
        border: 1px dashed var(--primary);
        border-radius: 8px;
        padding: 10px 16px;
        font-size: 13.5px;
        font-weight: 600;
        width: 100%;
        transition: all 0.2s;
    }
    .btn-add-row:hover {
        background: var(--primary);
        color: white;
    }
    .drag-handle {
        cursor: grab;
        color: #94a3b8;
    }
</style>

<form id="blogForm" action="{{ isset($blog) ? route('admin.blogs.update', $blog->id) : route('admin.blogs.store') }}" method="POST">
    @csrf
    @if(isset($blog)) @method('PUT') @endif
    
    <!-- Top Bar -->
    <div class="top-bar-card mt-2">
        <div>
            <div class="breadcrumb-wrap">
                <a href="{{ route('admin.blogs.index') }}" class="back-btn-icon">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <i class="fa-solid fa-chevron-right separator"></i>
                <a href="{{ route('admin.blogs.index') }}">Blogs</a>
                <i class="fa-solid fa-chevron-right separator"></i>
                <span class="current">{{ isset($blog) ? 'Edit Blog Post' : 'Create Blog Post' }}</span>
            </div>
            <h4 class="page-title-text">{{ isset($blog) ? 'Edit Blog Post' : 'Create Blog Post' }}</h4>
            <p class="page-subtitle">Write and manage your enterprise article or tutorial.</p>
        </div>
        <div class="d-flex gap-3 align-items-center mt-3 mt-md-0">
            <a href="{{ route('admin.blogs.index') }}" class="btn-cancel text-decoration-none">
                <i class="fa-solid fa-xmark me-2"></i> Cancel
            </a>
            <button type="submit" class="btn-save">
                <i class="fa-regular fa-floppy-disk me-2"></i> {{ isset($blog) ? 'Update Blog Post' : 'Save Blog Post' }}
            </button>
        </div>
    </div>



    <div class="row">
        <!-- Left Column -->
        <div class="col-lg-7 col-xl-8">
            <!-- General Information -->
            <div class="custom-card">
                <div class="card-header-custom">
                    <div class="card-header-icon"><i class="fa-regular fa-file-lines"></i></div>
                    <div class="card-header-text">
                        <h5>General Information</h5>
                        <p>Title, slug, category, author, and main content.</p>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="form-label">Blog Title <span class="text-danger">*</span></label>
                    <div class="custom-input-group">
                        <div class="input-icon-box"><i class="fa-solid fa-heading"></i></div>
                        <input type="text" name="title" id="blogTitle" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $blog->title ?? '') }}" required placeholder="e.g. Innovations in LT Switchgear Technology">
                    </div>
                    @error('title') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label">URL Slug <span class="text-danger">*</span></label>
                    <div class="custom-input-group">
                        <div class="input-icon-box"><i class="fa-solid fa-link"></i></div>
                        <input type="text" name="slug" id="blogSlug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', $blog->slug ?? '') }}" required placeholder="e.g. innovations-in-lt-switchgear-technology">
                    </div>
                    @error('slug') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Category</label>
                        <div class="custom-input-group">
                            <div class="input-icon-box"><i class="fa-regular fa-folder"></i></div>
                            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" style="cursor: pointer;">
                                <option value="">Select Category</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id', $blog->category_id ?? '') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label">Author</label>
                        <div class="custom-input-group">
                            <div class="input-icon-box"><i class="fa-regular fa-user"></i></div>
                            <select name="author_id" class="form-select @error('author_id') is-invalid @enderror" style="cursor: pointer;">
                                @foreach($authors as $author)
                                    <option value="{{ $author->id }}" {{ old('author_id', $blog->author_id ?? Auth::id()) == $author->id ? 'selected' : '' }}>
                                        {{ $author->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Excerpt / Summary</label>
                    <div class="custom-input-group" style="align-items: flex-start;">
                        <div class="input-icon-box" style="height: 100%; min-height: 80px; align-items: flex-start; padding-top: 14px;"><i class="fa-solid fa-quote-left"></i></div>
                        <textarea name="excerpt" class="form-control @error('excerpt') is-invalid @enderror" rows="2" placeholder="Brief summary displayed on blog cards...">{{ old('excerpt', $blog->excerpt ?? '') }}</textarea>
                    </div>
                </div>

                <div class="mb-0">
                    <label class="form-label">Main Content <span class="text-danger">*</span></label>
                    <x-admin.editor name="content" :value="$blog->content ?? ''" id="mainContentEditor" placeholder="Write full article content..." />
                    @error('content') <div class="invalid-feedback d-block mt-2">{{ $message }}</div> @enderror
                </div>
            </div>

            <!-- FAQs -->
            <div class="custom-card">
                <div class="card-header-custom">
                    <div class="card-header-icon"><i class="fa-regular fa-circle-question"></i></div>
                    <div class="card-header-text">
                        <h5>Blog FAQs</h5>
                        <p>Frequently asked questions about this article topic.</p>
                    </div>
                </div>
                
                <div id="faqsList">
                    @php 
                        $faqs = old('faqs', isset($blog) ? $blog->faqs : []);
                    @endphp
                    @foreach($faqs as $index => $faq)
                        <div class="repeater-row">
                            <i class="fa-solid fa-grip-vertical drag-handle"></i>
                            <input type="text" name="faqs[{{ $index }}][question]" class="form-control w-50" placeholder="Question..." value="{{ is_array($faq) ? $faq['question'] : $faq->question }}">
                            <input type="text" name="faqs[{{ $index }}][answer]" class="form-control w-50" placeholder="Answer..." value="{{ is_array($faq) ? $faq['answer'] : $faq->answer }}">
                            <button type="button" class="btn-remove-row"><i class="fa-solid fa-xmark"></i></button>
                        </div>
                    @endforeach
                </div>
                <button type="button" class="btn-add-row mt-2" onclick="addFaqRow()">
                    <i class="fa-solid fa-plus"></i> Add FAQ
                </button>
            </div>

            <!-- Related Blogs -->
            <div class="custom-card">
                <div class="card-header-custom">
                    <div class="card-header-icon"><i class="fa-solid fa-file-circle-plus"></i></div>
                    <div class="card-header-text">
                        <h5>Related Blogs</h5>
                        <p>Select related blog posts to feature at the bottom of the article.</p>
                    </div>
                </div>
                
                <div class="row g-2" style="max-height: 220px; overflow-y: auto;">
                    @php
                        $selectedRelated = old('related_blogs', isset($blog) ? $blog->relatedBlogs->pluck('id')->toArray() : []);
                    @endphp
                    @forelse($allBlogs as $rBlog)
                        <div class="col-md-6">
                            <label class="d-flex align-items-center p-2 border rounded" style="cursor: pointer; font-size: 13px;">
                                <input type="checkbox" name="related_blogs[]" value="{{ $rBlog->id }}" class="form-check-input me-2" {{ in_array($rBlog->id, $selectedRelated) ? 'checked' : '' }}>
                                <span class="text-truncate">{{ $rBlog->title }}</span>
                            </label>
                        </div>
                    @empty
                        <div class="text-muted" style="font-size: 13px;">No other blogs available yet.</div>
                    @endforelse
                </div>
            </div>

            <!-- SEO Settings -->
            <div class="custom-card">
                <div class="card-header-custom">
                    <div class="card-header-icon"><i class="fa-solid fa-magnifying-glass"></i></div>
                    <div class="card-header-text">
                        <h5>SEO Settings</h5>
                        <p>Optimize title and meta tags for search engines.</p>
                    </div>
                </div>

                @php
                    $seo = isset($blog) ? $blog->seo : null;
                @endphp
                
                <div class="mb-4">
                    <label class="form-label">Meta Title</label>
                    <input type="text" name="seo[meta_title]" class="form-control border rounded" placeholder="SEO Title" value="{{ old('seo.meta_title', $seo->meta_title ?? '') }}">
                </div>

                <div class="mb-4">
                    <label class="form-label">Meta Description</label>
                    <textarea name="seo[meta_description]" class="form-control border rounded" rows="3" placeholder="SEO Meta Description...">{{ old('seo.meta_description', $seo->meta_description ?? '') }}</textarea>
                </div>

                <div class="mb-0">
                    <label class="form-label">Meta Keywords</label>
                    <input type="text" name="seo[meta_keywords]" class="form-control border rounded" placeholder="keyword1, keyword2, keyword3" value="{{ old('seo.meta_keywords', $seo->meta_keywords ?? '') }}">
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="col-lg-5 col-xl-4">
            <!-- Featured Image -->
            <div class="custom-card">
                <div class="card-header-custom">
                    <div class="card-header-icon"><i class="fa-regular fa-image"></i></div>
                    <div class="card-header-text">
                        <h5>Featured Image</h5>
                        <p>Main thumbnail for blog cards.</p>
                    </div>
                </div>
                
                <div class="mb-3">
                    <div class="media-drop-area" onclick="document.getElementById('featuredImageInput').click();">

                        
                        <div style="position: relative; z-index: 1;">
                            <div class="media-upload-icon"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                            <p class="media-text">Click to upload from computer<br>or</p>
                            <button type="button" class="btn-browse" onclick="event.stopPropagation(); openMediaModal('featured_image_media_id', 'featuredPreview')">Browse Library</button>
                        </div>

                        <div id="featuredUploadingIndicator" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255,255,255,0.9); z-index: 3; display: none; align-items: center; justify-content: center; flex-direction: column;">
                            <div class="spinner-border text-primary mb-2" role="status"></div>
                            <span style="font-size: 13px; font-weight: 600; color: var(--primary);">Uploading...</span>
                        </div>
                    </div>

                    <input type="file" id="featuredImageInput" class="d-none" accept="image/*" onchange="uploadToMediaLibrary(this, 'featured_image_media_id', 'featuredPreview', 'featuredUploadingIndicator')">
                    <input type="hidden" name="featured_image_media_id" id="featured_image_media_id" value="{{ old('featured_image_media_id', $blog->featured_image_media_id ?? '') }}">
                    
                    <div class="mt-3 text-center">
                        @if(isset($blog) && $blog->featuredMedia)
                            <img id="featuredPreview" src="{{ asset('storage/' . $blog->featuredMedia->file_path) }}" style="max-width: 100%; max-height: 200px; border-radius: 8px; border: 1px solid #e2e8f0; object-fit: contain;">
                        @else
                            <img id="featuredPreview" src="" style="max-width: 100%; max-height: 200px; border-radius: 8px; border: 1px solid #e2e8f0; object-fit: contain; display: none;">
                        @endif
                    </div>
                </div>
            </div>

            <!-- Banner Image -->
            <div class="custom-card">
                <div class="card-header-custom">
                    <div class="card-header-icon"><i class="fa-solid fa-panorama"></i></div>
                    <div class="card-header-text">
                        <h5>Banner Image</h5>
                        <p>Header banner for single article view.</p>
                    </div>
                </div>
                
                <div class="mb-3">
                    <div class="media-drop-area" onclick="document.getElementById('bannerImageInput').click();">


                        <div style="position: relative; z-index: 1;">
                            <div class="media-upload-icon"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                            <p class="media-text">Click to upload from computer<br>or</p>
                            <button type="button" class="btn-browse" onclick="event.stopPropagation(); openMediaModal('banner_image_media_id', 'bannerPreview')">Browse Library</button>
                        </div>

                        <div id="bannerUploadingIndicator" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255,255,255,0.9); z-index: 3; display: none; align-items: center; justify-content: center; flex-direction: column;">
                            <div class="spinner-border text-primary mb-2" role="status"></div>
                            <span style="font-size: 13px; font-weight: 600; color: var(--primary);">Uploading...</span>
                        </div>
                    </div>

                    <input type="file" id="bannerImageInput" class="d-none" accept="image/*" onchange="uploadToMediaLibrary(this, 'banner_image_media_id', 'bannerPreview', 'bannerUploadingIndicator')">
                    <input type="hidden" name="banner_image_media_id" id="banner_image_media_id" value="{{ old('banner_image_media_id', $blog->banner_image_media_id ?? '') }}">
                    
                    <div class="mt-3 text-center">
                        @if(isset($blog) && $blog->bannerMedia)
                            <img id="bannerPreview" src="{{ asset('storage/' . $blog->bannerMedia->file_path) }}" style="max-width: 100%; max-height: 200px; border-radius: 8px; border: 1px solid #e2e8f0; object-fit: contain;">
                        @else
                            <img id="bannerPreview" src="" style="max-width: 100%; max-height: 200px; border-radius: 8px; border: 1px solid #e2e8f0; object-fit: contain; display: none;">
                        @endif
                    </div>
                </div>
            </div>



            <!-- Publish & Flags -->
            <div class="custom-card">
                <div class="card-header-custom">
                    <div class="card-header-icon"><i class="fa-solid fa-sliders"></i></div>
                    <div class="card-header-text">
                        <h5>Publishing & Status</h5>
                        <p>Control visibility and ordering.</p>
                    </div>
                </div>
                
                <div class="status-toggle-wrapper">
                    <div>
                        <div class="status-title">Published Status</div>
                        <p class="status-desc">Active articles are visible to visitors.</p>
                    </div>
                    <div class="form-check form-switch m-0">
                        <input type="hidden" name="status" value="0">
                        <input class="form-check-input" type="checkbox" name="status" value="1" style="width: 44px; height: 22px; cursor: pointer;" {{ old('status', $blog->status ?? true) ? 'checked' : '' }}>
                    </div>
                </div>

                <div class="status-toggle-wrapper">
                    <div>
                        <div class="status-title">Featured Blog</div>
                        <p class="status-desc">Highlight in featured sections.</p>
                    </div>
                    <div class="form-check form-switch m-0">
                        <input type="hidden" name="featured" value="0">
                        <input class="form-check-input" type="checkbox" name="featured" value="1" style="width: 44px; height: 22px; cursor: pointer;" {{ old('featured', $blog->featured ?? false) ? 'checked' : '' }}>
                    </div>
                </div>

                <div class="status-toggle-wrapper">
                    <div>
                        <div class="status-title">Trending Blog</div>
                        <p class="status-desc">Mark as trending.</p>
                    </div>
                    <div class="form-check form-switch m-0">
                        <input type="hidden" name="trending" value="0">
                        <input class="form-check-input" type="checkbox" name="trending" value="1" style="width: 44px; height: 22px; cursor: pointer;" {{ old('trending', $blog->trending ?? false) ? 'checked' : '' }}>
                    </div>
                </div>

                <div class="status-toggle-wrapper mb-3">
                    <div>
                        <div class="status-title">Allow Comments</div>
                        <p class="status-desc">Enable comments on this post.</p>
                    </div>
                    <div class="form-check form-switch m-0">
                        <input type="hidden" name="allow_comments" value="0">
                        <input class="form-check-input" type="checkbox" name="allow_comments" value="1" style="width: 44px; height: 22px; cursor: pointer;" {{ old('allow_comments', $blog->allow_comments ?? true) ? 'checked' : '' }}>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control border rounded" value="{{ old('sort_order', $blog->sort_order ?? 0) }}">
                </div>

                <div class="mb-0">
                    <label class="form-label">Publish Date</label>
                    <input type="datetime-local" name="published_at" class="form-control border rounded" value="{{ old('published_at', isset($blog) && $blog->published_at ? $blog->published_at->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}">
                </div>
            </div>
        </div>
    </div>
</form>

@include('admin.partials.media-modal')
@endsection

@section('scripts')
<script>
    @if(!isset($blog))
    document.getElementById('blogTitle').addEventListener('keyup', function() {
        let slug = this.value.toLowerCase()
            .replace(/[^\w\s-]/g, '')
            .replace(/[\s_-]+/g, '-')
            .replace(/^-+|-+$/g, '');
        document.getElementById('blogSlug').value = slug;
    });
    @endif


    let faqIndex = {{ isset($faqs) ? count($faqs) : 0 }};
    function addFaqRow() {
        let html = `
            <div class="repeater-row">
                <i class="fa-solid fa-grip-vertical drag-handle"></i>
                <input type="text" name="faqs[${faqIndex}][question]" class="form-control w-50" placeholder="Question...">
                <input type="text" name="faqs[${faqIndex}][answer]" class="form-control w-50" placeholder="Answer...">
                <button type="button" class="btn-remove-row"><i class="fa-solid fa-xmark"></i></button>
            </div>
        `;
        document.getElementById('faqsList').insertAdjacentHTML('beforeend', html);
        faqIndex++;
    }

    $(document).on('click', '.btn-remove-row', function() {
        $(this).closest('.repeater-row').remove();
    });

    // The TinyMCE editor is now loaded via the x-admin.editor component.

    // Upload from computer → uploads to media library, sets hidden id, shows preview
    function uploadToMediaLibrary(input, inputId, previewId, indicatorId) {
        if (!input.files || !input.files[0]) return;

        let formData = new FormData();
        formData.append('files[]', input.files[0]);
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('folder_name', 'Blogs');

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
</script>
@endsection
