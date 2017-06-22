<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="format-detection" content="telephone=no" />
    <meta id="viewport" name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm.min.css">
    <link rel="stylesheet" type="text/css" href="{{ mix('cateyeart/css/style.css') }}?1">
</head>

<body class="@yield('body-style')">
@yield('content')

<script type='text/javascript' src='//g.alicdn.com/sj/lib/zepto/zepto.min.js' charset='utf-8'></script>
<script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script>
<script>
    window.cat = window.Zepto = Zepto;
    cat.toast2 = function(msg, duration, extraclass, callback) {
        var classs = {
            success: 'p-success',
            error: 'p-failure',
        }
        extraclass = classs[extraclass] || 'p-success';
        var $toast = $('<div class="modal toast toast-prompt ' + (extraclass || '') + '"><div class="toast-icon"></div><p>' + msg + '</p></div>').appendTo(document.body);
        cat.openModal($toast,
            function() {
                setTimeout(function() {
                        $.closeModal($toast);
                        if(typeof callback == 'function'){
                            callback.call();
                        }
                    },
                    duration || 2000);
            });
    };
    cat.error = function(msg, duration, callback) {
        if (typeof duration == 'function') {
            callback = duration;
            duration = 1500;
        }
        return cat.toast2(msg, duration, 'error', callback);
    };
    cat.success = function(msg, duration, callback) {
        if (typeof duration == 'function') {
            callback = duration;
            duration = 1500;
        }
        return cat.toast2(msg, duration, 'success', callback);
    }
    cat.csrf_token = '{{csrf_token()}}';

    cat.sms_route_prefix = '{{config('laravel-sms.routeAttributes.prefix')}}';

    cat.errors = '<?=implode('<br>',$errors->all())?>';

    if(cat.errors != ''){
        cat.error(cat.errors);
    }
</script>

@yield('scripts')

</body>

</html>