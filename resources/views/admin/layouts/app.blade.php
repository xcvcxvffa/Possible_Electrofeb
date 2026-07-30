<!DOCTYPE html>
<html lang="en">
@include('admin.partials.head')
<body class="global-skeleton-loading">
    <div class="wrapper">
        @include('admin.partials.header')
        
        @include('admin.partials.sidebar')
        
        <div class="content-page">
            @yield('content')
            
            @include('admin.partials.footer')
        </div>
    </div>
    
    @include('admin.partials.scripts')
    @include('admin.partials.toasts')
    @include('admin.partials.confirm-modal')
    @yield('scripts')
    @stack('scripts')

    <!-- Global Skeleton Loader Logic -->
    <style>
        /* Highly Optimized Global Skeleton CSS */
        .global-skeleton-loading .card,
        .global-skeleton-loading .table,
        .global-skeleton-loading .fm-card,
        .global-skeleton-loading .fm-sidebar,
        .global-skeleton-loading img,
        .global-skeleton-loading .skeleton-target {
            position: relative;
            overflow: hidden !important;
            border-color: #e2e8f0 !important;
            pointer-events: none;
            box-shadow: none !important;
        }

        /* Cover content with solid background instead of recursively hiding children (huge performance boost) */
        .global-skeleton-loading .card::before,
        .global-skeleton-loading .table::before,
        .global-skeleton-loading .fm-card::before,
        .global-skeleton-loading .fm-sidebar::before,
        .global-skeleton-loading img::before,
        .global-skeleton-loading .skeleton-target::before {
            content: "";
            position: absolute;
            inset: 0;
            background-color: #f1f5f9;
            z-index: 99;
        }

        /* GPU Accelerated Shimmer */
        .global-skeleton-loading .card::after,
        .global-skeleton-loading .table::after,
        .global-skeleton-loading .fm-card::after,
        .global-skeleton-loading .fm-sidebar::after,
        .global-skeleton-loading img::after,
        .global-skeleton-loading .skeleton-target::after {
            content: "";
            position: absolute;
            inset: 0;
            transform: translateX(-100%);
            background-image: linear-gradient(
                90deg,
                rgba(255, 255, 255, 0) 0,
                rgba(255, 255, 255, 0.6) 50%,
                rgba(255, 255, 255, 0) 100%
            );
            animation: globalShimmer 1.5s infinite;
            z-index: 100;
        }

        @keyframes globalShimmer {
            100% {
                transform: translateX(100%);
            }
        }
        
        body {
            transition: opacity 0.3s ease;
        }
    </style>
    <script>
        // Use DOMContentLoaded instead of window.load so we don't wait for heavy images
        document.addEventListener('DOMContentLoaded', function() {
            // Slight delay gives the illusion of speed and lets the DOM paint
            setTimeout(() => {
                document.body.classList.remove('global-skeleton-loading');
            }, 300);
        });
        
        // Fallback in case DOMContentLoaded already fired or fails
        window.addEventListener('load', function() {
            document.body.classList.remove('global-skeleton-loading');
        });
    </script>
</body>
</html>