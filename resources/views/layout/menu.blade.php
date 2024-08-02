<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="#" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src = "{{ asset('logo.svg') }}" width="32" />


            </span>
            <span class="app-brand-text demo menu-text fw-bold">Uber Women</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Page -->
        <li class="menu-item {{ Route::is('dashboard*') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div data-i18n="Page 1">{{ __('trans.dashboard') }}</div>
            </a>
        </li>
        <li class="menu-item {{ Route::is('category*') ? 'active' : '' }}">
            <a href="{{ route('category.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div data-i18n="Page 1">{{ __('trans.category') }}</div>
            </a>
        </li>
        <li class="menu-item {{ Route::is('users*') ? 'active' : '' }}">
            <a href="{{ route('users.index') }}" class="menu-link ">
                <i class="menu-icon tf-icons ti ti-app-window"></i>
                <div data-i18n="Page 2">{{ __('trans.users') }}</div>
            </a>
        </li>
        <li class="menu-item {{ Route::is('drivers*') ? 'active' : '' }}">
            <a href="{{ route('drivers.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-app-window"></i>
                <div data-i18n="Page 2">{{ __('trans.drivers') }}</div>
            </a>
        </li>
        <li class="menu-item {{ Route::is('trips*') ? 'active' : '' }}">
            <a href="{{ route('trips.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-app-window"></i>
                <div data-i18n="Page 2">{{ __('trans.trips') }}</div>
            </a>
        </li>
        <li class="menu-item  {{ Route::is('roles*') ||  Route::is('permissions*') ? 'open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons ti ti-settings"></i>
              <div>{{ __('trans.roles&permissions') }}</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item {{ Route::is('roles*') ? 'active' : '' }}">
                <a href="{{ route('roles.list') }}" class="menu-link">
                  <div >{{ __('trans.roles') }}</div>
                </a>
              </li>
              <li class="menu-item {{ Route::is('permissions*') ? 'active' : '' }}">
                <a href="{{ route('permissions.list') }}" class="menu-link">
                  <div >{{ __('trans.permissions') }}</div>
                </a>
              </li>
            </ul>
          </li>
        {{-- <li class="menu-item {{ Route::is('trips*') ? 'active' : '' }}">
            <a href="{{ route('trips.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-app-window"></i>
                <div data-i18n="Page 2">{{ __('trans.roles&permissions') }}</div>
            </a>
        </li> --}}
        <li class="menu-item {{ Route::is('settings*') ? 'active' : '' }}">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons ti ti-app-window"></i>
                <div data-i18n="Page 2">{{ __('trans.settings') }}</div>
            </a>
        </li>
    </ul>
</aside>
