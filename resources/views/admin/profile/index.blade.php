@extends('admin.layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box mt-4 mb-4 d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0" style="font-size: 22px; font-weight: 600; color: var(--ins-heading-color);">My Profile</h4>
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
        <form id="delete-file-form" action="{{ route('admin.profile.delete_file') }}" method="POST" style="display: none;">
            @csrf
            <input type="hidden" name="field" id="delete-file-field" value="">
        </form>

        <script>
            function deleteFile(field) {
                let modalHtml = `
                <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm">
                        <div class="modal-content text-center" style="border: none; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                            <div class="modal-body p-4">
                                <div class="text-danger mb-3">
                                    <i class="ti ti-alert-triangle" style="font-size: 3rem;"></i>
                                </div>
                                <h5 class="mb-2 fw-semibold">Are you sure?</h5>
                                <p class="text-muted fs-13 mb-4">Do you really want to delete this file? This action cannot be undone.</p>
                                <div class="d-flex justify-content-center gap-2">
                                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-danger px-4" id="confirmDeleteBtn">Yes, Delete it!</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`;

                let oldModal = document.getElementById('deleteConfirmModal');
                if(oldModal) { oldModal.remove(); }

                document.body.insertAdjacentHTML('beforeend', modalHtml);
                let modal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
                
                document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
                    document.getElementById('delete-file-field').value = field;
                    document.getElementById('delete-file-form').submit();
                });

                modal.show();
            }

            function togglePassword(inputId, el) {
                const input = document.getElementById(inputId);
                const icon = el.querySelector('i');
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('ti-eye');
                    icon.classList.add('ti-eye-off');
                } else {
                    input.type = 'password';
                    icon.classList.remove('ti-eye-off');
                    icon.classList.add('ti-eye');
                }
            }
        </script>

        @php
            // Reusable macro-like block for file upload UI to avoid repetitive code
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

        @php
            $hasPasswordError = $errors->has('current_password') || $errors->has('password');
        @endphp

        <div class="row">
            <!-- Sidebar Tabs -->
            <div class="col-xl-3 col-lg-4 mb-4">
                <div class="card settings-card">
                    <div class="card-body p-0">
                        <div class="nav flex-column nav-pills settings-tabs" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link {{ $hasPasswordError ? '' : 'active' }} border-bottom" id="v-pills-personal-tab" data-bs-toggle="pill" href="#v-pills-personal" role="tab" aria-controls="v-pills-personal" aria-selected="{{ $hasPasswordError ? 'false' : 'true' }}">
                                <i class="ti ti-user-circle me-2 fs-18 align-middle"></i> Personal Info
                            </a>
                            <a class="nav-link {{ $hasPasswordError ? 'active' : '' }} border-bottom" id="v-pills-password-tab" data-bs-toggle="pill" href="#v-pills-password" role="tab" aria-controls="v-pills-password" aria-selected="{{ $hasPasswordError ? 'true' : 'false' }}">
                                <i class="ti ti-lock-square me-2 fs-18 align-middle"></i> Change Password
                            </a>
                            <a class="nav-link" id="v-pills-admin-branding-tab" data-bs-toggle="pill" href="#v-pills-admin-branding" role="tab" aria-controls="v-pills-admin-branding" aria-selected="false">
                                <i class="ti ti-shield-half-filled me-2 fs-18 align-middle"></i> Admin Branding
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab Content -->
            <div class="col-xl-9 col-lg-8">
                <div class="tab-content" id="v-pills-tabContent">
                    
                    <!-- 1. Personal Info & Password Combined Form (to match original controller logic) -->
                    <div class="tab-pane fade {{ $hasPasswordError ? '' : 'show active' }}" id="v-pills-personal" role="tabpanel" aria-labelledby="v-pills-personal-tab">
                        <div class="card settings-card">
                            <div class="card-header">
                                <h5 class="card-title mb-0" style="color: var(--ins-heading-color);">Personal Information</h5>
                                <p class="text-muted small mb-0 mt-1">Manage your account details and profile picture.</p>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    
                                    <div class="row align-items-center mb-3">
                                        <div class="col-lg-3">
                                            <label class="form-label fw-semibold text-dark mb-lg-0" for="avatar">Profile Picture</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="rounded-circle border overflow-hidden bg-light d-flex align-items-center justify-content-center shadow-sm p-1" style="width: 70px; height: 70px; flex-shrink: 0;">
                                                    <img src="{{ Auth::user()->avatar_url }}" alt="Avatar" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="d-flex flex-wrap align-items-center gap-2">
                                                        <div class="position-relative" style="max-width: 350px; flex-grow: 1;">
                                                            <input type="file" class="form-control @error('avatar') is-invalid @enderror" id="avatar" name="avatar" accept="image/*">
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center gap-3 mt-2 text-muted" style="font-size: 12px;">
                                                        <span><i class="ti ti-ruler-2 me-1"></i>Rec: Square 150x150px</span>
                                                    </div>
                                                    @error('avatar')
                                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="border-dashed my-4">

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold" for="name">Full Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', Auth::user()->name) }}">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label fw-semibold" for="email">Email Address</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', Auth::user()->email) }}">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="text-end">
                                        <button type="submit" class="btn px-4" style="background-color: var(--tl-color-theme-primary); color: white; border: none; border-radius: 6px;"><i class="ti ti-device-floppy me-1"></i> Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Change Password Tab -->
                    <div class="tab-pane fade {{ $hasPasswordError ? 'show active' : '' }}" id="v-pills-password" role="tabpanel" aria-labelledby="v-pills-password-tab">
                        <div class="card settings-card">
                            <div class="card-header">
                                <h5 class="card-title mb-0" style="color: var(--ins-heading-color);">Change Password</h5>
                                <p class="text-muted small mb-0 mt-1">Ensure your account is using a long, random password to stay secure.</p>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <!-- Re-send name and email to avoid validation errors if they are required by the controller -->
                                    <input type="hidden" name="name" value="{{ Auth::user()->name }}">
                                    <input type="hidden" name="email" value="{{ Auth::user()->email }}">

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold" for="current_password">Current Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control border-end-0 @error('current_password') is-invalid @enderror" id="current_password" name="current_password" placeholder="Enter current password">
                                            <span class="input-group-text bg-white border-start-0 cursor-pointer @error('current_password') border-danger @enderror" onclick="togglePassword('current_password', this)">
                                                <i class="ti ti-eye fs-18 text-muted"></i>
                                            </span>
                                        </div>
                                        @error('current_password')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <hr class="border-dashed my-4">

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold" for="password">New Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control border-end-0 @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter new password">
                                            <span class="input-group-text bg-white border-start-0 cursor-pointer @error('password') border-danger @enderror" onclick="togglePassword('password', this)">
                                                <i class="ti ti-eye fs-18 text-muted"></i>
                                            </span>
                                        </div>
                                        @error('password')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label fw-semibold" for="password_confirmation">Confirm New Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control border-end-0" id="password_confirmation" name="password_confirmation" placeholder="Confirm new password">
                                            <span class="input-group-text bg-white border-start-0 cursor-pointer" onclick="togglePassword('password_confirmation', this)">
                                                <i class="ti ti-eye fs-18 text-muted"></i>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="text-end">
                                        <button type="submit" class="btn px-4" style="background-color: var(--tl-color-theme-primary); color: white; border: none; border-radius: 6px;"><i class="ti ti-lock me-1"></i> Update Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Admin Panel Branding Tab -->
                    <div class="tab-pane fade" id="v-pills-admin-branding" role="tabpanel" aria-labelledby="v-pills-admin-branding-tab">
                        <div class="card settings-card">
                            <div class="card-header">
                                <h5 class="card-title mb-0" style="color: var(--ins-heading-color);">Admin Panel Branding</h5>
                                <p class="text-muted small mb-0 mt-1">Customize the look and feel of the admin dashboard.</p>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.profile.admin_branding') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    
                                    {!! $renderFileUI('Admin Logo', 'admin_logo', true, '2MB', '200x50px') !!}
                                    <hr class="border-dashed my-4">
                                    
                                    {!! $renderFileUI('Admin Mini Logo', 'admin_mini_logo', true, '2MB', 'Square 50x50px') !!}
                                    <hr class="border-dashed my-4">

                                    {!! $renderFileUI('Admin Login Logo', 'admin_login_logo', false, '2MB', '200x50px') !!}
                                    <hr class="border-dashed my-4">

                                    {!! $renderFileUI('Admin Login Background', 'admin_login_background', false, '5MB', '1920x1080px') !!}
                                    <hr class="border-dashed my-4">

                                    {!! $renderFileUI('Admin Favicon', 'admin_favicon', false, '512KB', 'Square 64x64px') !!}

                                    <div class="text-end mt-4">
                                        <button type="submit" class="btn px-4" style="background-color: var(--tl-color-theme-primary); color: white; border: none; border-radius: 6px;"><i class="ti ti-device-floppy me-1"></i> Save Admin Branding</button>
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

