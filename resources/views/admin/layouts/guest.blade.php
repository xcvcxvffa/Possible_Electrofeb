<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Sign In | Vona - Responsive Bootstrap 5 Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="admin dashboard template on Themeforest. Perfect for building CRM, CMS, project management tools, and custom web apps with clean UI, responsive design, and powerful features.">
    <meta name="keywords" content="Vona, Admin dashboard, Themeforest, HTML template,Shadcn, Bootstrap admin, CRM template, CMS template, responsive admin, web app UI, admin theme, best admin template">
    <meta name="author" content="Coderthemes">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ $setting?->admin_favicon ? asset('storage/'.$setting?->admin_favicon) : ($setting?->favicon ? asset('storage/'.$setting?->favicon) : asset('admin/assets/images/favicon.ico')) }}">

    <!-- Theme Config Js -->
    <script src="{{ asset('admin/assets/js/config.js') }}"></script>

    <!-- Vendor css -->
    <link href="{{ asset('admin/assets/css/vendors.min.css') }}" rel="stylesheet" type="text/css">

    <!-- App css -->
    <link href="{{ asset('admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css">

    <script src="{{ asset('admin/assets/plugins/lucide/lucide.min.js') }}"></script>

</head>
<body style="{{ $setting?->admin_login_background ? 'background-image: url('.asset('storage/'.$setting?->admin_login_background).'); background-size: cover; background-position: center;' : '' }}">
    @yield('content')
    
    <!-- Vendor js -->
    <script src="{{ asset('admin/assets/js/vendors.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('admin/assets/js/app.js') }}"></script>

    @include('admin.partials.toasts')

</body>
</html>
