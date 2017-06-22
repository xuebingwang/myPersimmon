@extends('app.layouts.cateyeart')

@section('title', '个人中心')
@section('body-style', 'mine-body')

@section('content')
    <div class="page-group">
        <div class="page page-current">
            <nav class="bar bar-tab tabNav" id="nav">
                <a class="tab-item external " href="/home">
                    <span class="icon icon-home"></span>
                </a>
                <a class="tab-item external " href="/featured">
                    <span class="icon icon-topics"></span>
                </a>
                <a class="tab-item external " href="/explore">
                    <span class="icon icon-explore"></span>
                </a>
                <a class="tab-item external active " href="/setting">
                    <span class="icon icon-mine"></span>
                    <span class="point" id="num_msg" style="display:none;"></span>
                </a>
            </nav>
            <div class="content native-scroll site-content site-li-content">
                <div class="list-block site-li-block">
                    <ul class="margin-bottom-12 identity">
                        <li>
                            <div class="item-inner">
                                <div class="item-title">
                                    <div class="row no-gutter">
                                        <div class="col-30">
                                            <a href="/uid/540617" class="item-link item-content">
                                                <div class="artistPhoto">
                                                    <img class="photo" src="https://head.artand.cn/440617/4826/128"></div>
                                            </a>
                                        </div>
                                        <div class="col-70 col-itme col-sq">
                                            <div class="item-name clearfix">
                                                <a href="/uid/540617" class="name-btn">186****0370</a></div>
                                            <div class="shenq-warp">
                                                <a href="/verify" class="shenq">申请认证</a></div>
                                        </div>
                                    </div>
                                </div>
                                <a class="item-after" href="/setting/account">个人资料</a></div>
                        </li>
                        <li>
                            <div class="item-buttons-tab">
                                <div class="item-btab">
                                    <a href="/message" class="buttonsi">
                                        <span class="icon icon-b1"></span>
                                        <span class="label-text">消息</span>
                                        <span class="prompt num_notice">1</span></a>
                                </div>
                                <div class="item-btab">
                                    <a href="/stats" class="buttonsi stats">
                                        <span class="icon icon-b2"></span>
                                        <span class="label-text">统计</span></a>
                                </div>
                                <div class="item-btab">
                                    <a href="/connection/fans" class="buttonsi">
                                        <span class="icon icon-b3"></span>
                                        <span class="label-text">联系人</span>
                                        <span class="prompt num_fans">1</span></a>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <ul class="f8 margin-bottom-12">
                        <li>
                            <a href="/uid/540617" class="item-link item-content">
                                <div class="item-inner">
                                    <div class="item-title">我的主页</div></div>
                            </a>
                        </li>
                    </ul>
                    <ul class="f8 margin-bottom-12">
                        <li>
                            <a href="/order/index?type=buy" class="item-link item-content">
                                <div class="item-inner">
                                    <div class="item-title">我购买的</div></div>
                            </a>
                        </li>
                        <li>
                            <a href="/order/index?type=sale" class="item-link item-content">
                                <div class="item-inner">
                                    <div class="item-title">我出售的</div></div>
                            </a>
                        </li>
                    </ul>
                    <ul class="f8 margin-bottom-12">
                        <li>
                            <a href="/setting/wallet" class="item-link item-content">
                                <div class="item-inner">
                                    <div class="item-title">钱包</div></div>
                            </a>
                        </li>
                    </ul>
                    <ul class="f8 margin-bottom-12">
                        <li>
                            <a href="/verify" class="item-link item-content">
                                <div class="item-inner">
                                    <div class="item-title">申请Artand认证艺术家
                                        <span class="approve approve-yellow"></span></div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <ul class="f8 margin-bottom-12">
                        <li>
                            <a href="/setting/my" class="item-link item-content">
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