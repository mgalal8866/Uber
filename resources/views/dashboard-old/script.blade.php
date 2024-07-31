
<script src="{{ asset('asset/vendors/js/vendors.min.js') }}"></script>
<script src="{{ asset('asset/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('asset/vendors/js/extensions/toastr.min.js') }}"></script>
<script src="{{ asset('asset/js/core/app-menu.js') }}"></script>
<script src="{{ asset('asset/js/core/app.js') }}"></script>
<script src="{{ asset('app-assets/js/pickers/flatpickr/flatpickr.min.js') }}"></script>


@stack('alpine-plugins')

<script>
    var getUrl = window.location;
    $(".navigation a[href='" + getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1] + "/" + getUrl
        .pathname.split('/')[2] + "'] >div").addClass('active');
    $(".navigation a[href='" + window.location.href + "']").closest('li').addClass('active');

    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    });
    if (window.location.hash === "#_=_") {
        history.replaceState ?
            history.replaceState(null, null, window.location.href.split("#")[0]) :
            window.location.hash = "";
    }
</script>
@yield('js')
@stack('jslive')

