<!-- BEGIN: Side Menu -->
<nav class="side-nav">
    <a href="" class="intro-x flex items-center pl-5 pt-3">
        <x-main-logo />
    </a>
    <div class="side-nav__devider my-6 bg-gray-500"></div>
    <ul>
        <li>
            <a href="{{ route('dashboard') }}" class="side-menu {{request()->routeIs('dashboard') ? 'side-menu--active' : ''}}">
                <div class="side-menu__icon"> <i data-feather="home"></i> </div>
                <div class="side-menu__title">
                    {{ __('Dashboard') }}
                </div>
            </a>
        </li>
        <li>
            <a href="{{ route('users.list') }}" class="side-menu {{request()->routeIs('users.list') ? 'side-menu--active' : ''}}">
                <div class="side-menu__icon"> <i data-feather="users"></i> </div>
                <div class="side-menu__title">
                    {{ __('Users') }}
                </div>
            </a>
        </li>
    </ul>
</nav>
<!-- END: Side Menu -->
