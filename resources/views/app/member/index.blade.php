@extends('app.layouts.cateyeart')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ mix('cateyeart/css/member.css') }}?2017062311">
@endsection
@section('title', '个人中心')
@section('body-style', 'mine-body')

@section('content')
    <div class="page-group">
        <div class="page page-current">

            @include('app.common.nav')

            <?php
                $home_page = isset($member->domain) ? ('/'.$member->domain) : route('php',$member->id);
            ?>
            <div class="content native-scroll site-content site-li-content">
                <div class="list-block site-li-block">
                    <ul class="margin-bottom-12 identity">
                        <li>
                            <div class="item-inner">
                                <div class="item-title">
                                    <div class="row no-gutter">
                                        <div class="col-30">
                                            <a href="{{$home_page}}" class="item-link item-content">
                                                <div class="artistPhoto">
                                                    <img class="photo" src="{{$member->avatar}}?imageView2/1/w/80/h/80/q/75|imageslim"></div>
                                            </a>
                                        </div>
                                        <div class="col-70 col-itme col-sq">
                                            <div class="item-name clearfix">
                                                <a href="{{$home_page}}" class="name-btn">{{$member->name}}</a>
                                            </div>
                                            @if (empty($member->is_verfiy))
                                            <div class="shenq-warp">
                                                <a href="{{route('member_verify')}}" class="shenq">申请认证</a>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <a class="item-after" href="{{route('member_info')}}">个人资料</a>
                            </div>
                        </li>
                        <li>
                            <div class="item-buttons-tab">
                                <div class="item-btab">
                                    <a href="{{route('member_msg_info',0)}}" class="buttonsi">
                                        <span class="icon icon-b1"></span>
                                        <span class="label-text">客服消息</span>
                                        <span class="prompt num_notice">1</span></a>
                                </div>
                                {{--<div class="item-btab">--}}
                                    {{--<a href="/stats" class="buttonsi stats">--}}
                                        {{--<span class="icon icon-b2"></span>--}}
                                        {{--<span class="label-text">统计</span></a>--}}
                                {{--</div>--}}
                                <div class="item-btab">
                                    <a href="{{route('member_contacts_friend')}}" class="buttonsi">
                                        <span class="icon icon-b3"></span>
                                        <span class="label-text">联系人</span>
                                        {{--<span class="prompt num_fans">1</span>--}}
                                    </a>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <ul class="f8 margin-bottom-12">
                        <li>
                            <a href="{{$home_page}}" class="item-link item-content">
                                <div class="item-inner">
                                    <div class="item-title">我的主页</div></div>
                            </a>
                        </li>
                    </ul>
                    {{--<ul class="f8 margin-bottom-12">--}}
                        {{--<li>--}}
                            {{--<a href="/order/index?type=buy" class="item-link item-content">--}}
                                {{--<div class="item-inner">--}}
                                    {{--<div class="item-title">我购买的</div></div>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="/order/index?type=sale" class="item-link item-content">--}}
                                {{--<div class="item-inner">--}}
                                    {{--<div class="item-title">我出售的</div></div>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                    {{--<ul class="f8 margin-bottom-12">--}}
                        {{--<li>--}}
                            {{--<a href="/setting/wallet" class="item-link item-content">--}}
                                {{--<div class="item-inner">--}}
                                    {{--<div class="item-title">钱包</div></div>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                    {{--</ul>--}}

                    @if (empty($member->is_verfiy))
                    <ul class="f8 margin-bottom-12">
                        <li>
                            <a href="{{route('member_verify')}}" class="item-link item-content">
                                <div class="item-inner">
                                    <div class="item-title">申请猫眼艺术认证艺术家
                                        <span class="approve approve-yellow"></span></div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    @endif
                    <ul class="f8 margin-bottom-12">
                        <li>
                            <a href="{{route('member_setting')}}" class="item-link item-content">
                                <div class="item-inner">
                                <div class="item-title">设置</div></div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection