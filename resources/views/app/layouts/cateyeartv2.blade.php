<!DOCTYPE html>
<html lang="en" style="font-size:38.333333333333336px !important">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />

    <link rel="stylesheet" type="text/css" href="https://cdn.bootcss.com/light7/0.4.3/css/light7.min.css">
    <link rel="stylesheet" type="text/css" href="/cateyeart/fonts/iconfont.css">
    <link rel="stylesheet" type="text/css" href="{{ mix('cateyeart/v2/css/style.css') }}">
    @yield('style')

</head>
<body>
<!-- 弹出 -->
<div class="home-mask">
    <a href="{{route('member_work_add')}}" style="width: 30%">
        <img src="/cateyeart/v2/images/t_05.jpg" alt="" >
        <p>作品</p>
    </a>
    {{--<a href="{{route('member_album_add')}}">--}}
        {{--<img src="/cateyeart/v2/images/t_07.jpg" alt="">--}}
        {{--<p>作品集</p>--}}
    {{--</a>--}}
    <a href="{{route('member_content_add')}}" style="width: 30%;float: right">
        <img src="/cateyeart/v2/images/t_03.jpg" alt="">
        <p>文章</p>
    </a>
    <span class="hclose"></span>
</div>

@yield('content')

@yield('footer')
{{--<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>--}}
<script src="https://cdn.bootcss.com/jquery/2.0.1/jquery.min.js"></script>
<script src="/cateyeart/js/light7.js?20170925"></script>
<script>
    $.config = {
        router:false
    }
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

    new function (){
        var _self = this;
        _self.width = 1080;
        _self.fontSize = 100;
        _self.widthProportion = function(){var p = (document.body&&document.body.clientWidth||document.getElementsByTagName("html")[0].offsetWidth)/_self.width;return p>1?1:p<0.32?0.32:p;};
        _self.changePage = function(){
            document.getElementsByTagName("html")[0].setAttribute("style","font-size:"+_self.widthProportion()*_self.fontSize+"px !important");
        }
        _self.changePage();
        window.addEventListener('resize',function(){_self.changePage();},false);
    };

</script>

@yield('scripts')
</body>
</html>