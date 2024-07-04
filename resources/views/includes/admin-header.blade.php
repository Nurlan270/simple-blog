<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand mx-auto" href="{{ route('admin.dashboard') }}">
            <i class="bi bi-shield-shaded"></i>
            Admin panel
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ mark_route('user.posts.create') }}"
                           href="{{ route('home') }}">
                            <i class="bi bi-house"></i>
                            {{ __('Home') }}
                        </a>
                    </li>
                <li class="nav-item">
                        <a class="nav-link {{ mark_route('user.posts.create') }}"
                           href="{{ route('user.posts.create') }}">
                            <i class="bi bi-plus-circle"></i>
                            {{ __('Create Post') }}
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ mark_route('account*') }}" href="#" id="navbarDropdown"
                           role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-person"></i>
                            {{ \Illuminate\Support\Facades\Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item {{ mark_route('account*') }}" href="{{ route('account.panel') }}">
                                <i class="bi bi-person-fill-gear pe-2"></i>
                                {{ __('Account Panel') }}
                            </a>
                            <a class="dropdown-item {{ mark_route('user.posts*') }}"
                               href="{{ route('user.posts.index') }}">
                                <i class="bi bi-file-post pe-2"></i>
                                {{ __('My posts') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}">
                                <i class="bi bi-box-arrow-right pe-2"></i>
                                {{ __('Logout') }}
                            </a>
                        </div>
                    </li>
            </ul>
        </div>
    </div>
</nav>
