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
                                <p class="text-muted w-lg-75 mt-3">Enter your email address and we'll send you a link to reset your password.</p>
                            </div>

                            @if (session('status'))
                                <div class="alert alert-success mb-3" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form action="{{ route('admin.password.email') }}" method="POST">
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
                                    <div class="form-check">
                                        <input class="form-check-input form-check-input-light fs-14" type="checkbox" id="termAndPolicy">
                                        <label class="form-check-label" for="termAndPolicy">Agree the Terms & Policy</label>
                                    </div>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary fw-semibold py-2">Send Request</button>
                                </div>
                            </form>

                            <p class="text-muted text-center mt-4 mb-0">
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



