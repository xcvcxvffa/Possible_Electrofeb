@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    
    <!-- Quick Actions Card -->
    <div class="row pt-4 pb-2">
        <div class="col-12">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-lg-5 col-md-12 mb-3 mb-lg-0">
                            <h4 class="fw-bold text-dark mb-1">Welcome back, Admin!</h4>
                            <p class="text-muted mb-0 fs-14">Here's what's happening with your CMS today.</p>
                        </div>
                        <div class="col-lg-7 col-md-12 text-lg-end">
                            <div class="d-flex flex-wrap justify-content-lg-end gap-2">
                                <a href="{{ route('admin.products.create') ?? '#' }}" class="btn btn-primary shadow-sm"><i class="ti ti-plus me-1"></i> Add Product</a>
                                <a href="{{ route('admin.blogs.create') ?? '#' }}" class="btn btn-success shadow-sm"><i class="ti ti-plus me-1"></i> Add Blog</a>
                                <a href="{{ route('admin.careers.create') ?? '#' }}" class="btn btn-info shadow-sm text-white"><i class="ti ti-plus me-1"></i> Add Career</a>
                                <a href="{{ route('admin.media.index') ?? '#' }}" class="btn btn-warning shadow-sm text-white"><i class="ti ti-upload me-1"></i> Upload Media</a>
                                <a href="{{ route('admin.settings.website') ?? '#' }}" class="btn btn-secondary shadow-sm"><i class="ti ti-settings me-1"></i> Settings</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- TOP STAT WIDGETS -->
    <div class="row row-cols-xxl-4 row-cols-md-2 row-cols-1">
        
        <!-- Products Widget -->
        <div class="col mb-4">
            <div class="card card-h-100 shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h5 class="text-uppercase text-muted fs-xs fw-semibold mb-1">Products</h5>
                            <h3 class="mb-0 fw-bold">{{ number_format($stats['total_products']) }}</h3>
                        </div>
                        <div class="avatar-sm bg-primary bg-opacity-10 rounded d-flex align-items-center justify-content-center">
                            <i data-lucide="box" class="text-primary fs-20"></i>
                        </div>
                    </div>

                    @php
                        $prodPercent = $stats['total_products'] > 0 ? ($stats['published_products'] / $stats['total_products']) * 100 : 0;
                    @endphp
                    <div class="progress progress-sm mb-3">
                        <div class="progress-bar bg-primary" style="width: {{ $prodPercent }}%;" role="progressbar"></div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <div>
                            <span class="text-muted fs-xs">Published: </span>
                            <span class="fw-semibold fs-sm text-dark">{{ number_format($stats['published_products']) }}</span>
                        </div>
                        <div class="text-end">
                            <span class="text-muted fs-xs">Categories: </span>
                            <span class="fw-semibold fs-sm text-dark">{{ number_format($stats['product_categories']) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Blogs Widget -->
        <div class="col mb-4">
            <div class="card card-h-100 shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h5 class="text-uppercase text-muted fs-xs fw-semibold mb-1">Blogs</h5>
                            <h3 class="mb-0 fw-bold">{{ number_format($stats['total_blogs']) }}</h3>
                        </div>
                        <div class="avatar-sm bg-success bg-opacity-10 rounded d-flex align-items-center justify-content-center">
                            <i data-lucide="file-text" class="text-success fs-20"></i>
                        </div>
                    </div>

                    @php
                        $blogPercent = $stats['total_blogs'] > 0 ? ($stats['published_blogs'] / $stats['total_blogs']) * 100 : 0;
                    @endphp
                    <div class="progress progress-sm mb-3">
                        <div class="progress-bar bg-success" style="width: {{ $blogPercent }}%;" role="progressbar"></div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <div>
                            <span class="text-muted fs-xs">Published: </span>
                            <span class="fw-semibold fs-sm text-dark">{{ number_format($stats['published_blogs']) }}</span>
                        </div>
                        <div class="text-end">
                            <span class="text-muted fs-xs">Categories: </span>
                            <span class="fw-semibold fs-sm text-dark">{{ number_format($stats['blog_categories']) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Careers Widget -->
        <div class="col mb-4">
            <div class="card card-h-100 shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h5 class="text-uppercase text-muted fs-xs fw-semibold mb-1">Careers</h5>
                            <h3 class="mb-0 fw-bold">{{ number_format($stats['total_careers']) }}</h3>
                        </div>
                        <div class="avatar-sm bg-info bg-opacity-10 rounded d-flex align-items-center justify-content-center">
                            <i data-lucide="briefcase" class="text-info fs-20"></i>
                        </div>
                    </div>

                    @php
                        $openPercent = $stats['total_careers'] > 0 ? ($stats['open_jobs'] / $stats['total_careers']) * 100 : 0;
                    @endphp
                    <div class="progress progress-sm mb-3">
                        <div class="progress-bar bg-info" style="width: {{ $openPercent }}%;" role="progressbar"></div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <div>
                            <span class="text-muted fs-xs">Open Jobs: </span>
                            <span class="fw-semibold fs-sm text-dark">{{ number_format($stats['open_jobs']) }}</span>
                        </div>
                        <div class="text-end">
                            <span class="text-muted fs-xs">Apps: </span>
                            <span class="fw-semibold fs-sm text-dark">{{ number_format($stats['total_applications']) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Inquiries Widget -->
        <div class="col mb-4">
            <div class="card card-h-100 shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h5 class="text-uppercase text-muted fs-xs fw-semibold mb-1">Inquiries</h5>
                            <h3 class="mb-0 fw-bold">{{ number_format($stats['total_inquiries']) }}</h3>
                        </div>
                        <div class="avatar-sm bg-warning bg-opacity-10 rounded d-flex align-items-center justify-content-center">
                            <i data-lucide="mail" class="text-warning fs-20"></i>
                        </div>
                    </div>

                    @php
                        $pendingPercent = $stats['total_inquiries'] > 0 ? ($stats['pending_inquiries'] / $stats['total_inquiries']) * 100 : 0;
                    @endphp
                    <div class="progress progress-sm mb-3">
                        <div class="progress-bar bg-warning" style="width: {{ $pendingPercent }}%;" role="progressbar"></div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <div>
                            <span class="text-muted fs-xs">Pending: </span>
                            <span class="fw-semibold fs-sm text-dark">{{ number_format($stats['pending_inquiries']) }}</span>
                        </div>
                        <div class="text-end">
                            <span class="text-muted fs-xs">Resolved: </span>
                            <span class="fw-semibold fs-sm text-dark">{{ number_format($stats['closed_inquiries']) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- end row-->



    <div class="row">
        <!-- Recent Activity Stream -->
        <div class="col-xl-4 col-lg-5 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-transparent border-bottom px-4 py-3 d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0 fs-16 fw-bold">Recent Activity</h4>
                </div>

                <div class="card-body p-0" data-simplebar style="max-height: 480px;">
                    <ul class="list-group list-group-flush">
                        @forelse($recentActivity as $activity)
                        <li class="list-group-item px-4 py-3">
                            <div class="d-flex align-items-start">
                                <div class="avatar-sm bg-light text-primary rounded me-3 d-flex align-items-center justify-content-center flex-shrink-0 mt-1">
                                    <i data-lucide="{{ $activity['icon'] }}" class="fs-18"></i>
                                </div>
                                <div class="flex-grow-1 min-w-0">
                                    <h5 class="fs-14 mb-1 fw-semibold text-truncate"><a href="javascript:void(0);" class="text-dark">{{ $activity['title'] }}</a></h5>
                                    <p class="text-muted fs-13 mb-0 text-truncate">
                                        <span class="fw-medium text-secondary">{{ $activity['created_by'] }}</span> added a new {{ strtolower($activity['module']) }}
                                    </p>
                                </div>
                                <div class="flex-shrink-0 ms-2 text-end">
                                    <span class="text-muted fs-xs">{{ \Carbon\Carbon::parse($activity['created_at'])->diffForHumans(null, true, true) }}</span>
                                </div>
                            </div>
                        </li>
                        @empty
                        <li class="list-group-item text-center py-4 text-muted">
                            No recent activity found.
                        </li>
                        @endforelse
                    </ul>
                </div>
            </div> <!-- end card-->
        </div> <!-- end col-->

        <!-- Recent Data Tabs -->
        <div class="col-xl-8 col-lg-7 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-transparent border-bottom px-4 py-3">
                    <ul class="nav nav-pills card-header-pills" id="recentDataTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active fs-14 fw-medium px-3 py-1 me-2" id="inquiries-tab" data-bs-toggle="tab" data-bs-target="#inquiries" type="button" role="tab" aria-selected="true">Recent Inquiries</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link fs-14 fw-medium px-3 py-1 me-2" id="applications-tab" data-bs-toggle="tab" data-bs-target="#applications" type="button" role="tab" aria-selected="false">Job Applications</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link fs-14 fw-medium px-3 py-1" id="blogs-tab" data-bs-toggle="tab" data-bs-target="#blogs" type="button" role="tab" aria-selected="false">Recent Blogs</button>
                        </li>
                    </ul>
                </div>
                
                <div class="card-body p-0">
                    <div class="tab-content" id="recentDataTabContent">
                        
                        <!-- Inquiries Tab -->
                        <div class="tab-pane fade show active" id="inquiries" role="tabpanel" aria-labelledby="inquiries-tab">
                            <div class="table-responsive">
                                <table class="table table-hover table-centered table-nowrap mb-0 align-middle">
                                    <thead class="bg-light">
                                        <tr class="text-uppercase fs-xxs text-muted fw-semibold">
                                            <th class="px-4 py-3">Customer Name</th>
                                            <th class="py-3">Subject</th>
                                            <th class="py-3">Date</th>
                                            <th class="px-4 py-3 text-end">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($recentInquiries as $inquiry)
                                        <tr>
                                            <td class="px-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-xs bg-primary-subtle text-primary rounded-circle me-2 d-flex align-items-center justify-content-center fw-bold">
                                                        {{ substr($inquiry->full_name, 0, 1) }}
                                                    </div>
                                                    <h5 class="fs-14 mb-0 fw-medium">{{ $inquiry->full_name }}</h5>
                                                </div>
                                            </td>
                                            <td>{{ Str::limit($inquiry->subject, 30) }}</td>
                                            <td>{{ $inquiry->created_at->format('M d, Y') }}</td>
                                            <td class="px-4 text-end">
                                                <span class="badge {{ $inquiry->status == 'pending' ? 'bg-warning-subtle text-warning' : ($inquiry->status == 'closed' ? 'bg-success-subtle text-success' : 'bg-info-subtle text-info') }} px-2 py-1 fs-12">
                                                    {{ ucfirst($inquiry->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-5 text-muted">No recent inquiries found.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Applications Tab -->
                        <div class="tab-pane fade" id="applications" role="tabpanel" aria-labelledby="applications-tab">
                            <div class="table-responsive">
                                <table class="table table-hover table-centered table-nowrap mb-0 align-middle">
                                    <thead class="bg-light">
                                        <tr class="text-uppercase fs-xxs text-muted fw-semibold">
                                            <th class="px-4 py-3">Applicant Name</th>
                                            <th class="py-3">Applied For</th>
                                            <th class="py-3">Date</th>
                                            <th class="px-4 py-3 text-end">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($recentApplications as $app)
                                        <tr>
                                            <td class="px-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-xs bg-info-subtle text-info rounded-circle me-2 d-flex align-items-center justify-content-center fw-bold">
                                                        {{ substr($app->first_name, 0, 1) }}
                                                    </div>
                                                    <div>
                                                        <h5 class="fs-14 mb-0 fw-medium">{{ $app->first_name }} {{ $app->last_name }}</h5>
                                                        <span class="fs-xs text-muted">{{ $app->email }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $app->career ? Str::limit($app->career->title, 30) : 'N/A' }}</td>
                                            <td>{{ $app->created_at->format('M d, Y') }}</td>
                                            <td class="px-4 text-end">
                                                <span class="badge bg-primary-subtle text-primary px-2 py-1 fs-12">{{ ucfirst($app->status ?? 'New') }}</span>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-5 text-muted">No recent applications found.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Blogs Tab -->
                        <div class="tab-pane fade" id="blogs" role="tabpanel" aria-labelledby="blogs-tab">
                            <div class="table-responsive">
                                <table class="table table-hover table-centered table-nowrap mb-0 align-middle">
                                    <thead class="bg-light">
                                        <tr class="text-uppercase fs-xxs text-muted fw-semibold">
                                            <th class="px-4 py-3">Article Title</th>
                                            <th class="py-3">Category</th>
                                            <th class="py-3">Date</th>
                                            <th class="px-4 py-3 text-end">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($recentBlogs as $blog)
                                        <tr>
                                            <td class="px-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-xs bg-success-subtle text-success rounded me-2 d-flex align-items-center justify-content-center">
                                                        <i data-lucide="file-text" class="fs-14"></i>
                                                    </div>
                                                    <h5 class="fs-14 mb-0 fw-medium">{{ Str::limit($blog->title, 40) }}</h5>
                                                </div>
                                            </td>
                                            <td>{{ $blog->category ? $blog->category->name : 'N/A' }}</td>
                                            <td>{{ $blog->created_at->format('M d, Y') }}</td>
                                            <td class="px-4 text-end">
                                                @if($blog->status)
                                                    <span class="badge bg-success-subtle text-success px-2 py-1 fs-12">Published</span>
                                                @else
                                                    <span class="badge bg-secondary-subtle text-secondary px-2 py-1 fs-12">Draft</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-5 text-muted">No recent blogs found.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end row -->

</div> <!-- end container -->
@endsection

@section('scripts')
<script>
    window.dashboardStats = @json($stats);
    window.dashboardCharts = @json($charts);
</script>
<!-- Initialize Chart directly here to avoid dashboard.js caching/squashing issues -->
<script src="{{ asset('admin/assets/js/vendor/chart.min.js') }}"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    let data = window.dashboardCharts;
    
    // Check if Chart is loaded
    if (typeof Chart === 'undefined') {
        console.warn('Chart.js not loaded');
        return;
    }


});
</script>
@endsection
