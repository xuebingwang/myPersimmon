@extends('app.layouts.cateyeart')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ mix('cateyeart/css/member.css') }}?2017062311">
@endsection
@section('title', '个人中心-设置')
@section('body-style', 'site-body')

@section('content')
    <div class="page-group">
        <div class="page page-current">
            <div class="content native-scroll">
                <header class="bar bar-nav">
                    <a class="button button-link button-nav pull-left back" href="/"></a>
                    <h1 class="title">设置</h1></header>
                <div class="content native-scroll site-content site-li-content">
                    <div class="list-block site-li-block">
                        <ul class="f8 margin-bottom-12">
                            <li>
                                <a href="{{route('member_info')}}" class="item-link item-content">
                                    <div class="item-inner">
                                        <div class="item-title">个人资料</div></div>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('member_password')}}" class="item-link item-content">
                                    <div class="item-inner">
                                        <div class="item-title">修改密码</div></div>
                                </a>
                            </li>
                        </ul>
                        <ul class="f8 margin-bottom-12">
                            <li>
                                <a href="{{route('member_privacy')}}" class="item-link item-content">
                                    <div class="item-inner">
                                        <div class="item-title">隐私</div></div>
                                </a>
                            </li>
                        </ul>
                        {{--<ul class="f8 margin-bottom-12">--}}
                            {{--<li>--}}
                                {{--<div class="item-content">--}}
                                    {{--<div class="item-inner item-inner-right">--}}
                                        {{--<div class="item-title label">语言</div>--}}
                                        {{--<div class="item-input">--}}
                                            {{--<div class="item-input">--}}
                                                {{--<select class="lange">--}}
                                                    {{--<option value="zh-cn" selected="selected" class="zh-cn">简体中文</option>--}}
                                                    {{--<option value="zh-tw" class="zh-tw">繁体中文</option>--}}
                                                    {{--<option value="en-us" class="en-us">English</option></select>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                        <ul class="f8 margin-bottom-12 out-ul">
                            <li>
                                <a href="{{route('logout')}}" class="item-link item-content">
                                    <div class="item-inner">
                                        <div class="item-title">退出登录</div></div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection