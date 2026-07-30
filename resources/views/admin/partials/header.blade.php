<header class="app-topbar">
            <div class="container-fluid topbar-menu">
                <div class="d-flex align-items-center justify-content-center gap-2">
                    <div class="logo-topbar">
                        <a href="{{ route('admin.dashboard') }}" class="logo-dark">
                            <img src="{{ $setting?->admin_logo ? asset('storage/'.$setting?->admin_logo) : ($setting?->logo ? asset('storage/'.$setting?->logo) : asset('assets/img/logo/POSSIBLE ELECTROFEB LOGO.svg')) }}" alt="Logo" style="height: 35px; width: auto;">
                        </a>
                        <a href="{{ route('admin.dashboard') }}" class="logo-light">
                            <img src="{{ $setting?->admin_logo ? asset('storage/'.$setting?->admin_logo) : ($setting?->dark_logo ? asset('storage/'.$setting?->dark_logo) : asset('assets/img/logo/POSSIBLE ELECTROFEB LOGO.svg')) }}" alt="Logo" style="height: 35px; width: auto;">
                        </a>
                    </div>

                    <div class="d-lg-none d-flex mx-1">
                        <a href="{{ route('admin.dashboard') }}">
                            <img src="{{ $setting?->admin_mini_logo ? asset('storage/'.$setting?->admin_mini_logo) : ($setting?->logo ? asset('storage/'.$setting?->logo) : asset('assets/img/logo/POSSIBLE ELECTROFEB LOGO.svg')) }}" height="35" alt="Logo">
                        </a>
                    </div>

                    <!-- Sidebar Hover Menu Toggle Button -->
                    <button class="button-collapse-toggle d-xl-none">
                        <i data-lucide="menu" class="fs-22 align-middle"></i>
                    </button>

                </div> <!-- .d-flex-->

                <div class="d-flex align-items-center gap-2">
                    <!-- Search -->
                    <div class="app-search d-none d-xl-flex me-xl-2 position-relative dropdown">
                        <div class="position-relative w-100">
                            <input type="search" class="form-control topbar-search rounded-pill shadow-sm" style="padding-left: 40px; width: 250px;" name="search" id="global-search-input"
                                   placeholder="Search everywhere..." autocomplete="off">
                            <i class="ti ti-search fs-18 position-absolute text-muted" style="top: 50%; left: 15px; transform: translateY(-50%); pointer-events: none;"></i>
                        </div>
                        
                        <!-- Search Results Dropdown -->
                        <div id="global-search-results" class="dropdown-menu dropdown-menu-animated dropdown-menu-start w-100 mt-2 shadow-lg border-0 py-2 d-none" style="border-radius: 12px; max-height: 400px; overflow-y: auto; position: absolute; top: 100%; left: 0;">
                            <!-- Results will be injected here via AJAX -->
                        </div>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const searchInput = document.getElementById('global-search-input');
                            const searchResults = document.getElementById('global-search-results');
                            let timeout = null;

                            searchInput.addEventListener('input', function() {
                                clearTimeout(timeout);
                                const query = this.value.trim();

                                if (query.length < 2) {
                                    searchResults.innerHTML = '';
                                    searchResults.classList.add('d-none');
                                    searchResults.classList.remove('show');
                                    return;
                                }

                                timeout = setTimeout(() => {
                                    fetch(`{{ route('admin.system.search') }}?query=${encodeURIComponent(query)}`)
                                        .then(response => response.json())
                                        .then(data => {
                                            searchResults.innerHTML = '';
                                            if (Object.keys(data).length === 0) {
                                                searchResults.innerHTML = '<div class="p-3 text-center text-muted"><i class="ti ti-search-off fs-24 d-block mb-2 text-warning"></i>No results found.</div>';
                                            } else {
                                                for (const [group, items] of Object.entries(data)) {
                                                    let groupHtml = `<h6 class="dropdown-header text-uppercase fs-11 fw-bold text-primary mt-1 mb-1">${group}</h6>`;
                                                    items.forEach(item => {
                                                        let iconClass = item.icon === 'box' ? 'ti ti-package' : 
                                                                        item.icon === 'file-text' ? 'ti ti-file-text' : 
                                                                        item.icon === 'briefcase' ? 'ti ti-briefcase' : 
                                                                        item.icon === 'mail' ? 'ti ti-mail' : 'ti ti-point';
                                                        
                                                        groupHtml += `
                                                            <a href="${item.url}" class="dropdown-item d-flex align-items-center py-2 px-3 fw-medium">
                                                                <i class="${iconClass} me-2 text-muted fs-16"></i>
                                                                <span class="text-truncate" style="max-width: 200px;">${item.title}</span>
                                                            </a>
                                                        `;
                                                    });
                                                    searchResults.innerHTML += groupHtml;
                                                }
                                            }
                                            searchResults.classList.remove('d-none');
                                            searchResults.classList.add('show');
                                        });
                                }, 300);
                            });

                            // Close dropdown when clicking outside
                            document.addEventListener('click', function(e) {
                                if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
                                    searchResults.classList.add('d-none');
                                    searchResults.classList.remove('show');
                                }
                            });
                        });
                    </script>

                    <!-- Clear Cache Button -->
                    <div class="d-none d-xl-flex me-2">
                        <a href="{{ route('admin.system.clear-cache') }}" class="btn btn-sm btn-soft-primary rounded-pill d-flex align-items-center px-3 fw-semibold shadow-sm" title="Clear System Cache">
                            <i class="ti ti-bolt fs-16 me-1"></i> Clear Cache
                        </a>
                    </div>

                    <!-- User Dropdown -->
                    <div class="topbar-item nav-user">
                        <div class="dropdown">
                            <a class="topbar-link dropdown-toggle drop-arrow-none px-2" data-bs-toggle="dropdown"
                               data-bs-offset="0,13" href="#!" aria-haspopup="false" aria-expanded="false">
                                <img src="{{ Auth::user()->avatar_url }}" width="32" height="32" style="object-fit: cover;" class="rounded-circle d-flex"
                                    alt="user-image">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- Header -->
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome {{ auth()->user()->name ?? 'Admin' }}!</h6>
                                </div>

                                <!-- My Profile -->
                                <a href="{{ route('admin.profile') }}" class="dropdown-item">
                                    <i class="ti ti-user-circle me-2 fs-17 align-middle"></i>
                                    <span class="align-middle">Profile</span>
                                </a>

                                <!-- Notifications -->
                                <!-- (removed) -->
                                <!-- Divider -->

                                <!-- Lock Screen -->
                                <a href="#" onclick="event.preventDefault(); document.getElementById('lock-form').submit();" class="dropdown-item">
                                    <i class="ti ti-lock me-2 fs-17 align-middle"></i>
                                    <span class="align-middle">Lock Screen</span>
                                </a>
                                <form id="lock-form" action="{{ route('admin.lock') }}" method="POST" class="d-none">
                                    @csrf
                                </form>

                                <!-- Logout -->
                                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item text-danger fw-semibold">
                                    <i class="ti ti-logout-2 me-2 fs-17 align-middle"></i>
                                    <span class="align-middle">Log Out</span>
                                </a>
                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </header>
