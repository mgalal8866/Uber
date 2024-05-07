<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

@include('layouts.dashboard.head')
<meta name="csrf-token" content="{{ csrf_token() }}">

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click"
    data-menu="vertical-menu-modern" data-col="">


    @include('layouts.dashboard.nav')

    @include('layouts.dashboard.menu')

    <div class="app-content content file-manager-application">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>


                @yield('content')
                @isset($slot)
                    {{ $slot }}
                @endisset
            </div>
        {{-- </div> --}}

        <div class="sidenav-overlay"></div>
        {{-- <div class="drag-target"></div> --}}
        @include('layouts.dashboard.footer')

        @include('layouts.dashboard.script')
        {{-- @livewire('livewire-ui-modal') --}}
</body>

</html>
