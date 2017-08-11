@extends('app.layouts.cateyeart')

@section('title', '注册')

@section('style')
<link rel="stylesheet" type="text/css" href="{{ mix('cateyeart/css/auth.css') }}?2017062311">
@endsection

@section('body-style', 'login-body')

@section('content')
    <div class="page-group">
        <div class="page page-current">
            <header class="bar bar-nav">
                <a class="button button-link button-nav pull-left back" href="/"></a>
                <h1 class="title">注册</h1></header>
            <div class="content reg-content native-scroll" id="page-action">
                <section class="floorbox">
                    <form class="sectionbox signup ajax-form" action="{{route('api_signup')}}">

                        <div class="item-content">
                            <div class="item-inner">
                                <div class="item-input">
                                    <input type="number" placeholder="手机号码" class="mobile" name="mobile"></div>
                            </div>
                        </div>
                        <div class="item-content safe-box">
                            <div class="item-inner">
                                <div class="item-input">
                                    <input placeholder="请输入右侧验证码" type="text" class="verify" name="captcha"></div>
                                <div class="item-title label">
                                    <a href="javascript:;" class="item-img">
                                        <img src="{{captcha_src()}}" class="btn-fresh">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="item-content">
                            <div class="item-inner">
                                <div class="item-input">
                                    <input type="number" placeholder="请输入手机验证码" class="sms" name="verify_code" maxlength="6">
                                </div>
                                <div class="item-title label">
                                    <a id="reg-send-sms" href="javascript:;" class="item-btn btn-sms">获取验证码</a>
                                </div>
                            </div>
                        </div>

                        <div class="item-content">
                            <div class="item-inner">
                                <div class="item-input">
                                    <input type="password" placeholder="登录密码" class="password" name="password"></div>
                            </div>
                        </div>
                        <div class="item-content">
                            <button type="submit" class="complete-btn btn-submit">提交</button>
                        </div>
                        <div class="item-btn-link">
                            <span>有帐号了？</span>
                            <a href="{{route('login')}}" class="link-green">请登录</a></div>
                    </form>
                </section>

                @include('app.auth.footer')
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ mix('cateyeart/js/app.js') }}?20170623"></script>
@endsection