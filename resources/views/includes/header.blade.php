@php use Illuminate\Support\Facades\Auth; @endphp
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand mx-auto" href="{{ route('home') }}">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                @guest
                    <li class="nav-item">
                        <a class="nav-link {{ mark_route('login') }}" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ mark_route('register') }}"
                           href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @else
                    @if(Auth::user()->role == 'admin')
                        <li class="nav-item me-2">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-terminal"></i>
                                {{ __('Dashboard') }}
                            </a>
                        </li>
                    @endif
                    <li class="nav-item me-2">
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
                            {{ Auth::user()->name }}
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
                @endguest
            </ul>
        </div>
    </div>
</nav>
