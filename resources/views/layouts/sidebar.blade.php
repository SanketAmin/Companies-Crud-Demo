<div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg" style="height: 100vh;">
    <div class="sidebar-content">
        <div class="sidebar-section">
            <ul class="nav nav-sidebar" data-nav-type="accordion">
                <li class="nav-item">
                    <a href="{{route('dashboard')}}" class="nav-link {{ Ekko::isActive(['/', '/dashboard']) }}">
                        <i class="ph-house"></i>
                        <span> Dashboard </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('companies.index')}}" class="nav-link {{ Ekko::isActiveRoute('companies.*') }}">
                        <i class="ph-users"></i>
                        <span> Companies </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
