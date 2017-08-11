<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="format-detection" content="telephone=no" />
    <meta id="viewport" name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <link rel="stylesheet" type="text/css" href="{{ mix('cateyeart/css/style.css') }}?2017062311">
    @yield('style')
</head>

<body class="@yield('body-style')">

@yield('content')
<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>

<script src="/cateyeart/js/light7.js?20170715"></script>
<script>
    $.config = {
        router:false
    }
</script>
<script>
    window.cat = {};
    cat.csrf_token = '{{csrf_token()}}';
    cat.sms_route_prefix = '{{config('laravel-sms.routeAttributes.prefix')}}';
    cat.cdn_domain = '{{cdn('')}}';

    var errors = '<?=implode('<br>',$errors->all())?>';

    if(errors != ''){
        $.error(errors);
    }

    var message = '<?=session('message')?>';

    if(message != ''){
        $.success(message);
    }
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN' : cat.csrf_token }
    });
</script>

@yield('scripts')

</body>

</html>