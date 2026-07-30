@extends('admin.layouts.guest')

@section('content')


    <div class="auth-box overflow-hidden align-items-center d-flex">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-md-6 col-sm-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="auth-brand mb-4">
                                <a href="{{ url('admin/dashboard') }}" class="logo-dark">
                                    <img src="{{ $setting?->admin_login_logo ? asset('storage/'.$setting?->admin_login_logo) : ($setting?->logo ? asset('storage/'.$setting?->logo) : asset('assets/img/logo/POSSIBLE ELECTROFEB LOGO.svg')) }}" alt="Logo" style="height: 45px; width: auto;">
                                </a>
                                <a href="{{ url('admin/dashboard') }}" class="logo-light">
                                    <img src="{{ $setting?->admin_login_logo ? asset('storage/'.$setting?->admin_login_logo) : ($setting?->dark_logo ? asset('storage/'.$setting?->dark_logo) : asset('assets/img/logo/POSSIBLE ELECTROFEB LOGO.svg')) }}" alt="Logo" style="height: 45px; width: auto;">
                                </a>
                                <p class="text-muted mt-3">We've emailed you a 6-digit verification code. Please enter it below to confirm your email address</p>
                            </div>

                            <form action="{{ route('admin.password.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="mb-3">
                                    <label for="userEmail" class="form-label">Email address <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="userEmail" value="{{ $email ?? old('email') }}" required readonly>
                                    </div>
                                    @error('email')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Hidden 2FA code since Laravel uses URL token for reset -->
                                <div class="mb-3 d-none">
                                    <label class="form-label">Enter your 6-digit code <span class="text-danger">*</span></label>
                                    <div class="d-flex gap-2 two-factor">
                                        <input type="text" class="form-control text-center">
                                        <input type="text" class="form-control text-center">
                                        <input type="text" class="form-control text-center">
                                        <input type="text" class="form-control text-center">
                                        <input type="text" class="form-control text-center">
                                        <input type="text" class="form-control text-center">
                                    </div>
                                </div>

                                <div class="mb-3" data-password="bar">
                                    <label for="userPassword" class="form-label">Password <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="userPassword" placeholder="••••••••" required>
                                    </div>
                                    @error('password')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                    <div class="password-bar my-2"></div>
                                    <p class="text-muted fs-xs mb-0">Use 8+ characters with letters, numbers & symbols.</p>
                                </div>

                                <div class="mb-3">
                                    <label for="userNewPassword" class="form-label">Confirm New Password <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" name="password_confirmation" class="form-control" id="userNewPassword" placeholder="••••••••" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input form-check-input-light fs-14" type="checkbox" id="termAndPolicy">
                                        <label class="form-check-label" for="termAndPolicy">Agree the Terms & Policy</label>
                                    </div>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary fw-semibold py-2">Update Password</button>
                                </div>

                            </form>
                            <p class="text-muted text-center mb-0">
                                Return to <a href="{{ url('admin/login') }}" class="text-decoration-underline link-offset-3 fw-semibold">Sign in</a>
                            </p>
                        </div>
                    </div>

                    <p class="text-center text-muted mt-4 mb-0">
                        © <script>document.write(new Date().getFullYear())</script> Vona — by <span class="fw-semibold">Coderthemes</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- end auth-fluid-->

    
@endsection



