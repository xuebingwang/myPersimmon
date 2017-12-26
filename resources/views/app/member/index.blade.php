@extends('app.layouts.cateyeart')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ mix('cateyeart/css/member.css') }}?2017062311">
    <link rel="stylesheet" type="text/css" href="http://mall.cateyeart.com/addons/ewei_shopv2/static/js/dist/foxui/css/foxui.min.css?v=0.2">
    <style>
        .list-block .margin-bottom-12 {
            margin-bottom:0;
        }
    </style>
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
            <div class="content native-scroll site-content site-li-content" style="padding-bottom: 2.7rem;">
                <div class="list-block site-li-block">
                    <ul class="margin-bottom-12 identity">
                        <li>
                            <div class="item-inner">
                                <div class="item-title">
                                    <div class="row no-gutter">
                                        <div class="col-30" style="width: 32%">
                                            <a href="{{$home_page}}" class="item-link item-content">
                                                <div class="artistPhoto">
                                                    <img class="photo" src="{{$member->avatar}}?imageView2/1/w/80/h/80/q/75|imageslim"></div>
                                            </a>
                                        </div>
                                        <div class="col-70 col-itme col-sq" style="width: 60%">
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
                        {{--<li>--}}
                            {{--<div class="item-buttons-tab">--}}
                                {{--<div class="item-btab">--}}
                                    {{--<a href="{{route('member_msg_info',0)}}" class="buttonsi">--}}
                                        {{--<span class="icon icon-b1"></span>--}}
                                        {{--<span class="label-text">客服消息</span>--}}
                                        {{--<span class="prompt num_notice">1</span></a>--}}
                                {{--</div>--}}
                                {{--<div class="item-btab">--}}
                                    {{--<a href="/stats" class="buttonsi stats">--}}
                                        {{--<span class="icon icon-b2"></span>--}}
                                        {{--<span class="label-text">统计</span></a>--}}
                                {{--</div>--}}
                                {{--<div class="item-btab">--}}
                                    {{--<a href="{{route('member_contacts_friend')}}" class="buttonsi">--}}
                                        {{--<span class="icon icon-b3"></span>--}}
                                        {{--<span class="label-text">联系人</span>--}}
                                        {{--<span class="prompt num_fans">1</span>--}}
                                    {{--</a>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</li>--}}
                    </ul>
                    <div class="fui-cell-group fui-cell-click" style="margin-top: 0;">
                        <a class="fui-cell external" href="http://mall.cateyeart.com/app/index.php?i=3&amp;c=entry&amp;m=ewei_shopv2&amp;do=mobile&amp;r=order">
                            <div class="fui-cell-icon"><i class="icon icon-list"></i></div>
                            <div class="fui-cell-text">我的订单</div>
                            {{--<div class="fui-cell-remark" style="font-size: 0.5rem;">查看全部订单</div>--}}
                        </a>
                        {{--<div class="fui-icon-group selecter">--}}
                            {{--<a class="fui-icon-col external" href="http://mall.cateyeart.com/app/index.php?i=3&amp;c=entry&amp;m=ewei_shopv2&amp;do=mobile&amp;r=order&amp;status=0">--}}
                                {{--<div class="icon icon-green radius"><i class="icon icon-card"></i></div>--}}
                                {{--<div class="text">待付款</div>--}}
                            {{--</a>--}}
                            {{--<a class="fui-icon-col external" href="http://mall.cateyeart.com/app/index.php?i=3&amp;c=entry&amp;m=ewei_shopv2&amp;do=mobile&amp;r=order&amp;status=1">--}}
                                {{--<div class="icon icon-orange radius"><i class="icon icon-box"></i></div>--}}
                                {{--<div class="text">待发货</div>--}}
                            {{--</a>--}}
                            {{--<a class="fui-icon-col external" href="http://mall.cateyeart.com/app/index.php?i=3&amp;c=entry&amp;m=ewei_shopv2&amp;do=mobile&amp;r=order&amp;status=2">--}}
                                {{--<div class="icon icon-blue radius"><i class="icon icon-deliver"></i></div>--}}
                                {{--<div class="text">待收货</div>--}}
                            {{--</a>--}}
                            {{--<a class="fui-icon-col external" href="http://mall.cateyeart.com/app/index.php?i=3&amp;c=entry&amp;m=ewei_shopv2&amp;do=mobile&amp;r=order&amp;status=4">--}}
                                {{--<div class="icon icon-pink radius"><i class="icon icon-electrical"></i></div>--}}
                                {{--<div class="text">退换货</div>--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    </div>

                    <div class="fui-cell-group fui-cell-click">
                        <a class="fui-cell" href="http://mall.cateyeart.com/app/index.php?i=3&amp;c=entry&amp;m=ewei_shopv2&amp;do=mobile&amp;r=sale.coupon">
                            <div class="fui-cell-icon"><i class="icon icon-same"></i></div>
                            <div class="fui-cell-text"><p>领取优惠券</p></div>
                            <div class="fui-cell-remark"></div>
                        </a>
                        <a class="fui-cell" href="http://mall.cateyeart.com/app/index.php?i=3&amp;c=entry&amp;m=ewei_shopv2&amp;do=mobile&amp;r=sale.coupon.my">
                            <div class="fui-cell-icon"><i class="icon icon-card"></i></div>
                            <div class="fui-cell-text"><p>我的优惠券</p></div>
                            <div class="fui-cell-remark"></div>
                        </a>
                    </div>

                    <div class="fui-cell-group fui-cell-click">
                        <a class="fui-cell" href="http://mall.cateyeart.com/app/index.php?i=3&amp;c=entry&amp;m=ewei_shopv2&amp;do=mobile&amp;r=member.cart">
                            <div class="fui-cell-icon"><i class="icon icon-cart"></i></div>
                            <div class="fui-cell-text"><p>我的购物车</p></div>
                            <div class="fui-cell-remark"></div>
                        </a>
                        <a class="fui-cell" href="http://mall.cateyeart.com/app/index.php?i=3&amp;c=entry&amp;m=ewei_shopv2&amp;do=mobile&amp;r=member.favorite">
                            <div class="fui-cell-icon"><i class="icon icon-like"></i></div>
                            <div class="fui-cell-text"><p>关注的商品</p></div>
                            <div class="fui-cell-remark"></div>
                        </a>
                        <a class="fui-cell" href="http://mall.cateyeart.com/app/index.php?i=3&c=entry&m=ewei_shopv2&do=mobile&r=member.address">
                            <div class="fui-cell-icon"><i class="icon icon-address"></i></div>
                            <div class="fui-cell-text"><p>收货地址管理</p></div>
                            <div class="fui-cell-remark"></div>
                        </a>
                        <!--<a class="fui-cell" href="http://mall.cateyeart.com/app/index.php?i=3&c=entry&m=ewei_shopv2&do=mobile&r=member.notice" data-nocache="true">
                            <div class="fui-cell-icon"><i class="icon icon-notice"></i></div>
                            <div class="fui-cell-text"><p>消息提醒设置</p></div>
                            <div class="fui-cell-remark"></div>
                        </a>-->
                    </div>

                    <div class="fui-cell-group fui-cell-click">
                        @if (empty($member->is_verfiy))
                        <a class="fui-cell" href="{{route('member_verify')}}">
                            <div class="fui-cell-icon"><i class="icon icon-friendfamous"></i></div>
                            <div class="fui-cell-text"><p>申请猫眼艺术认证艺术家</p></div>
                            <div class="fui-cell-remark"></div>
                        </a>
                        @endif
                        <a class="fui-cell" href="{{$home_page}}">
                            <div class="fui-cell-icon"><i class="icon icon-home1"></i></div>
                            <div class="fui-cell-text"><p>我的主页</p></div>
                            <div class="fui-cell-remark"></div>
                        </a>
                        <a class="fui-cell" href="{{route('member_contacts_friend')}}">
                            <div class="fui-cell-icon"><i class="icon icon-friends"></i></div>
                            <div class="fui-cell-text"><p>我的朋友</p></div>
                            <div class="fui-cell-remark"></div>
                        </a>
                        <a class="fui-cell" href="{{route('member_msg_info',0)}}">
                            <div class="fui-cell-icon"><i class="icon icon-remind2"></i></div>
                            <div class="fui-cell-text"><p>客服消息</p></div>
                            <div class="fui-cell-remark"></div>
                        </a>
                        <a class="fui-cell" href="{{route('member_setting')}}">
                            <div class="fui-cell-icon"><i class="icon icon-settings"></i></div>
                            <div class="fui-cell-text"><p>设置</p></div>
                            <div class="fui-cell-remark"></div>
                        </a>
                    </div>

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

                </div>
            </div>
        </div>
    </div>
@endsection