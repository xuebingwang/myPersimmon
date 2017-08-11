@extends('app.layouts.cateyeart')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ mix('cateyeart/css/member.css') }}?2017062311">
@endsection
@section('title', '个人中心-修改密码')
@section('body-style', 'site-body')

@section('content')
    <div class="page-group">
        <div class="page page-current">
            <div class="content native-scroll">
                <form action="{{route('api_member_password')}}" class="content native-scroll site-content alter-password-content ajax-form" id="password">
                    <div class="alter-password-box">
                        <div class="password-item-input">
                            <input type="password" class="oldpwd" name="old" placeholder="输入旧密码" autocomplete="off"></div>
                        <div class="password-item-input">
                            <input type="password" class="newpwd" name="new" placeholder="输入新密码" autocomplete="off"></div>
                        <div class="password-item-input">
                            <input type="password" class="confirm" name="confirm" placeholder="确认新密码" autocomplete="off"></div>
                        <input type="hidden" name="token" value="">
                        <div class="password-item-input">
                            <button type="submit" class="complete-btn btn-submit">完成</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ mix('cateyeart/js/app.js') }}?20170623"></script>
@endsection