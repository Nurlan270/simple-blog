<div class="min-vh-100 bg-dark">
    <ul class="sidebar navbar-nav flex-column sticky-top">
        <li class="nav-item">
            <a class="nav-link {{ mark_route('admin.dashboard*') }}" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-reception-4 me-2"></i>
                {{ __('Dashboard') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ mark_route('admin.users*') }}" href="{{ route('admin.users.index') }}">
                <i class="bi bi-people-fill me-2"></i>
                {{ __('Users') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ mark_route('admin.posts*') }}" href="{{ route('admin.posts.index') }}">
                <i class="bi bi-card-heading me-2"></i>
                {{ __('Posts') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#comments">
                <i class="bi bi-chat-left-text-fill me-2"></i>
                {{ __('Comments') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#settings">
                <i class="bi bi-gear-fill me-2"></i>
                {{ __('Settings') }}
            </a>
        </li>
    </ul>
</div>
