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
                                <p class="text-muted w-lg-75 mt-3">Let’s get you signed in. Enter your email and password to continue.</p>
                            </div>
            
                            <div class="">
                                <form action="{{ route('admin.login') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="userEmail" class="form-label">Email address <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="userEmail" placeholder="you@example.com" value="{{ old('email') }}" required>
                                        </div>
                                        @error('email')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
            
                                    <div class="mb-3">
                                        <label for="userPassword" class="form-label">Password <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="password" name="password" class="form-control border-end-0" id="userPassword" placeholder="••••••••" required>
                                            <span class="input-group-text bg-white border-start-0 cursor-pointer" onclick="togglePassword('userPassword', this)" style="cursor: pointer;">
                                                <i class="ti ti-eye fs-18 text-muted"></i>
                                            </span>
                                        </div>
                                    </div>
            
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input form-check-input-light fs-14" type="checkbox" name="remember" id="rememberMe">
                                            <label class="form-check-label" for="rememberMe">Keep me signed in</label>
                                        </div>
                                        <a href="{{ route('admin.password.request') }}" class="text-decoration-underline link-offset-3 text-muted">Forgot Password?</a>
                                    </div>
            
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary fw-semibold py-2">Sign In</button>
                                    </div>
                                </form>
                            </div>
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
    </div>
    
    <script>
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
@endsection
