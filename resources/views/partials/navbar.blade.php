<div class="header-menu-wrap">
    <div class="mobile-menu-items">
        <ul>
            <!-- 1. Home -->
            <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
                <a href="{{ route('home') }}">Home</a>
            </li>

            <!-- 2. About -->
            <li class="{{ request()->routeIs('about') ? 'active' : '' }}">
                <a href="{{ route('about') }}">About</a>
            </li>

            <!-- 3. Product -->
            <li class="menu-item-has-children {{ request()->routeIs('products') || request()->routeIs('product*') || request()->routeIs('services') || request()->routeIs('service*') ? 'active' : '' }}">
                <a href="{{ route('products') }}">Products</a>
                <ul>
                    <li><a href="{{ route('product.single', ['slug' => 'lt-pcc-panels']) }}">LT PCC PANELS</a></li>
                    <li><a href="{{ route('product.single', ['slug' => 'lt-ac-combiner-panels']) }}">LT AC COMBINER PANELS</a></li>
                    <li><a href="{{ route('product.single', ['slug' => 'lt-mcc-panel']) }}">LT MCC PANEL</a></li>
                    <li><a href="{{ route('product.single', ['slug' => 'apfc-panel']) }}">APFC PANEL</a></li>
                    <li><a href="{{ route('product.single', ['slug' => 'meter-panel']) }}">METER PANEL</a></li>
                    <li><a href="{{ route('product.single', ['slug' => 'solar-acdb-dcdb-panel']) }}">SOLAR ACDB / DCDB PANEL</a></li>
                    <li><a href="{{ route('product.single', ['slug' => 'cable-tray-system']) }}">CABLE TRAY SYSTEM</a></li>
                </ul>
            </li>

            <!-- 4. Blog -->
            <li class="{{ request()->routeIs('blogs') || request()->routeIs('blog*') ? 'active' : '' }}">
                <a href="{{ route('blogs') }}">Blog</a>
            </li>

            <!-- 5. Contact -->
            <li class="{{ request()->routeIs('contact') ? 'active' : '' }}">
                <a href="{{ route('contact') }}">Contact</a>
            </li>

            <!-- 6. Pages (All Demo Pages Dropdown) -->
            <li class="menu-item-has-children {{ request()->routeIs('home-*') || request()->routeIs('service*') || request()->routeIs('product*') || request()->routeIs('portfolio*') || request()->routeIs('project*') || request()->routeIs('team*') || request()->routeIs('gallery*') || request()->routeIs('pricing') || request()->routeIs('faq') || request()->routeIs('shop*') || request()->routeIs('coming-soon') || request()->routeIs('error-404') ? 'active' : '' }}">
                <a href="#">Pages</a>
                <ul class="two-column-menu">
                    <!-- Home Demos -->
                    <li class="{{ request()->routeIs('home-2') ? 'active' : '' }}"><a href="{{ route('home-2') }}">Home Two</a></li>
                    <li class="{{ request()->routeIs('home-3') ? 'active' : '' }}"><a href="{{ route('home-3') }}">Home Three</a></li>
                    <li class="{{ request()->routeIs('home-4') ? 'active' : '' }}"><a href="{{ route('home-4') }}">Home Four</a></li>
                    <li class="{{ request()->routeIs('home-5') ? 'active' : '' }}"><a href="{{ route('home-5') }}">Home Five</a></li>
                    <li class="{{ request()->routeIs('home-6') ? 'active' : '' }}"><a href="{{ route('home-6') }}">Home Six</a></li>
                    <li class="{{ request()->routeIs('home-7') ? 'active' : '' }}"><a href="{{ route('home-7') }}">Home Seven</a></li>
                    <li class="{{ request()->routeIs('home-8') ? 'active' : '' }}"><a href="{{ route('home-8') }}">Home Eight</a></li>
                    <li class="{{ request()->routeIs('home-9') ? 'active' : '' }}"><a href="{{ route('home-9') }}">Home Nine</a></li>
                    <li class="{{ request()->routeIs('home-10') ? 'active' : '' }}"><a href="{{ route('home-10') }}">Home Ten</a></li>
                    
                    <!-- Product Demos -->
                    <li class="{{ request()->routeIs('products') ? 'active' : '' }}"><a href="{{ route('products') }}">Products Catalog</a></li>
                    <li class="{{ request()->routeIs('product-2') ? 'active' : '' }}"><a href="{{ route('product-2') }}">Product Grid 2</a></li>
                    <li class="{{ request()->routeIs('product-3') ? 'active' : '' }}"><a href="{{ route('product-3') }}">Product Grid 3</a></li>
                    <li class="{{ request()->routeIs('product.single') ? 'active' : '' }}"><a href="{{ route('product.single') }}">Product Details</a></li>

                    <!-- Portfolio / Project Demos -->
                    <li class="{{ request()->routeIs('projects') ? 'active' : '' }}"><a href="{{ route('projects') }}">Portfolio Style 1</a></li>
                    <li class="{{ request()->routeIs('portfolio-2') ? 'active' : '' }}"><a href="{{ route('portfolio-2') }}">Portfolio Style 2</a></li>
                    <li class="{{ request()->routeIs('portfolio-3') ? 'active' : '' }}"><a href="{{ route('portfolio-3') }}">Portfolio Style 3</a></li>
                    <li class="{{ request()->routeIs('project.detail') ? 'active' : '' }}"><a href="{{ route('project.detail') }}">Portfolio Details</a></li>

                    <!-- Blog Demos -->
                    <li class="{{ request()->routeIs('blog.grid') ? 'active' : '' }}"><a href="{{ route('blog.grid') }}">Blog Grid</a></li>
                    <li class="{{ request()->routeIs('blog.list') ? 'active' : '' }}"><a href="{{ route('blog.list') }}">Blog List</a></li>
                    <li class="{{ request()->routeIs('blog.standard') ? 'active' : '' }}"><a href="{{ route('blog.standard') }}">Blog Standard</a></li>
                    <li class="{{ request()->routeIs('blog.single') ? 'active' : '' }}"><a href="{{ route('blog.single') }}">Blog Details</a></li>

                    <!-- Other Pages -->
                    <li class="{{ request()->routeIs('team') ? 'active' : '' }}"><a href="{{ route('team') }}">Team</a></li>
                    <li class="{{ request()->routeIs('team.details') ? 'active' : '' }}"><a href="{{ route('team.details') }}">Team Details</a></li>
                    <li class="{{ request()->routeIs('gallery-1') ? 'active' : '' }}"><a href="{{ route('gallery-1') }}">Gallery 1</a></li>
                    <li class="{{ request()->routeIs('gallery-2') ? 'active' : '' }}"><a href="{{ route('gallery-2') }}">Gallery 2</a></li>
                    <li class="{{ request()->routeIs('pricing') ? 'active' : '' }}"><a href="{{ route('pricing') }}">Pricing</a></li>
                    <li class="{{ request()->routeIs('faq') ? 'active' : '' }}"><a href="{{ route('faq') }}">FAQ</a></li>
                    <li class="{{ request()->routeIs('shop') ? 'active' : '' }}"><a href="{{ route('shop') }}">Shop</a></li>
                    <li class="{{ request()->routeIs('shop.details') ? 'active' : '' }}"><a href="{{ route('shop.details') }}">Shop Details</a></li>
                    <li class="{{ request()->routeIs('coming-soon') ? 'active' : '' }}"><a href="{{ route('coming-soon') }}">Coming Soon</a></li>
                    <li class="{{ request()->routeIs('error-404') ? 'active' : '' }}"><a href="{{ route('error-404') }}">404 Error</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
