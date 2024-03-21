<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>E-CODEC</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Sistem Informasi Report HARSIS (SIMHARSIS)" />
    <meta name="keywords" content="SIMHARSIS">
    <meta name="author" content="MozesJR" />
    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/background.css') }}" />

</head>

@yield('auth')

{{-- Buat Bot --}}
{{-- <div id="ChitchatWidget"></div>
<script src="https://widget.eva.id/js/fg.js?v=VSI1.2"></script>
<script language="javascript">
    var set = new Array();
    set["c_project"] = "167834243227437210";
    set["c_button_float_bg"] = "#3a67c9";
    set["c_button_float_title"] = "";
    set["c_float_bg"] = "#3a67c9";
    set["c_float_title"] = "Bot HARSIS";
    set["c_float_title_color"] = "#ffffff";
    set["c_float_image"] = "https://dashboard.eva.id/uploads/20230309061605541711.png";
    (function(i, s, o, g, r, a, m) {
        i["chitchat"] = r;
        i[r] = i[r] || function() {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o), m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, "script", "https://widget.eva.id/js/eva_lite.js?v=1.087", set)
</script> --}}

<script src="{{ asset('assets/js/vendor-all.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/ripple.js') }}"></script>
<script src="{{ asset('assets/js/pcoded.min.js') }}"></script>
</body>

</html>
