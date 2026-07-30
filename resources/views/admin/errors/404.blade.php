@extends(auth()->check() ? 'admin.layouts.app' : 'admin.layouts.guest')

@section('content')

@if(auth()->check())
<div class="container-fluid">
    <div class="row justify-content-center pt-5">
        <div class="col-xl-5 col-lg-6 col-md-8 text-center pt-5">
            <div class="text-error fw-bold display-1 text-primary">404</div>
            <h3 class="fw-bold mt-4 mb-3">Page Not Found</h3>
            <p class="text-muted fs-15 mb-4">The page you’re looking for doesn’t exist or has been moved.</p>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-primary rounded-pill px-4"><i class="ti ti-arrow-left me-2"></i> Return to Dashboard</a>
        </div>
    </div>
</div>
@else
    <div class="auth-box overflow-hidden align-items-center d-flex">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-md-6 col-sm-8">
                    <div class="card shadow-lg border-0">
                        <div class="card-body p-5 text-center">
                            <div class="text-error fw-bold fs-60 text-primary">404</div>
                            <h3 class="fw-bold mt-2">Page Not Found</h3>
                            <p class="text-muted mt-3 mb-4">The page you’re looking for doesn’t exist or has been moved.</p>
                            <a href="{{ route('admin.login') }}" class="btn btn-primary rounded-pill w-100">Return to Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@endsection
