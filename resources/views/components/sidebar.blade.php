<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
                <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                        fill="#7367F0" />
                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                        d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z" fill="#161616" />
                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                        d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z" fill="#161616" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                        fill="#7367F0" />
                </svg>
            </span>
            <span class="app-brand-text demo menu-text fw-bold">{{ trans('panel.site_title') }}</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <li class="menu-item {{ request()->is('admin') ? 'active' : '' }}">
            <a href="{{ route('admin.home') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div>{{ trans('global.dashboard') }}</div>
            </a>
        </li>
        <!-- Layouts -->
        <li class="menu-item menu-item {{ request()->is('admin/admins*') || request()->is('admin/roles*') || request()->is('admin/audit-logs*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-users"></i>
                <div data-i18n="Layouts">{{ trans('cruds.admin.title') }}</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item {{ request()->is('admin/admins') ? 'active' : '' }}">
                    <a href="{{ route('admin.admins.index') }}" class="menu-link">
                        <div data-i18n="Collapsed menu">{{ __('global.list') }}</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('admin/admins/create') ? 'active' : '' }}">
                    <a href="{{ route('admin.admins.create') }}" class="menu-link">
                        <div data-i18n="Content navbar">{{ __('global.create') }}</div>
                    </a>
                </li>
                @can('role_access')
                    <li class="menu-item {{ request()->is('admin/roles*') ? 'active' : 'sidebar-nav' }}">
                        <a class="menu-link"
                            href="{{ route('admin.roles.index') }}">
                            <i class="fa-fw c-sidebar-nav-icon fas fa-briefcase">
                            </i>
                            {{ trans('cruds.role.title') }}
                        </a>
                    </li>
                @endcan
               
                @can('audit_log_access')
                    <li class="menu-item {{ request()->is('admin/audit-logs*') ? 'active' : '' }}">
                        <a class="menu-link"
                            href="{{ route('admin.audit-logs.index') }}">
                            <i class="fa-fw c-sidebar-nav-icon fas fa-file-alt">
                            </i>
                            {{ trans('cruds.auditLog.title') }}
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
        <li class="menu-item menu-item {{ request()->is('admin/users*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-users"></i>
                <div data-i18n="Layouts">{{ trans('cruds.user.title') }}</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item {{ request()->is('admin/users') ? 'active' : '' }}">
                    <a href="{{ route('admin.users.index') }}" class="menu-link">
                        <div data-i18n="Collapsed menu">{{ __('global.list') }}</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('admin/users/create') ? 'active' : '' }}">
                    <a href="{{ route('admin.users.create') }}" class="menu-link">
                        <div data-i18n="Content navbar">{{ __('global.create') }}</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item menu-item {{ request()->is('admin/drivers*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-users"></i>
                <div data-i18n="Layouts">{{ trans('cruds.driver.title') }}</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item {{ request()->is('admin/drivers') ? 'active' : '' }}">
                    <a href="{{ route('admin.drivers.index') }}" class="menu-link">
                        <div data-i18n="Collapsed menu">{{ __('cruds.driver.list_all') }}</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('admin/drivers/activated') ? 'active' : '' }}">
                    <a href="{{ route('admin.drivers.index') }}" class="menu-link">
                        <div data-i18n="Collapsed menu">{{ __('cruds.driver.activated') }}</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('admin/drivers/deactivated') ? 'active' : '' }}">
                    <a href="{{ route('admin.drivers.index') }}" class="menu-link">
                        <div data-i18n="Collapsed menu">{{ __('cruds.driver.deactivated') }}</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('admin/drivers/create') ? 'active' : '' }}">
                    <a href="{{ route('admin.drivers.create') }}" class="menu-link">
                        <div data-i18n="Content navbar">{{ __('global.create') }}</div>
                    </a>
                </li>
            </ul>
        </li>
        @can('service_access')
        <li class="menu-item menu-item {{ request()->is('admin/services*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-car"></i>
                <div data-i18n="Layouts">{{ trans('cruds.service.title') }}</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->is('admin/services') ? 'active' : '' }}">
                    <a href="{{ route('admin.services.index') }}" class="menu-link">
                        <div data-i18n="Collapsed menu">{{ __('global.list') }}</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('admin/services/create') ? 'active' : '' }}">
                    <a href="{{ route('admin.services.create') }}" class="menu-link">
                        <div data-i18n="Content navbar">{{ __('global.create') }}</div>
                    </a>
                </li>
               
            </ul>
        </li>
        @endcan
        @can('setting_access')
        <li class="menu-item {{ request()->is('admin/settings*') ? 'active' : '' }}">
            <a href="{{ route('admin.settings.index', 1) }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-settings"></i>
                <div>{{ trans('global.settings') }}</div>
            </a>
        </li>
        @endcan
        <li class="menu-item {{ request()->is('admin/countries*') ? 'active' : '' }}">
            <a href="{{ route('admin.countries.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-flag"></i>
                <div>{{ trans('app.countries') }}</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('admin/cities*') ? 'active' : '' }}">
            <a href="{{ route('admin.cities.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-building"></i>
                <div>{{ trans('app.cities') }}</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('admin/payment-methods*') ? 'active' : '' }}">
            <a href="{{ route('admin.payment-methods.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-cash"></i>
                <div>{{ trans('app.payment_methods') }}</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('admin/vehicle-types*') ? 'active' : '' }}">
            <a href="{{ route('admin.vehicle-types.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-car-garage"></i>
                <div>{{ trans('app.vehicle_types') }}</div>
            </a>
        </li>



        
        @can('freight_vehicle_access')
        <li class="menu-item menu-item {{ request()->is('admin/freight-vehicles*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-car"></i>
                <div data-i18n="Layouts">{{ trans('cruds.freightVehicle.title') }}</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->is('admin/freight-vehicles') ? 'active' : '' }}">
                    <a href="{{ route('admin.freight-vehicles.index') }}" class="menu-link">
                        <div data-i18n="Collapsed menu">{{ __('global.list') }}</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('admin/freight-vehicles/create') ? 'active' : '' }}">
                    <a href="{{ route('admin.freight-vehicles.create') }}" class="menu-link">
                        <div data-i18n="Content navbar">{{ __('global.create') }}</div>
                    </a>
                </li>
               
            </ul>
        </li>
        @endcan
    </ul>
