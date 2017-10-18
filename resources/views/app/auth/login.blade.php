@extends('app.layouts.cateyeart')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ mix('cateyeart/css/auth.css') }}?2017062311">
@endsection
@section('title', '登录')
@section('body-style', 'login-body')

@section('content')
<div class="page-group">
    <div class="page page-current">
        <header class="bar bar-nav">
            <a class="button button-link button-nav pull-left back" href="/"></a>
            <h1 class="title">登录</h1></header>
        <div class="content login-content">
            <section class="floorbox">
                <form action="{{route('api_login')}}" class="sectionbox login ajax-form">
                    {{csrf_field()}}
                    <input name="backurl" value="{{$backurl}}" type="hidden">
                    <div class="item-content">
                        <div class="item-inner">
                            <div class="item-input">
                                <input type="text" class="mobile" name="mobile" placeholder="手机号/邮箱"></div>
                        </div>
                    </div>
                    <div class="item-content">
                        <div class="item-inner">
                            <div class="item-input">
                                <input type="password" class="password" name="password" placeholder="密码"></div>
                            <div class="item-title label">
                                <a href="{{route('forgot_password')}}" class="item-btn">忘记密码?</a></div>
                        </div>
                    </div>
                    <div class="item-content safe-box" style="display: none">
                        <div class="item-inner">
                            <div class="item-input">
                                <input placeholder="请输入右侧验证码" type="text" class="verify" name="captcha"></div>
                            <div class="item-title label">
                                <a href="javascript:;" class="item-img">
                                    <img data-src="{{captcha_src()}}" src="{{captcha_src()}}" class="btn-fresh">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="item-content">
                        <button type="submit" class="complete-btn btn-submit">登录</button></div>
                    <div class="item-btn-link">
                        <span>没有帐号？</span>
                        <a href="{{route('signup')}}" class="link-green">立即注册</a></div>
                </form>
                {{--<div class="actions-share-box">--}}
                    {{--<a href="javascript:" class="share-icon-1 icon"></a>--}}
                    {{--<a href="javascript:" class="share-icon-2 icon"></a>--}}
                    {{--<a href="javascript:" class="share-icon-4 icon"></a>--}}
                {{--</div>--}}
            </section>

            @include('app.auth.footer')
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ mix('cateyeart/js/app.js') }}"></script>
    <script>
        $form = $('form.login'),
                $share = $('.actions-share-box'),
                $btn_submit = $('.btn-submit', $form),
                $input = $('input.mobile,input.password');

        $input.on('input',
                function(ev) {
                    var values = $.map($input,
                            function(el) {
                                var val = $(el).val();
                                return val.length ? val: null;
                            })
                    $btn_submit.toggleClass('focus', values.length > 0);
                })
        $input.trigger('input');
        $input.on('focus',
            function() {
                $share.hide();
        }).on('blur',
            function() {
                $share.show();
        })
    </script>
@endsection