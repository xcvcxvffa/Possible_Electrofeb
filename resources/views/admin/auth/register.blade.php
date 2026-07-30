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
                                <p class="text-muted w-lg-75 mt-3">Let’s get you started. Create your account by entering your details below.</p>
                            </div>

                            <form>
                                <div class="mb-3">
                                    <label for="userName" class="form-label">Name <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="userName" placeholder="Damian D." required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="userEmail" class="form-label">Email address <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="email" class="form-control" id="userEmail" placeholder="you@example.com" required>
                                    </div>
                                </div>

                                <div class="mb-3" data-password="bar">
                                    <label for="userPassword" class="form-label">Password <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="userPassword" placeholder="••••••••" required>
                                    </div>
                                    <div class="password-bar my-2"></div>
                                    <p class="text-muted fs-xs mb-0">Use 8+ characters with letters, numbers & symbols.</p>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input form-check-input-light fs-14 mt-0" type="checkbox" id="termAndPolicy">
                                        <label class="form-check-label" for="termAndPolicy">Agree the Terms & Policy</label>
                                    </div>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary fw-semibold py-2">Create Account</button>
                                </div>
                            </form>

                            <p class="text-muted text-center mt-4 mb-0">
                                Already have an account? <a href="{{ url('admin/login') }}" class="text-decoration-underline link-offset-3 fw-semibold">Login</a>
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