</aside>


{{-- 

              
                @can('airport_access')
                    <li class="items-center">
                        <a class="{{ request()->is("admin/airports*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.airports.index") }}">
                            <i class="fa-fw c-sidebar-nav-icon fas fa-plane">
                            </i>
                            {{ trans('cruds.airport.title') }}
                        </a>
                    </li>
                @endcan
                
                @can('chat_access')
                    <li class="items-center">
                        <a class="{{ request()->is("admin/chats*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.chats.index") }}">
                            <i class="fa-fw c-sidebar-nav-icon fas fa-cogs">
                            </i>
                            {{ trans('cruds.chat.title') }}
                        </a>
                    </li>
                @endcan
                            @can('faq_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/faqs*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.faqs.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-cogs">
                                        </i>
                                        {{ trans('cruds.faq.title') }}
                                    </a>
                                </li>
                            @endcan
                    </li>
                @endcan
                @can('orders_m_access')
                    <li class="items-center">
                        <a class="has-sub {{ request()->is("admin/orders*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="#" onclick="window.openSubNav(this)">
                            <i class="fa-fw fas c-sidebar-nav-icon fa-cogs">
                            </i>
                            {{ trans('cruds.ordersM.title') }}
                        </a>
                        <ul class="ml-4 subnav hidden">
                            @can('order_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/orders*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.orders.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fab fa-first-order-alt">
                                        </i>
                                        {{ trans('cruds.order.title') }}
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
            </ul>
        </div>
    </div>
</nav> --}}
