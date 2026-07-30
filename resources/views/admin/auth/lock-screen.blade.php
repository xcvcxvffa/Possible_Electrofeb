@extends('admin.layouts.guest')

@section('content')

    <div class="auth-box overflow-hidden align-items-center d-flex">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-md-6 col-sm-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="auth-brand mb-4 text-center">
                                <a href="{{ url('admin/dashboard') }}" class="logo-dark">
                                    <img src="{{ $setting?->admin_login_logo ? asset('storage/'.$setting?->admin_login_logo) : ($setting?->logo ? asset('storage/'.$setting?->logo) : asset('assets/img/logo/POSSIBLE ELECTROFEB LOGO.svg')) }}" alt="Logo" style="height: 45px; width: auto;">
                                </a>
                                <a href="{{ url('admin/dashboard') }}" class="logo-light">
                                    <img src="{{ $setting?->admin_login_logo ? asset('storage/'.$setting?->admin_login_logo) : ($setting?->dark_logo ? asset('storage/'.$setting?->dark_logo) : asset('assets/img/logo/POSSIBLE ELECTROFEB LOGO.svg')) }}" alt="Logo" style="height: 45px; width: auto;">
                                </a>
                            </div>

                            <div class="text-center mb-4">
                                <img src="{{ Auth::check() ? Auth::user()->avatar_url : asset('admin/assets/images/users/user-1.jpg') }}" alt="user-image" class="rounded-circle avatar-lg img-thumbnail">
                                <h4 class="mt-3 mb-1 fw-semibold">Hi ! {{ Auth::check() ? Auth::user()->name : 'Admin' }}</h4>
                                <p class="text-muted">Enter your password to access the admin panel.</p>
                            </div>
            
                            <div class="">
                                <form action="{{ route('admin.lock.unlock') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="userPassword" class="form-label">Password <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="password" name="password" class="form-control border-end-0" id="userPassword" placeholder="••••••••" required>
                                            <span class="input-group-text bg-white border-start-0 cursor-pointer" onclick="togglePassword('userPassword', this)" style="cursor: pointer;">
                                                <i class="ti ti-eye fs-18 text-muted"></i>
                                            </span>
                                        </div>
                                        @error('password')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
            
                                    <div class="d-grid mb-3">
                                        <button type="submit" class="btn btn-primary fw-semibold py-2">Unlock</button>
                                    </div>

                                    <div class="text-center">
                                        <p class="text-muted">Not you? return <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-dark fw-semibold ms-1">Sign In</a></p>
                                    </div>
                                </form>
                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
