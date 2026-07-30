@extends('admin.layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box mt-4 mb-4 d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0" style="font-size: 22px; font-weight: 600; color: var(--ins-heading-color);">Website Settings</h4>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 8px;">
                <i class="ti ti-check me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 8px;">
                <i class="ti ti-alert-triangle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Hidden form for deleting files securely via POST -->
        <form id="delete-file-form" action="{{ route('admin.settings.website.delete_file') }}" method="POST" style="display: none;">
            @csrf
            <input type="hidden" name="field" id="delete-file-field" value="">
        </form>

        <script>
            function deleteFile(field) {
                if(confirm('Are you sure you want to delete this file? This action cannot be undone.')) {
                    document.getElementById('delete-file-field').value = field;
                    document.getElementById('delete-file-form').submit();
                }
            }
        </script>

        @php
            // Reusable macro-like block for file upload UI
            $renderFileUI = function($title, $field, $isDark = false, $maxSize = '2MB', $recSize = '200x50px', $isPdf = false) use ($setting) {
                $hasFile = $setting?->$field ? true : false;
                $icon = $isPdf ? 'ti-file-text' : 'ti-photo';
                $boxClass = $isDark ? 'bg-dark' : 'bg-light';
                $iconClass = $hasFile && $isPdf ? 'text-danger' : 'text-muted';
                
                $html = '
                <div class="row align-items-center mb-3">
                    <div class="col-lg-3">
                        <label class="form-label fw-semibold text-dark mb-lg-0" for="'.$field.'">'.$title.'</label>
                    </div>
                    <div class="col-lg-9">
                        <div class="d-flex align-items-center gap-3">
                            <div class="'.$boxClass.' border rounded p-1 d-flex align-items-center justify-content-center shadow-sm" style="width: 70px; height: 70px; flex-shrink: 0;">';
                            
                if ($hasFile && !$isPdf) {
                    $html .= '<img src="'.asset('storage/'.$setting?->$field).'" alt="Preview" style="max-width: 100%; max-height: 100%; border-radius: 4px;">';
                } else if ($hasFile && $isPdf) {
                    $html .= '<i class="ti '.$icon.' fs-2 '.$iconClass.'"></i>';
                } else {
                    $html .= '<i class="ti '.$icon.' fs-2 text-muted"></i>';
                }

                $html .= '  </div>
                            <div class="flex-grow-1">
                                <div class="d-flex flex-wrap align-items-center gap-2">
                                    <div class="position-relative" style="max-width: 350px; flex-grow: 1;">
                                        <input type="file" class="form-control" id="'.$field.'" name="'.$field.'" accept="'.($isPdf ? 'application/pdf' : 'image/*').'">
                                    </div>';
                                    
                if ($hasFile) {
                    if ($isPdf) {
                        $html .= '<a href="'.asset('storage/'.$setting?->$field).'" target="_blank" class="btn btn-soft-info px-3"><i class="ti ti-eye"></i></a>';
                    }
                    $html .= '<button type="button" class="btn btn-soft-danger px-3" onclick="deleteFile(\''.$field.'\')"><i class="ti ti-trash"></i></button>';
                }

                $html .= '      </div>
                                <div class="d-flex align-items-center gap-3 mt-2 text-muted" style="font-size: 12px;">
                                    '.($recSize ? '<span><i class="ti ti-ruler-2 me-1"></i>'.$recSize.'</span>' : '').'
                                    <span><i class="ti ti-database me-1"></i>Max: '.$maxSize.'</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
                return $html;
            };
        @endphp

        <style>
            .settings-tabs .nav-link {
                color: #64748b;
                padding: 15px 20px;
                border-radius: 0;
                border-left: 3px solid transparent;
                transition: all 0.2s ease;
                font-size: 15px;
            }
            .settings-tabs .nav-link:hover {
                background-color: #f8fafc;
                color: var(--tl-color-theme-primary);
            }
            .settings-tabs .nav-link.active {
                background-color: #f8fafc;
                color: var(--tl-color-theme-primary);
                border-left-color: var(--tl-color-theme-primary);
                font-weight: 600;
            }
            .settings-card {
                border: none;
                box-shadow: 0 4px 20px rgba(0,0,0,0.03);
                border-radius: 12px;
                overflow: hidden;
            }
            .settings-card .card-header {
                background-color: #ffffff;
                border-bottom: 1px solid #f1f5f9;
                padding: 20px 24px;
            }
            .settings-card .card-body {
                padding: 24px;
            }
            .form-control:focus {
                border-color: var(--tl-color-theme-primary);
                box-shadow: 0 0 0 0.25rem rgba(0, 151, 160, 0.1);
            }
        </style>

        <div class="row">
            <!-- Sidebar Tabs -->
            <div class="col-xl-3 col-lg-4 mb-4">
                <div class="card settings-card">
                    <div class="card-body p-0">
                        <div class="nav flex-column nav-pills settings-tabs" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active border-bottom" id="v-pills-company-tab" data-bs-toggle="pill" href="#v-pills-company" role="tab" aria-controls="v-pills-company" aria-selected="true">
                                <i class="ti ti-building-skyscraper me-2 fs-18 align-middle"></i> Company Info
                            </a>
                            <a class="nav-link border-bottom" id="v-pills-branding-tab" data-bs-toggle="pill" href="#v-pills-branding" role="tab" aria-controls="v-pills-branding" aria-selected="false">
                                <i class="ti ti-color-swatch me-2 fs-18 align-middle"></i> Website Branding
                            </a>
                            <a class="nav-link border-bottom" id="v-pills-contact-tab" data-bs-toggle="pill" href="#v-pills-contact" role="tab" aria-controls="v-pills-contact" aria-selected="false">
                                <i class="ti ti-map-pin me-2 fs-18 align-middle"></i> Contact Info
                            </a>
                            <a class="nav-link border-bottom" id="v-pills-social-tab" data-bs-toggle="pill" href="#v-pills-social" role="tab" aria-controls="v-pills-social" aria-selected="false">
                                <i class="ti ti-brand-facebook me-2 fs-18 align-middle"></i> Social Media
                            </a>
                            <a class="nav-link border-bottom" id="v-pills-seo-tab" data-bs-toggle="pill" href="#v-pills-seo" role="tab" aria-controls="v-pills-seo" aria-selected="false">
                                <i class="ti ti-search me-2 fs-18 align-middle"></i> SEO Defaults
                            </a>
                            <a class="nav-link" id="v-pills-stats-tab" data-bs-toggle="pill" href="#v-pills-stats" role="tab" aria-controls="v-pills-stats" aria-selected="false">
                                <i class="ti ti-chart-bar me-2 fs-18 align-middle"></i> Statistics
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab Content -->
            <div class="col-xl-9 col-lg-8">
                <div class="tab-content" id="v-pills-tabContent">
                    
                    <!-- 1. Company Information -->
                    <div class="tab-pane fade show active" id="v-pills-company" role="tabpanel" aria-labelledby="v-pills-company-tab">
                        <div class="card settings-card">
                            <div class="card-header">
                                <h5 class="card-title mb-0" style="color: var(--ins-heading-color);">Company Information</h5>
                                <p class="text-muted small mb-0 mt-1">Manage your company's primary identity details.</p>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.settings.website.company_info') }}" method="POST">
                                    @csrf
                                    
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold" for="company_name">Company Name</label>
                                        <input type="text" class="form-control @error('company_name') is-invalid @enderror" id="company_name" name="company_name" value="{{ old('company_name', $setting?->company_name) }}" placeholder="Enter company name">
                                        @error('company_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold" for="company_tagline">Company Tagline</label>
                                        <input type="text" class="form-control @error('company_tagline') is-invalid @enderror" id="company_tagline" name="company_tagline" value="{{ old('company_tagline', $setting?->company_tagline) }}" placeholder="e.g. Empowering the future">
                                        @error('company_tagline')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold" for="company_email">Company Email</label>
                                            <input type="email" class="form-control @error('company_email') is-invalid @enderror" id="company_email" name="company_email" value="{{ old('company_email', $setting?->company_email) }}" placeholder="Enter company email">
                                            @error('company_email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold" for="company_phone">Company Phone</label>
                                            <input type="text" class="form-control @error('company_phone') is-invalid @enderror" id="company_phone" name="company_phone" value="{{ old('company_phone', $setting?->company_phone) }}" placeholder="Enter company phone">
                                            @error('company_phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold" for="company_address">Company Address</label>
                                        <textarea class="form-control @error('company_address') is-invalid @enderror" id="company_address" name="company_address" rows="3" placeholder="Enter full address">{{ old('company_address', $setting?->company_address) }}</textarea>
                                        @error('company_address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label fw-semibold" for="google_map_url">Google Map Embed URL</label>
                                        <textarea class="form-control @error('google_map_url') is-invalid @enderror" id="google_map_url" name="google_map_url" rows="3" placeholder="<iframe src='...'></iframe>">{{ old('google_map_url', $setting?->google_map_url) }}</textarea>
                                        @error('google_map_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="text-end">
                                        <button type="submit" class="btn px-4" style="background-color: var(--tl-color-theme-primary); color: white; border: none; border-radius: 6px;"><i class="ti ti-device-floppy me-1"></i> Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Website Branding -->
                    <div class="tab-pane fade" id="v-pills-branding" role="tabpanel" aria-labelledby="v-pills-branding-tab">
                        <div class="card settings-card">
                            <div class="card-header">
                                <h5 class="card-title mb-0" style="color: var(--ins-heading-color);">Website Branding</h5>
                                <p class="text-muted small mb-0 mt-1">Upload your logos and digital assets.</p>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.settings.website.branding') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    
                                    {!! $renderFileUI('Main Logo', 'logo', false, '2MB', '200x50px') !!}
                                    <hr class="border-dashed my-4">
                                    
                                    {!! $renderFileUI('Dark Logo', 'dark_logo', true, '2MB', '200x50px') !!}
                                    <hr class="border-dashed my-4">

                                    {!! $renderFileUI('Footer Logo', 'footer_logo', true, '2MB', '200x50px') !!}
                                    <hr class="border-dashed my-4">

                                    {!! $renderFileUI('Favicon', 'favicon', false, '512KB', 'Square 64x64px') !!}
                                    <hr class="border-dashed my-4">

                                    {!! $renderFileUI('Apple Touch Icon', 'apple_touch_icon', false, '512KB', 'Square 180x180px') !!}
                                    <hr class="border-dashed my-4">
                                    
                                    {!! $renderFileUI('Company Profile PDF', 'company_profile_pdf', false, '10MB', '', true) !!}

                                    <div class="text-end mt-4">
                                        <button type="submit" class="btn px-4" style="background-color: var(--tl-color-theme-primary); color: white; border: none; border-radius: 6px;"><i class="ti ti-device-floppy me-1"></i> Save Assets</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Contact Information -->
                    <div class="tab-pane fade" id="v-pills-contact" role="tabpanel" aria-labelledby="v-pills-contact-tab">
                        <div class="card settings-card">
                            <div class="card-header">
                                <h5 class="card-title mb-0" style="color: var(--ins-heading-color);">Contact Information</h5>
                                <p class="text-muted small mb-0 mt-1">Publicly displayed contact details for your visitors.</p>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.settings.website.contact_info') }}" method="POST">
                                    @csrf
                                    
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold" for="office_address">Office Address</label>
                                        <textarea class="form-control @error('office_address') is-invalid @enderror" id="office_address" name="office_address" rows="3" placeholder="Enter physical office address...">{{ old('office_address', $setting?->office_address) }}</textarea>
                                        @error('office_address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold" for="office_email">Office Email</label>
                                            <input type="email" class="form-control @error('office_email') is-invalid @enderror" id="office_email" name="office_email" value="{{ old('office_email', $setting?->office_email) }}" placeholder="e.g. contact@company.com">
                                            @error('office_email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold" for="office_phone">Office Phone</label>
                                            <input type="text" class="form-control @error('office_phone') is-invalid @enderror" id="office_phone" name="office_phone" value="{{ old('office_phone', $setting?->office_phone) }}" placeholder="e.g. +1 234 567 8900">
                                            @error('office_phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label fw-semibold" for="working_hours">Working Hours</label>
                                        <input type="text" class="form-control @error('working_hours') is-invalid @enderror" id="working_hours" name="working_hours" value="{{ old('working_hours', $setting?->working_hours) }}" placeholder="e.g. Mon - Fri, 9:00 AM - 6:00 PM">
                                        @error('working_hours')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="text-end">
                                        <button type="submit" class="btn px-4" style="background-color: var(--tl-color-theme-primary); color: white; border: none; border-radius: 6px;"><i class="ti ti-device-floppy me-1"></i> Save Contact Info</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- 4. Social Media -->
                    <div class="tab-pane fade" id="v-pills-social" role="tabpanel" aria-labelledby="v-pills-social-tab">
                        <div class="card settings-card">
                            <div class="card-header">
                                <h5 class="card-title mb-0" style="color: var(--ins-heading-color);">Social Media Links</h5>
                                <p class="text-muted small mb-0 mt-1">Connect your social platforms to the website footer.</p>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.settings.website.social_media') }}" method="POST">
                                    @csrf
                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold" for="facebook_url">Facebook URL</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light"><i class="ti ti-brand-facebook text-primary"></i></span>
                                                <input type="url" class="form-control @error('facebook_url') is-invalid @enderror" id="facebook_url" name="facebook_url" value="{{ old('facebook_url', $setting?->facebook_url) }}" placeholder="https://facebook.com/yourpage">
                                            </div>
                                            @error('facebook_url')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold" for="instagram_url">Instagram URL</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light"><i class="ti ti-brand-instagram text-danger"></i></span>
                                                <input type="url" class="form-control @error('instagram_url') is-invalid @enderror" id="instagram_url" name="instagram_url" value="{{ old('instagram_url', $setting?->instagram_url) }}" placeholder="https://instagram.com/yourpage">
                                            </div>
                                            @error('instagram_url')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold" for="linkedin_url">LinkedIn URL</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light"><i class="ti ti-brand-linkedin text-info"></i></span>
                                                <input type="url" class="form-control @error('linkedin_url') is-invalid @enderror" id="linkedin_url" name="linkedin_url" value="{{ old('linkedin_url', $setting?->linkedin_url) }}" placeholder="https://linkedin.com/company/yourpage">
                                            </div>
                                            @error('linkedin_url')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold" for="youtube_url">YouTube URL</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light"><i class="ti ti-brand-youtube text-danger"></i></span>
                                                <input type="url" class="form-control @error('youtube_url') is-invalid @enderror" id="youtube_url" name="youtube_url" value="{{ old('youtube_url', $setting?->youtube_url) }}" placeholder="https://youtube.com/c/yourchannel">
                                            </div>
                                            @error('youtube_url')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="col-md-12 mb-4">
                                            <label class="form-label fw-semibold" for="twitter_url">Twitter URL (X)</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light"><i class="ti ti-brand-x text-dark"></i></span>
                                                <input type="url" class="form-control @error('twitter_url') is-invalid @enderror" id="twitter_url" name="twitter_url" value="{{ old('twitter_url', $setting?->twitter_url) }}" placeholder="https://twitter.com/yourhandle">
                                            </div>
                                            @error('twitter_url')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                        </div>
                                    </div>

                                    <div class="text-end">
                                        <button type="submit" class="btn px-4" style="background-color: var(--tl-color-theme-primary); color: white; border: none; border-radius: 6px;"><i class="ti ti-device-floppy me-1"></i> Save Links</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- 5. SEO Defaults -->
                    <div class="tab-pane fade" id="v-pills-seo" role="tabpanel" aria-labelledby="v-pills-seo-tab">
                        <div class="card settings-card">
                            <div class="card-header">
                                <h5 class="card-title mb-0" style="color: var(--ins-heading-color);">SEO Defaults</h5>
                                <p class="text-muted small mb-0 mt-1">Configure default search engine optimization settings.</p>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.settings.website.seo') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold" for="default_meta_title">Default Meta Title</label>
                                        <input type="text" class="form-control @error('default_meta_title') is-invalid @enderror" id="default_meta_title" name="default_meta_title" value="{{ old('default_meta_title', $setting?->default_meta_title) }}" placeholder="e.g. Best Services Company in India">
                                        @error('default_meta_title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label fw-semibold" for="default_meta_description">Default Meta Description</label>
                                        <textarea class="form-control @error('default_meta_description') is-invalid @enderror" id="default_meta_description" name="default_meta_description" rows="3" placeholder="Enter default SEO description...">{{ old('default_meta_description', $setting?->default_meta_description) }}</textarea>
                                        @error('default_meta_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    
                                    {!! $renderFileUI('Default OG Image', 'default_og_image', false, '2MB', '1200x630px') !!}

                                    <div class="text-end mt-4">
                                        <button type="submit" class="btn px-4" style="background-color: var(--tl-color-theme-primary); color: white; border: none; border-radius: 6px;"><i class="ti ti-device-floppy me-1"></i> Save SEO Settings</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- 6. Statistics -->
                    <div class="tab-pane fade" id="v-pills-stats" role="tabpanel" aria-labelledby="v-pills-stats-tab">
                        <div class="card settings-card">
                            <div class="card-header">
                                <h5 class="card-title mb-0" style="color: var(--ins-heading-color);">Website Statistics</h5>
                                <p class="text-muted small mb-0 mt-1">Numbers to display on your website counters.</p>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.settings.website.statistics') }}" method="POST">
                                    @csrf
                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold" for="years_of_experience">Years of Experience</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light"><i class="ti ti-calendar-time text-muted"></i></span>
                                                <input type="number" class="form-control @error('years_of_experience') is-invalid @enderror" id="years_of_experience" name="years_of_experience" value="{{ old('years_of_experience', $setting?->years_of_experience) }}" min="0">
                                            </div>
                                            @error('years_of_experience')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold" for="completed_projects">Completed Projects</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light"><i class="ti ti-check text-muted"></i></span>
                                                <input type="number" class="form-control @error('completed_projects') is-invalid @enderror" id="completed_projects" name="completed_projects" value="{{ old('completed_projects', $setting?->completed_projects) }}" min="0">
                                            </div>
                                            @error('completed_projects')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label fw-semibold" for="happy_clients">Happy Clients</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light"><i class="ti ti-users text-muted"></i></span>
                                                <input type="number" class="form-control @error('happy_clients') is-invalid @enderror" id="happy_clients" name="happy_clients" value="{{ old('happy_clients', $setting?->happy_clients) }}" min="0">
                                            </div>
                                            @error('happy_clients')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label fw-semibold" for="products_delivered">Products Delivered</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light"><i class="ti ti-truck-delivery text-muted"></i></span>
                                                <input type="number" class="form-control @error('products_delivered') is-invalid @enderror" id="products_delivered" name="products_delivered" value="{{ old('products_delivered', $setting?->products_delivered) }}" min="0">
                                            </div>
                                            @error('products_delivered')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                        </div>
                                    </div>

                                    <div class="text-end">
                                        <button type="submit" class="btn px-4" style="background-color: var(--tl-color-theme-primary); color: white; border: none; border-radius: 6px;"><i class="ti ti-device-floppy me-1"></i> Save Statistics</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection
