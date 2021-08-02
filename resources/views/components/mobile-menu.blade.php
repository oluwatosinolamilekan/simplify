<div class="mobile-menu md:hidden border-theme-18">
    <div class="mobile-menu-bar">
        <a href="" class="flex mr-auto">
            <x-main-logo-mobile />
        </a>
        <a href="javascript:;" id="mobile-menu-toggler"> <i data-feather="bar-chart-2" class="w-8 h-8 text-theme-18 transform -rotate-90"></i> </a>
    </div>
    <ul class="border-t border-theme-18 py-5 hidden">
        <li>
            <a href="{{ route('dashboard') }}" class="menu menu--active text-gray-600">
                <div class="menu__icon"> <i data-feather="home"></i> </div>
                <div class="menu__title">  {{ __('Dashboard') }} </div>
            </a>
        </li>
        <li>
            <a href="{{ route('users.list') }}" class="menu text-gray-600">
                <div class="menu__icon">  <x-icons.user class="side-menu-custom-icons {{request()->routeIs('users.list') ? 'active' : ''}}"></x-icons.user>  </div>
                <div class="menu__title"> {{ __('Users') }} </div>
            </a>
        </li>
        <li>
            <a href="{{ route('factors.list') }}" class="menu text-gray-600">
                <div class="menu__icon"> <i data-feather="users"></i> </div>
                <div class="menu__title"> {{ __('Factors') }} </div>
            </a>
        </li>
        <li>
            <a href="{{ route('clients.list') }}" class="menu text-gray-600">
                <div class="menu__icon"> <x-icons.client class="side-menu-custom-icons {{request()->routeIs('clients.list') ? 'active' : ''}}"></x-icons.client> </div>
                <div class="menu__title"> {{ __('Clients') }} </div>
            </a>
        </li>
        <li>
            <a href="{{ route('vendors.list') }}" class="menu text-gray-600">
                <div class="menu__icon"> <x-icons.vendor class="side-menu-custom-icons {{request()->routeIs('vendors.list') ? 'active' : ''}}"></x-icons.vendor> </div>
                <div class="menu__title"> {{ __('Vendors') }} </div>
            </a>
        </li>
        <li>
            <a href="{{ route('debtors.list') }}" class="menu text-gray-600">
                <div class="menu__icon"><x-icons.debtor class="side-menu-custom-icons {{request()->routeIs('debtors.list') ? 'active' : ''}}"></x-icons.debtor> </div>
                <div class="menu__title"> {{ __('Debtors') }} </div>
            </a>
        </li>
    </ul>
</div>
