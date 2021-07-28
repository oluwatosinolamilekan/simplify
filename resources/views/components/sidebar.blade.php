<!-- BEGIN: Side Menu -->
<nav class="side-nav">
    <a href="" class="intro-x flex items-center pl-5 pt-3 main-logo">
        <x-main-logo />
    </a>
    <a href="" class="intro-x flex items-center pl-5 pt-3 main-logo-dark">
        <x-jet-authentication-card-logo />
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
            <a href="{{ route('users.list') }}" id="sidebar_users_list" class="side-menu {{request()->routeIs('users.list') ? 'side-menu--active' : ''}}">
                <div class="side-menu__icon">  <x-icons.user class="side-menu-custom-icons {{request()->routeIs('users.list') ? 'active' : ''}}"></x-icons.user>  </div>
                <div class="side-menu__title">
                    {{ __('Users') }}
                </div>
            </a>
        </li>
        <li>
            <a href="{{ route('factors.list') }}" id="sidebar_factors_list" class="side-menu {{request()->routeIs('factors.list') ? 'side-menu--active' : ''}}">
                <div class="side-menu__icon"> <i data-feather="users"></i> </div>
                <div class="side-menu__title">
                    {{ __('Factors') }}
                </div>
            </a>
        </li>
        <li>
            <a href="{{ route('clients.list') }}" class="side-menu {{request()->routeIs('clients.list') ? 'side-menu--active' : ''}}">
                <div class="side-menu__icon"> <x-icons.client class="side-menu-custom-icons {{request()->routeIs('clients.list') ? 'active' : ''}}"></x-icons.client> </div>
                <div class="side-menu__title">
                    {{ __('Clients') }}
                </div>
            </a>
        </li>
        <li>
            <a href="{{ route('vendors.list') }}" class="side-menu {{request()->routeIs('vendors.list') ? 'side-menu--active' : ''}}">
                <div class="side-menu__icon"> <x-icons.vendor class="side-menu-custom-icons {{request()->routeIs('vendors.list') ? 'active' : ''}}"></x-icons.vendor> </div>
                <div class="side-menu__title">
                    {{ __('Vendors') }}
                </div>
            </a>
        </li>
        <li>
            <a href="{{ route('debtors.list') }}" class="side-menu {{request()->routeIs('debtors.list') ? 'side-menu--active' : ''}}">
                <div class="side-menu__icon"><x-icons.debtor class="side-menu-custom-icons {{request()->routeIs('debtors.list') ? 'active' : ''}}"></x-icons.debtor> </div>
                <div class="side-menu__title">
                    {{ __('Debtors') }}
                </div>
            </a>
        </li>
    </ul>
</nav>
<!-- END: Side Menu -->
