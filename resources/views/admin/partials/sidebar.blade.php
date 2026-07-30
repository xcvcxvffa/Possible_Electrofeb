<script>
            // Skin Dropdown
            document.querySelectorAll('[data-dropdown="custom"]').forEach(dropdown => {
                const trigger = dropdown.querySelector('a[data-bs-toggle="dropdown"], button[data-bs-toggle="dropdown"]');
                const items = dropdown.querySelectorAll('button[data-skin]');

                const triggerImg = trigger.querySelector('[data-trigger-img]');
                const triggerLabel = trigger.querySelector('[data-trigger-label]');

                const config = JSON.parse(JSON.stringify(window.config));
                const currentSkin = config.skin;

                items.forEach(item => {
                    const itemSkin = item.getAttribute('data-skin');
                    const itemImg = item.querySelector('img')?.getAttribute('src');
                    const itemText = item.querySelector('span')?.textContent.trim();

                    // Set active on load
                    if (itemSkin === currentSkin) {
                        item.classList.add('drop-custom-active');
                        if (triggerImg && itemImg) triggerImg.setAttribute('src', itemImg);
                        if (triggerLabel && itemText) triggerLabel.textContent = itemText;
                    } else {
                        item.classList.remove('drop-custom-active');
                    }

                    // Click handler
                    item.addEventListener('click', function () {
                        items.forEach(i => i.classList.remove('drop-custom-active'));
                        this.classList.add('drop-custom-active');

                        const newImg = this.querySelector('img')?.getAttribute('src');
                        const newText = this.querySelector('span')?.textContent.trim();

                        if (triggerImg && newImg) triggerImg.setAttribute('src', newImg);
                        if (triggerLabel && newText) triggerLabel.textContent = newText;

                        if (typeof layoutCustomizer !== 'undefined') {
                            layoutCustomizer.changeSkin(itemSkin);
                        }
                    });
                });
            });
        </script>

        <!-- Sidenav Menu Start -->
        <div class="sidenav-menu">
            <div class="scrollbar" data-simplebar>

                <!-- User -->
                <div class="sidenav-user text-nowrap border border-dashed rounded-3">
                    <a href="#!" class="sidenav-user-name d-flex align-items-center">
                        <img src="{{ Auth::user()->avatar_url }}" width="36" height="36" class="rounded-circle me-2 d-flex" style="object-fit: cover;" alt="user-image">
                        <span>
                            <h5 class="my-0 fw-semibold">{{ Auth::user()->name }}</h5>
                            <h6 class="my-0 text-muted">Administrator</h6>
                        </span>
                    </a>
                </div>

                <!--- Sidenav Menu -->
                <ul class="side-nav">

                    <li class="side-nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="side-nav-link">
                            <span class="menu-icon"><i data-lucide="circle-gauge"></i></span>
                            <span class="menu-text" data-lang="dashboard">Dashboard</span>
                        </a>
                    </li>

                    <li class="side-nav-item">
                        <a href="{{ route('admin.settings.website') }}" class="side-nav-link">
                            <span class="menu-icon"><i data-lucide="settings"></i></span>
                            <span class="menu-text" data-lang="website-settings">Website Settings</span>
                        </a>
                    </li>

                    <li class="side-nav-item">
                        <a href="{{ route('admin.media.index') }}" class="side-nav-link">
                            <span class="menu-icon"><i data-lucide="folder-open"></i></span>
                            <span class="menu-text" data-lang="file-manager">File Manager</span>
                        </a>
                    </li>

                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarProducts" aria-expanded="false" aria-controls="sidebarProducts" class="side-nav-link">
                            <span class="menu-icon"><i data-lucide="package"></i></span>
                            <span class="menu-text" data-lang="products"> Products </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarProducts">
                            <ul class="sub-menu">
                                <li class="side-nav-item">
                                    <a href="{{ route('admin.product-categories.index') }}" class="side-nav-link">
                                        <span class="menu-text" data-lang="categories">Categories</span>
                                    </a>
                                </li>
                                <li class="side-nav-item">
                                    <a href="{{ route('admin.products.index') }}" class="side-nav-link">
                                        <span class="menu-text" data-lang="all-products">All Products</span>
                                    </a>
                                </li>
                                <li class="side-nav-item">
                                    <a href="{{ route('admin.products.create') }}" class="side-nav-link">
                                        <span class="menu-text" data-lang="add-product">Add Product</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarBlog" aria-expanded="false" aria-controls="sidebarBlog" class="side-nav-link">
                            <span class="menu-icon"><i data-lucide="file-text"></i></span>
                            <span class="menu-text" data-lang="blog"> Blog </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarBlog">
                            <ul class="sub-menu">
                                <li class="side-nav-item">
                                    <a href="{{ route('admin.blog-categories.index') }}" class="side-nav-link">
                                        <span class="menu-text" data-lang="categories">Categories</span>
                                    </a>
                                </li>
                                <li class="side-nav-item">
                                    <a href="{{ route('admin.blogs.index') }}" class="side-nav-link">
                                        <span class="menu-text" data-lang="all-blogs">All Blogs</span>
                                    </a>
                                </li>
                                <li class="side-nav-item">
                                    <a href="{{ route('admin.blogs.create') }}" class="side-nav-link">
                                        <span class="menu-text" data-lang="add-blog">Add Blog</span>
                                    </a>
                                </li>
                                <li class="side-nav-item">
                                    <a href="{{ route('admin.blogs.trash') }}" class="side-nav-link">
                                        <span class="menu-text" data-lang="trash">Trash</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarCareers" aria-expanded="false" aria-controls="sidebarCareers" class="side-nav-link">
                            <span class="menu-icon"><i data-lucide="briefcase"></i></span>
                            <span class="menu-text" data-lang="careers"> Careers </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarCareers">
                            <ul class="sub-menu">
                                <li class="side-nav-item">
                                    <a href="{{ route('admin.job-applications.index') }}" class="side-nav-link">
                                        <span class="menu-text" data-lang="applications">Applications</span>
                                    </a>
                                </li>
                                <li class="side-nav-item">
                                    <a href="{{ route('admin.careers.index') }}" class="side-nav-link">
                                        <span class="menu-text" data-lang="all-jobs">All Jobs</span>
                                    </a>
                                </li>
                                <li class="side-nav-item">
                                    <a href="{{ route('admin.careers.create') }}" class="side-nav-link">
                                        <span class="menu-text" data-lang="add-job">Add Job</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Inquiry Management -->
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarInquiries" aria-expanded="false" aria-controls="sidebarInquiries" class="side-nav-link">
                            <span class="menu-icon"><i data-lucide="mail"></i></span>
                            <span class="menu-text"> Inquiry Management </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarInquiries">
                            <ul class="sub-menu">
                                <li class="side-nav-item">
                                    <a href="{{ route('admin.contact-inquiries.index') }}" class="side-nav-link">
                                        <span class="menu-text">All Inquiries</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="menu-collapse-box d-none d-xl-block">
                <button class="button-collapse-toggle">
                    <i data-lucide="square-chevron-left" class="align-middle flex-shrink-0"></i> <span>Collapse Menu</span>
                </button>
            </div>
        </div>
        <!-- Sidenav Menu End -->

        <script>
            // Note: If you do not want any of this logic here, you can remove it. It's already in app.js. This is for removing delays.

            // Sidenav Icons
            lucide.createIcons();

            // Sidenav Link Activation
            const currentUrlT = window.location.href.split(/[?#]/)[0];
            const currentPageT = window.location.pathname.split("https://themes.coderthemes.com/").pop();
            const sideNavT = document.querySelector('.side-nav');

            document.querySelectorAll('.side-nav-link[href]').forEach(link => {
                const linkHref = link.getAttribute('href');
                if (!linkHref) return;

                const match = linkHref === currentPageT || link.href === currentUrlT;

                if (match) {
                    // Mark link and its li active
                    link.classList.add('active');
                    const li = link.closest('li.side-nav-item');
                    if (li) li.classList.add('active');

                    // Expand all parent .collapse and set toggles
                    let parentCollapse = link.closest('.collapse');
                    while (parentCollapse) {
                        parentCollapse.classList.add('show');

                        const parentToggle = document.querySelector(`a[href="#${parentCollapse.id}"]`);
                        if (parentToggle) {
                            parentToggle.setAttribute('aria-expanded', 'true');
                            const parentLi = parentToggle.closest('li.side-nav-item');
                            if (parentLi) parentLi.classList.add('active');
                        }

                        parentCollapse = parentCollapse.parentElement.closest('.collapse');
                    }
                }
            });
        </script>
