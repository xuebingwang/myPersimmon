@extends('app.layouts.cateyeart')

@section('title', '找回密码')
@section('body-style', 'login-body')

@section('content')
    <div class="page-group">
        <div class="page page-current">
            <header class="bar bar-nav">
                <a class="button button-link button-nav pull-left back"></a>
                <h1 class="title">找回密码</h1></header>
            <div class="content login-content native-scroll">
                <section class="floorbox">
                    <form class="sectionbox mobile">
                        <div class="item-content">
                            <div class="item-inner">
                                <div class="item-input">
                                    <input type="text" class="mobile" name="mobile" placeholder="请输入手机号码"></div>
                            </div>
                        </div>
                        <div class="item-content safe-box">
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
                            <div class="item-inner">
                                <div class="item-input">
                                    <input type="number" class="sms" name="sms" maxlength="6" placeholder="请输入短信验证码"></div>
                                <div class="item-title label">
                                    <a href="javascript:;" class="item-btn btn-sms">获取验证码</a></div>
                            </div>
                        </div>
                        <div class="item-content padding-bottom-8 ">
                            <a href="javascript:;" class="complete-btn btn-send">修改密码</a>
                            <p class="Get-p">如需求助工作人员，请发送邮件至
                                <a href="mailto:huapinhua@126.com">huapinhua@126.com</a></p>
                        </div>
                    </form>
                </section>


                @include('app.auth.footer')
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection